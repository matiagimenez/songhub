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
$router->get('/login', 'PageController@login');
$router->get('/register', 'PageController@register');
$router->get('/terms-conditions', 'PageController@terms_conditions');
$router->get('/edit-password', 'PageController@edit_password');
$router->get('/password-recovery', 'PageController@passwordRecovery');


// Explore
$router->get('/explore', 'ExploreController@explore');

// Content
$router->get('/content', 'ContentController@content');
$router->get('/content/data', 'ContentController@getContentData');

//Search
// $router->get('/search', 'SearchController@search');
$router->get('/content/search', 'SearchController@searchContent');

// Auth
$router->post('/login', 'AuthController@login');
$router->get('/logout', 'AuthController@logout');
$router->post('/register', 'AuthController@register');
$router->get('/spotify/tokens', 'AuthController@requestSpotifyTokens');
$router->post('/password-recovery', 'AuthController@sendConfirmationEmail');
$router->get('/email-confirmation', 'AuthController@passwordRecovery');
$router->post('/new-password', 'AuthController@recover_password');


// User
$router->get('/user', 'UserController@profile');
$router->get('/user/visit', 'UserController@visit');
$router->get('/user/profile', 'UserController@edit');
$router->post('/user/profile', 'UserController@updateUser');
$router->get('/user/profile/search', 'UserController@searchProfiles');
$router->post('/user/edit-password', 'UserController@edit_password');
$router->get('/user/favorites', 'FavoriteController@getCurrentUserFavoriteContent');
$router->get('/user/favorites/add', 'FavoriteController@addCurrentUserFavoriteContent');
$router->get('/user/favorites/remove', 'FavoriteController@removeCurrentUserFavoriteContent');


// Post
$router->post('/post/create', 'PostController@createPost');
$router->get('/post', 'PostController@post');
$router->get('/post/following', 'PostController@getMoreUserFeedPosts');
$router->get('/post/profile', 'PostController@getMoreUserProfilePosts');
$router->get('/', 'PostController@feed');

// Artist
$router->get('/artist', 'ArtistController@getArtist');

$router->get('/error/internal-error', 'ErrorController@internalError');
$router->get('/error/not-found', 'ErrorController@notFound');

// Follow
$router->get('/following', 'FollowController@getMoreUserFollowing');
$router->get('/followers', 'FollowController@getMoreUserFollowers');
$router->get('/user/followers', 'FollowController@followers');
$router->get('/user/following', 'FollowController@following');
$router->get('/follow/user', 'FollowController@follow');
$router->delete('/unfollow/user', 'FollowController@unfollow');

// Comment
$router->get('/comment', 'CommentController@comment');
$router->post('/comment/create', 'CommentController@createComment');
$router->get('/comment/delete', 'CommentController@deleteComment');
$router->get('/comment/edit', 'CommentController@editComment');




