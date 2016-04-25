<?php 

$app->group('/test', function() {
	$this->get('/application/{id:[0-9]+}', 'App\Controller\TestController:application')
	     ->setName('application');    

	$this->get('/module/{id:[0-9]+}', 'App\Controller\TestController:module')
         ->setName('module');

	$this->get('/entity/{id:[0-9]+}', 'App\Controller\TestController:entity')
         ->setName('entity');

	$this->get('/state/{id:[0-9]+}', 'App\Controller\TestController:state')
	     ->setName('state');

	$this->get('/register/{id:[0-9]+}', 'App\Controller\TestController:register')
	     ->setName('register');  

    $this->get('/new-register/{id_entity:[0-9]+}/{id_state:[0-9]+}', 'App\Controller\TestController:newRegister')
	     ->setName('new-register');  

	$this->post('/create-register/{id_entity:[0-9]+}/{id_state:[0-9]+}', 'App\Controller\TestController:createRegister')
	     ->setName('create-register');  

	$this->post('/update-register/{id:[0-9]+}', 'App\Controller\TestController:updateRegister')
	     ->setName('update-register');  

	//listChildRegisters
	$this->get('/list-child-register/{id:[0-9]+}', 'App\Controller\TestController:listChildRegisters')
	     ->setName('list-child-register');    


	$this->get('/attribute/{id:[0-9]+}', 'App\Controller\TestController:attribute')
	     ->setName('attribute');    

	$this->get('/type/{id:[0-9]+}', 'App\Controller\TestController:type')
	     ->setName('type');    

	$this->get('/attribute-value-int/{id:[0-9]+}', 'App\Controller\TestController:attributeValueInt')
	     ->setName('attribute-value-int');    

	$this->get('/attribute-value-string-32/{id:[0-9]+}', 'App\Controller\TestController:attributeValueString32')
	     ->setName('attribute-value-string-32');    

	$this->get('/attribute-value-string-256/{id:[0-9]+}', 'App\Controller\TestController:attributeValueString256')
	     ->setName('attribute-value-string-256');  

});
