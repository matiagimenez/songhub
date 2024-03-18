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

    public function spotifyAuthorize()
    {
        $host = Config::getInstance()->get("HOST");
        $port = Config::getInstance()->get("PORT");
        $client_id = Config::getInstance()->get("SPOTIFY_CLIENT_ID");
        $url = 'https://accounts.spotify.com/authorize';
        //? Esta es la URL a la que nos redirige spotify una vez que el usuario fue autorizado?
        $redirect_uri = "http://" . $host . ":" . $port . "/user/profile/edit";

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
            "message" => "Spotify account registered successfully",
            "url" => $redirect_url,
            "status" => $statusCode,
            "headers" => $headers,
        ]);

        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        header("Location: " . $redirect_url);

        http_response_code(200);
        echo json_encode($response);
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