<?php

namespace Songhub\core;

use Exception;
use GuzzleHttp\Client;
use Songhub\core\LoggerBuilder;
use Songhub\core\traits\Loggable;

class HttpClient
{
    use Loggable;
    private $httpClient;
    private static $instance;

    private function __construct()
    {
        $logger = LoggerBuilder::getInstance()->getLogger();
        $this->setLogger($logger);
        $this->httpClient = new Client();
    }

    public static function getInstance()
    {
        if (!isset(self::$httpClient)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($url, $parameters = [], $headers = [])
    {

        $options = [];
        if (!empty($parameters)) {
            $options['query'] = $parameters;
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        $options['allow_redirects'] = false;

        try {
            $this->logger->info("GET Request to: " . $url);

            $response = $this->httpClient->request("GET", $url, $options);

            $statusCode = $response->getStatusCode();
            $response->getHeaders();
            $body = $response->getBody();
            $headers = $response->getHeaders();

            $this->logger->info("GET response from:" . $url, ["status" => $statusCode]);

            return ["status" => $statusCode, "headers" => $headers, "body" => $body];
        } catch (Exception $e) {
            $this->logger->debug("Error on GET request to" . $url, ["exception" => $e]);
            return "Error";
        }

    }

    public function post($url, $body = [], $headers = [])
    {

        $options = [];

        if (!empty($body)) {
            if ($headers['Content-Type'] === 'application/x-www-form-urlencoded') {
                $options["form_params"] = $body;
            } else {
                $options["body"] = json_encode($body);
            }
        }

        if (!empty($headers)) {
            $options['headers'] = $headers;
        }

        try {
            $this->logger->info("POST Request to: ", ["url" => $url]);

            $response = $this->httpClient->request('POST', $url, $options);

            $statusCode = $response->getStatusCode();
            $body = $response->getBody();
            $headers = $response->getHeaders();

            $this->logger->info("GET response from:" . $url, ["status" => $statusCode]);

            return ["status" => $statusCode, "body" => $body, "headers" => $headers];
        } catch (Exception $e) {
            $this->logger->debug("Error on POST request to:" . $url, ["exception" => $e]);
        }

    }

}