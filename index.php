<?php
	
	require 'vendor/autoload.php';

	$app = new \Slim\App;

	$app->get('/postagens', function() {

		echo 'postagens';

	} );

	$app->get('/usuarios/{id}', function($request, $response) {

		$id = $request->getAttribute('id');

		//Verificar se ID é válido no DB

		echo "Usuario é $id";

	} );

	$app->run();

?>