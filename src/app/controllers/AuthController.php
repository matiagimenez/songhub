<?php
namespace Songhub\app\Controllers;

use Songhub\app\repositories\UserRepository;
use Songhub\core\Config;
use Songhub\core\Controller;
use Songhub\core\HttpClient;
use Songhub\core\Renderer;
use Songhub\core\Request;

class AuthController extends Controller
{

    public function __construct()
    {
        $this->repositoryName = UserRepository::class;
        parent::__construct();
    }

    public function login()
    {
        $email = Request::getInstance()->getParameter("email", "POST");
        $password = Request::getInstance()->getParameter("password", "POST");
        // TODO: Chequear que los datos provistos sean validos para el login.

        // Solicita autorización de cuenta de spotify al usuario
        $this->authorizeSpotifyAccount();

    }

    public function register()
    {

        $username = $this->sanitizeUserInput(Request::getInstance()->getParameter("username", "POST"));
        $email = $this->sanitizeUserInput(Request::getInstance()->getParameter("email", "POST"), FILTER_SANITIZE_EMAIL);
        $emailConfirmation = $this->sanitizeUserInput(Request::getInstance()->getParameter("email-confirmation", "POST"), FILTER_SANITIZE_EMAIL);
        $password = Request::getInstance()->getParameter("password", "POST");
        $passwordConfirmation = Request::getInstance()->getParameter("password-confirmation", "POST");

        $userData = [
            "USERNAME" => $username,
            "EMAIL" => $email,
            "EMAIL_CONFIRMATION" => $emailConfirmation,
            "PASSWORD" => $password,
            "PASSWORD_CONFIRMATION" => $passwordConfirmation,
        ];

        list($status, $message) = $this->repository->createUser($userData);

        if ($status) {
            Renderer::getInstance()->login($message);
        } else {
            Renderer::getInstance()->register($message, true);
        }

    }

    private function authorizeSpotifyAccount()
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

        if ($response["status"] >= 300 && $response["status"] < 400) {

            $redirect_uri = $response["headers"]["location"]["0"];
            header("Location: " . $redirect_uri);
        }
    }

    public function refreshSpotifyToken($refreshToken)
    {

        $accessToken = " "; // TODO: Obtenerlo usando el refresh token.
        $userTokens = ["refresh_token" => $refreshToken, "access_token" => $accessToken];
        header("Location: /home");
        $this->fetchSpotifyData($userTokens);

    }

    public function requestSpotifyTokens()
    {
        $code = Request::getInstance()->getParameter("code", "GET");
        $error = Request::getInstance()->getParameter("error", "GET");

        if (strlen($error) > 0) {
            header("Location: /login?redirect=true");
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
            header("Location: /login?redirect=true");
            $this->fetchSpotifyData($user_tokens);
        }
    }

    private function fetchSpotifyData($user_tokens)
    {
        echo "<pre>";
        var_dump($_POST);
        die;

        $access_token = $user_tokens["access_token"];
        $refresh_token = $user_tokens["refresh_token"];

        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me", [], ["Authorization" => "Bearer " . $access_token]);

        $status = $response["status"];
        $body = json_decode($response["body"], true);

        if ($status >= 400) {
            Renderer::getInstance()->internalError();
            die;
        }

        $username = $body["id"];
        $email = $body["email"];

        // Si existe un usuario, entonces actualizamos sus datos de spotify (ya está registrado).
        $userExists = $this->repository->userExists($username, $email);
        if ($userExists) {
            $userData = [
                "USERNAME" => $body["id"],
                "SPOTIFY_ID" => $body["id"],
                "SPOTIFY_AVATAR" => $body["images"][0]["url"],
                "SPOTIFY_URL" => $body["external_urls"]["spotify"],
                "REFRESH_TOKEN" => $refresh_token,
            ];

            list($status, $message) = $this->repository->updateUser($userData);
        }
    }
}