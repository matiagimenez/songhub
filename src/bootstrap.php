<?php

require __DIR__ . "/../vendor/autoload.php";

use Songhub\core\Config;
use Songhub\core\database\ConnectionBuilder;
use Songhub\core\LoggerBuilder;
use Songhub\core\Request;
use Songhub\core\Router;

$request = Request::getInstance();

$config = Config::getInstance();

$connectionBuilder = ConnectionBuilder::getInstance();
$connection = $connectionBuilder->getConnection();

$whoops = new \Whoops\Run;
$whoops->pushHandler(new \Whoops\Handler\PrettyPageHandler);
$whoops->register();

$router = new Router();
$logger = LoggerBuilder::getInstance()->getLogger();
$router->setLogger($logger);

// Pages
$router->get('/', 'PageController@home');
$router->get('/login', 'PageController@login');
$router->get('/register', 'PageController@register');
$router->get('/post', 'PageController@post');

// Explore
$router->get('/explore', 'ExploreController@explore');

// Content
$router->get('/content', 'ContentController@content');
$router->get('/content/data', 'ContentController@getContentData');

//Search
$router->get('/search', 'SearchController@search');
$router->get('/content/search', 'SearchController@searchContent');

// Auth
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@register');
$router->get('/spotify/tokens', 'AuthController@requestSpotifyTokens');

// User
$router->get('/user', 'UserController@profile');
$router->get('/user/profile', 'UserController@edit');
$router->post('/user/profile/edit', 'UserController@updateUser');
$router->get('/user/favorites', 'FavoriteController@getCurrentUserFavoriteContent');
$router->get('/user/favorites/add', 'FavoriteController@addCurrentUserFavoriteContent');
$router->get('/user/favorites/remove', 'FavoriteController@removeCurrentUserFavoriteContent');

// Post
$router->post('/post/create', 'PostController@createPost');

// Artist
$router->get('/artist', 'ArtistController@getArtist');

// Artist
$router->get('/error/internal-error', 'ErrorController@internalError');
$router->get('/error/not-found', 'ErrorController@notFound');


