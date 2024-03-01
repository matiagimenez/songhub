<?php

require __DIR__ . '/../src/bootstrap.php';

$router->direct($request);

// use Songhub\core\exceptions\RouteNotFoundException;

// try {
//     $router->direct($request);
//     $logger->info("200: Path found", ["Path" => $path]);
// } catch (RouteNotFoundException $error) {
//     $router->direct('/not_found');
//     $logger->info("404: Path not found", ["Path" => $path]);
// } catch (Exception $error) {
//     $router->direct('/internal_error');
//     $logger->error("500: Internal server error", ["Error" => $error]);
// }