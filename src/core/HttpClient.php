<?php

namespace Songhub\core;

use Songhub\core\exceptions\RequestException;
use Songhub\core\LoggerBuilder;
use Songhub\core\traits\Loggable;

class HttpClient
{
    use Loggable;
    private static $instance;

    private function __construct()
    {
        $this->logger = LoggerBuilder::getInstance()->getLogger();
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public function get($url, $parameters = [], $headers = [])
    {
        if (!empty($parameters)) {
            $url .= '?' . http_build_query($parameters);
        }

        $requestHandler = curl_init($url);

        curl_setopt($requestHandler, CURLOPT_RETURNTRANSFER, true); // Return the response instead of printing it
        curl_setopt($requestHandler, CURLOPT_HTTPGET, true); // Set HTTP method as GET
        curl_setopt($requestHandler, CURLOPT_HEADER, true); // Include the HTTP headers in the response

        if (!empty($headers)) {
            curl_setopt($requestHandler, CURLOPT_HTTPHEADER, $headers);
        }

        try {
            $response = curl_exec($requestHandler);
            if (curl_errno($requestHandler)) {
                throw new RequestException('Error: ' . curl_error($requestHandler));
            }
        } catch (RequestException $error) {
            $this->logger->error($error->getMessage());
            echo $error->getMessage();
        } finally {
            curl_close($requestHandler);
        }

        $httpStatusCode = curl_getinfo($requestHandler, CURLINFO_HTTP_CODE); // Obtener el código de estado HTTP

        $headerSize = curl_getinfo($requestHandler, CURLINFO_HEADER_SIZE); // Obtener el tamaño de la cabecera HTTP
        $header = substr($response, 0, $headerSize); // Extraer la cabecera HTTP
        $headers = explode("\n", $header);
        $headers = $this->parseHeaders($headers);

        $body = substr($response, $headerSize); // Extraer el cuerpo de la respuesta
        $body = json_decode($body, true);

        return ["status" => $httpStatusCode, "headers" => $headers, "body" => $body];

    }

    public function post($url, $body = [], $headers = [])
    {
            $requestHandler = curl_init();
            curl_setopt($requestHandler, CURLOPT_RETURNTRANSFER, true); // Return the response instead of printing it
            curl_setopt($requestHandler, CURLOPT_URL, $url);
            // Set the request method to POST
            curl_setopt($requestHandler, CURLOPT_POST, 1);
            curl_setopt($requestHandler, CURLOPT_POSTFIELDS, http_build_query($body)); // Encode body as x-www-form-urlencoded

            
            if (!empty($headers)) {
                curl_setopt($requestHandler, CURLOPT_HTTPHEADER, $headers);
            }

            try {
                $response = curl_exec($requestHandler);
                if (curl_errno($requestHandler)) {
                    throw new RequestException('Error: ' . curl_error($requestHandler));
                }
            }catch (RequestException $error) {
                $this->logger->error($error->getMessage());
                echo $error->getMessage();
            } finally {
                curl_close($requestHandler);
            }

                    

            $httpStatusCode = curl_getinfo($requestHandler, CURLINFO_HTTP_CODE); // Obtener el código de estado HTTP
            $bodyLength = curl_getinfo($requestHandler, CURLINFO_HEADER_SIZE); // Obtener el tamaño de la cabecera HTTP
            $body = substr($response, 0, $bodyLength); // Extraer la cabecera HTTP
            $body = json_decode($body, true);
    
            return ["status" => $httpStatusCode, "body" => $body];
    }

    private function parseHeaders(array $headers): array
    {
        $parsedHeaders = [];

        foreach ($headers as $header) {
            $parts = explode(': ', $header, 2);
            if (count($parts) === 2) {
                $parsedHeaders[$parts[0]] = $parts[1];
            }
        }

        return $parsedHeaders;
    }

}