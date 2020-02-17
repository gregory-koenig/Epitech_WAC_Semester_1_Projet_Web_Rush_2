<?php

require_once 'autoload.php';

$router = new Router($_GET['url']);

$router->get('/', function () { echo "Homepage"; });
$router->get('/artists', 'Artists#getAll');
$router->get('/artists/:id', 'Artists#getById');
$router->get('/albums', 'Albums#getAll');
$router->get('/albums/:id', 'Albums#getById');
$router->get('/tracks/:id', 'Tracks#getById');
$router->get('/genres', 'Genres#getAll');
$router->get('/genres/:id', 'Genres#getById');
$router->run();