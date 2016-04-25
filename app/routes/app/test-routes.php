<?php

	$app->get('/', function() {
		exit("Home!");
	});

	//http://localhost:8000/hello/index
	$app->get('/hello/{name:[A-Za-z]+}', 'App\Controller\TestController:hello');

	/*    
	$app->get('/test/:name(/:id)', 'App\Controller\TestController:test')
	    ->conditions(array('test' => '[A-Za-z]+',
	    				   'id'   => '[1-9]+'));    

	$app->post('/test/create-register/:id_entity', 
			   'App\Controller\TestController:createRegister')
	    	   ->conditions(array('id_entity'   => '[1-9]+'));        
	 
	$app->post('/test/update-register/:id_register', 
			   'App\Controller\TestController:updateRegister')
	    	   ->conditions(array('id_register' => '[1-9]+'));        
	*/    
	/*    
	$app->put('/test/:name(/:id)', 'App\Controller\TestController:test')
	    ->conditions(array('test' => '[A-Za-z]+',
	    				   'id'   => '[1-9]+'));        
    */