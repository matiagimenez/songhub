<?php
namespace Songhub\app\Controllers;

use Songhub\app\repositories\UserRepository;
use Songhub\core\Config;
use Songhub\core\Controller;
use Songhub\core\Cookie;
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
        $email = $this->sanitizeUserInput(Request::getInstance()->getParameter("email", "POST"), FILTER_SANITIZE_EMAIL);
        $password = Request::getInstance()->getParameter("password", "POST");

        list($status, $message) = $this->repository->login($email, $password);

        if (!$status) {
            Renderer::getInstance()->login($message, true);
            die;
        }

        //? Resguardo el email/username utilizado para el inicio de sesión.
        Cookie::getInstance()->set("user_login_identifier", $email, 3600);

        $this->authorizeSpotifyAccount();

        // TODO:  Crear session

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

        //? Esta URL debe ser la misma que se utilizo al momento de autorizar la aplicación. No habrá una redirección, sino que es solamente a modo de validación.
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

        //? Solicitod los tokens del usuario a la API de Spotify
        $response = HttpClient::getInstance()->post($url, $body, $headers);

        $body = json_decode($response["body"], true);
        $status = $response["status"];

        if ($status >= 400) {
            Renderer::getInstance()->internalError();
            die;
        }

        $access_token = $body["access_token"];
        $refresh_token = $body["refresh_token"];

        //? Realizo petición a la API para obtener datos de la cuenta del usuario.
        $response = HttpClient::getInstance()->get("https://api.spotify.com/v1/me", [], ["Authorization" => "Bearer " . $access_token]);

        $status = $response["status"];
        $body = json_decode($response["body"], true);

        if ($status >= 400) {
            Renderer::getInstance()->internalError();
            die;
        }

        //? Si existe un usuario, entonces actualizamos sus cuenta a partir de los datos obtenidos de la cuenta autorizada de Spotify.
        //? Obtengo el identificador que el usuario utilizó para iniciar sesión anteriormente
        $userLoginIdentifier = Cookie::getInstance()->get("user_login_identifier");

        //? Elimino la cookie ya que no va a ser reutilizada.
        Cookie::getInstance()->delete("user_login_identifier");

        if (!$userLoginIdentifier) {
            Renderer::getInstance()->internalError();
            die;
        }

        $userData = [
            "SPOTIFY_ID" => $body["id"],
            "SPOTIFY_AVATAR" => $body["images"][0]["url"],
            "SPOTIFY_URL" => $body["external_urls"]["spotify"],
            "REFRESH_TOKEN" => $refresh_token,
        ];

        list($status, $message) = $this->repository->updateUser("EMAIL", $userLoginIdentifier, $userData);

        if (!$status) {
            Renderer::getInstance()->internalError();
            die;
        }

        //TODO: CREAR SESIÓN.
        // Session::getInstance() -> set("access_token", $access_token);

        Renderer::getInstance()->home();

    }

    private function updateUserData($user_tokens)
    {

    }
}