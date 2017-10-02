<?php

$router->add('', [
	'controller' => 'TableController',
	'action' => 'index'
]);
$router->add('table/reset', [
    'controller' => 'TableController',
    'action' => 'reset'
]);
$router->add('table/paginate', [
    'controller' => 'TableController',
    'action' => 'paginate'
]);