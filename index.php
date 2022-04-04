<?php
	
	require 'vendor/autoload.php';

	$app = new \Slim\App;

	/*
	$app->get('/postagem', function() {

		echo 'postagem';

	} );

	$app->get('/user/{id}', function($request, $response) {

		$id = $request->getAttribute('id');

		//Verificar se ID é válido no DB

		echo "Usuario é $id";

	} );

	$app->get('/', function() {

		echo "Index";

	});

	//O COLCHETE É USADO PARA TORNAR UM PARAMETRO OPCIONAL

	$app->get('/users[/{id}]', function($request, $response) {

		$id = $request->getAttribute('id');

		echo '{
				{"nome" : "Jamilton"},
				{"nome" : "Raul"},
				{"nome" : "Vitor"},
				{"nome" : "Antonio"}
			}';
		echo '<br> <hr> <br>';
		echo  "O id do usuário é: $id";

	});

	$app->get('/postagens[/{mes}[/{ano}]]', function($request, $response) {

		$mes = $request->getAttribute('mes');

		$ano = $request->getAttribute('ano');

		if(isset($mes) && isset($ano)) {
			echo "Postagens do mes $mes, ano $ano";
		} else {
			echo "Postagens";
		}

	});

	//os 2 pontos são utilizados para definir o que é aceito dentro desses itens (o asterisco significa qualquer valor)
	$app->get('/lista/{itens:.*}', function($request, $response) {

		$itens = $request->getAttribute('itens');

		echo "<pre>";
		var_dump(explode("/", $itens));
		echo "</pre>";	

	});

	/* Nomear Rotas 
	// é usado a seta em conjunto com a função setName({nome}) para nomear uma rota
	$app->get('/blog/postagens/{id}', function($request, $response) {

		$id = $request->getAttribute('id');

		echo "listar postagens para um ID";

	})->setName("blog");

	$app->get('/meusite', function($request, $response) {
		
		//usando essa escrita, no pathFor o primeiro parametro é o nome da rota e o segundo (podendo ser um array) sendo os parametros setados na rota cujo nome foi citado
		$retorno = $this->get("router")->pathFor("blog", ["id" => "5"]);

		echo $retorno;

	});*/


	/* Agrupar Rotas 

	$app->group('/v1', function() {

		$this->get('/usuarios', function() {

			echo "Listagem de Usuarios";

		});

		$this->get('/postagens', function() {

			echo "Listagem de postagens";

		});

	});

	*/

	$app->run();

?>