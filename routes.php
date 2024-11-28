<?php

$router->get('/', 'HomeController@index', ['auth']);
$router->get('/repository', 'RepositoryController@index', ['auth']);
$router->get('/repository/{id}', 'RepositoryController@show', ['auth']);
$router->get('/about', 'AboutController@index', ['auth']);

// User routes
$router->get('/register', 'UserController@create', ['guest']);
$router->get('/login', 'UserController@login', ['guest']);
$router->get('/logout', 'UserController@logout', ['auth']);

$router->post('/register','UserController@store', ['guest']);
$router->post("/login", "UserController@authenticate", ["guest"]);
