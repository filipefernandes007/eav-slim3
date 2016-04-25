<?php
// Routes

$app->get('/', 'App\Controller\HomeController:home')
    ->setName('homepage');


$app->get('/post/{id}', 'App\Controller\HomeController:viewPost')
    ->setName('view_post');

//if($settings['settings']['debug_mode']) {
if($app->getContainer()['settings']['debug_mode']) {
	require __DIR__ .'/routes-test.php';	
}