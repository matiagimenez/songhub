<?php
namespace Songhub\App\Controllers;

use Songhub\core\Config;
use Songhub\core\Controller;
use Songhub\core\HttpClient;
use Songhub\core\Request;

class AuthController extends Controller
{

    public function login()
    {
        $email = Request::getInstance()->getParameter("email", "POST");
        $password = Request::getInstance()->getParameter("password", "POST");
        echo "<pre>";
        var_dump($email, $password);
        die;
    }

    public function authorizeSpotifyAccount()
    {
        $host = Config::getInstance()->get("HOST");
        $port = Config::getInstance()->get("PORT");
        $client_id = Config::getInstance()->get("SPOTIFY_CLIENT_ID");
        $url = 'https://accounts.spotify.com/authorize';
        //? Esta es la URL a la que nos redirige spotify una vez que el usuario fue autorizado
        $redirect_uri = "http://" . $host . ":" . $port . "/spotify/tokens";

        $parameters = ['client_id' => $client_id,
            'response_type' => 'code',
            'scope' => 'user-read-private user-read-email',
            'redirect_uri' => $redirect_uri,
            "show_dialog" => true,
        ];

        $response = HttpClient::getInstance()->get($url, $parameters);

        $statusCode = $response["status"];

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');

        if ($statusCode >= 400) {
            http_response_code(500);
            $response = json_encode([
                "ok" => "false",
                "message" => "Error sending authorization request",
            ]);

        } else {
            http_response_code(200);
            $headers = $response["headers"];
            $redirect_url = $headers["location"][0];
            // header("Location: " . $redirect_url);
            $response = json_encode([
                "ok" => "true",
                "message" => "Authorization request sent successfully",
                "url" => $redirect_url,
            ]);
        }

        echo $response;
    }

    public function requestSpotifyTokens()
    {
        $code = Request::getInstance()->getParameter("code", "GET");
        $error = Request::getInstance()->getParameter("error", "GET");

        if (strlen($error) > 0) {
            header("Location: /register");
            die;
        }

        $host = Config::getInstance()->get("HOST");
        $port = Config::getInstance()->get("PORT");
        $client_id = Config::getInstance()->get("SPOTIFY_CLIENT_ID");
        $client_secret = Config::getInstance()->get("SPOTIFY_CLIENT_SECRET");

        $url = 'https://accounts.spotify.com/api/token';
        //? Esta es la URL a la que nos redirige spotify una vez que los tokens fueron generados
        $redirect_uri = "http://" . $host . ":" . $port . "/spotify/tokens";

        $body = [
            'grant_type' => "authorization_code",
            'code' => $code,
            'redirect_uri' => $redirect_uri,
        ];

        $headers = [
            "Content-Type" => "application/x-www-form-urlencoded",
            "Authorization" => "Basic " . base64_encode($client_id . ":" . $client_secret),
        ];

        // POST request para obtener los tokens
        $response = HttpClient::getInstance()->post($url, $body, $headers);

        $status = $response["status"];
        $body = $response["body"];

        if ($status == 200) {
            $user_tokens = json_decode($body, true);
            $this->requestUserData($user_tokens);
        }
    }

    private function requestUserData($user_tokens)
    {

        $access_token = $user_tokens["access_token"];
        $refresh_token = $user_tokens["refresh_token"];
        $expires_in = $user_tokens["expires_in"];
        $token_type = $user_tokens["token_type"];

        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me", [], ["Authorization" => $token_type . " " . $access_token]);

        $status = $response["status"];
        $headers = $response["headers"];
        $body = json_decode($response["body"], true);

        echo "<pre>";
        var_dump($status, $headers, $body);
        var_dump("Authorization: Bearer " . $access_token);
        die;

        //TODO: Crear cuenta de usuario.
    }

}