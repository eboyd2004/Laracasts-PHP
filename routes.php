<?php

$router->get('/', 'controllers/index.php');
$router->get('/about', 'controllers/about.php');
$router->get('/contact', 'controllers/contact.php');

$router->get('/notes', 'controllers/notes/index.php');
$router->delete('/note', 'controllers/notes/show.php');
$router->post('/note/create', 'controllers/notes/create.php');
