<?php
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;

	require 'vendor/autoload.php';

	$app = new \Slim\App;

	/* Container dependency injection */
	class Servico {

	}

	/* Container Pimple */
	$container = $app->getContainer();
	$container['servico'] = function() {
		
		return new Servico;

	};


	$app->get('/servico', function(Request $request, Response $response) {

		$servico = $this->get('servico');
		var_dump($servico);

	} );

	/* Controllers como serviço */

	$app->run();

	/*
	$app->get('/postagens', function(Request $request, Response $response) {

		/* escreve no corpo da resposta utilizando o padrão PSR7 
		$response->getBody()->write("Listagem de Postagens");

		return $response;

	} );

	$app->delete('/users/remove/{id}', function (Request $request, Response $response) {

		$id = $request->getAttribute('id');

		/*
		Deletar no banco de dados com DELETE...
		

		return $response->getBody()->write("Sucesso ao remover o id: " . $id);

	});

	$app->put('/users/att', function (Request $request, Response $response) {

		//recupera post ($_POST)
		$put = $request->getParsedBody();

		$nome = $put['nome'];
		$email = $put['email'];
		$id = $put['id'];

		/*
		Atualizar no banco de dados com UPDATE...
		

		return $response->getBody()->write("Sucesso ao atualizar o id" . $id);

	});

	/*
	Tipos de requisição ou Verbos HTTP

	get -> Recuperar recursos do servidor (Select)
	post -> Criar dado no servidor (Insert)
	put -> Atualizar dados no servidor (Update)
	delete -> Deletar dados do servidor (Delete)
	

	$app->post('/users/add', function (Request $request, Response $response) {

		//recupera post ($_POST)
		$post = $request->getParsedBody();
		$nome = $post['nome'];
		$email = $post['email'];

		/*
		Salvar no banco de dados com INSERT INTO...
		

		return $response->getBody()->write("Sucesso ao inserir");

	});*/

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

?>