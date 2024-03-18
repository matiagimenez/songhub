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
            'state' => $this->generateRandomState(),
            'redirect_uri' => $redirect_uri,
        ];

        $response = HttpClient::getInstance()->get($url, $parameters);

        $statusCode = $response["status"];
        $headers = $response["headers"];
        $redirect_url = $headers["location"];

        // Enviar una respuesta de redirección al cliente con la URL de redirección
        $response = json_encode([
            "ok" => "true",
            "message" => "Authorization request sent successfully",
            "url" => $redirect_url,
        ]);

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Location: " . $redirect_url);

        http_response_code(200);
        echo json_encode($response);
    }

    public function requestSpotifyTokens(){
        $code = Request::getInstance()->getParameter("code", "GET");
        $state = Request::getInstance()->getParameter("state", "GET");

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
            "Content-Type: application/x-www-form-urlencoded", 
            "Authorization: Basic " . base64_encode($client_id . ":" . $client_secret)
        ];

        // POST request para obtener los tokens
        $response = HttpClient::getInstance()->post($url, $body, $headers);
        $status = $response["status"];
        $body = $response["body"];

        if($status == 200){
            $this -> requestUserData($body);
        }
    }

    private function requestUserData($body) {
        $access_token = $body["access_token"];
        $refresh_token = $body["refresh_token"];
        $expires_in = $body["expires_in"];
        $token_type = $body["token_type"];

        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me", [], ["Authorization: Bearer " . $access_token]);
        $status = $response["status"];
        $headers = $response["headers"];
        $body = $response["body"];

        echo "<pre>";
        var_dump($status, $headers, $body);
        var_dump("Authorization: Bearer " . $access_token);
        die;
    }

    private function generateRandomState($length = 32)
    {
        // Genera una secuencia de bytes aleatorios seguros
        $randomBytes = openssl_random_pseudo_bytes($length);

        // Convierte los bytes aleatorios en una cadena codificada en base64
        $state = base64_encode($randomBytes);

        // Elimina cualquier carácter no deseado para que el estado sea URL-safe
        $state = strtr($state, '+/', '-_');

        return $state;
    }
}