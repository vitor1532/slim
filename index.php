<?php
	
	use \Psr\Http\Message\ServerRequestInterface as Request;
	use \Psr\Http\Message\ResponseInterface as Response;
	use Illuminate\Database\Capsule\Manager as Capsule;

	require 'vendor/autoload.php';

	$app = new \Slim\App(
		['settings' => [
			'displayErrorDetails' => true
			] 
		]
	);

	$app->get('/', function() {

		echo "Página inicial Slim. <br>";

	});


	$container = $app->getContainer();
	$container['db'] = function() {

		$capsule = new Capsule;

		$capsule->addConnection([
		    'driver' => 'mysql',
		    'host' => 'localhost',
		    'database' => 'slim',
		    'username' => 'root',
		    'password' => '',
		    'charset' => 'utf8',
		    'collation' => 'utf8_unicode_ci',
		    'prefix' => '',
		]);

		$capsule->setAsGlobal();
		$capsule->bootEloquent();

		return $capsule;

	};

	$app->get('/users', function(Request $request, Response $response) {

		$db = $this->get('db');
		/*$db->schema()->dropIfExists('usuarios');
		$db->schema()->create('usuarios', function($table) {

			$table->increments('id');
			$table->string('nome');
			$table->string('email')->unique();
			$table->timestamps();

		});*/

		/* inserir 
		$db->table('usuarios')->insert([

			'nome' => 'Vitor',
			'email' => 'vitor@teste.com'

		]);*/

		/* Atualizar 
		$db->table('usuarios')
					->where('id', 1)
					->update([
						'nome' => 'Vitor'
					]);
		*/

		/* deletar 
		$db->table('usuarios')
					->where('id', 1)
					->delete();
		*/

		/* listar */
		$users = $db->table('usuarios')->get();

		foreach($users as $user) {
			echo $user->nome . '<br>';
		}

	} );


	$app->run();

	/* Tipos de respostas:
	cabeçalho, texto, Json, XML
	 

	$app->get('/header', function(Request $request, Response $response) {

		$response->write('Retorno Header');
		return $response->withHeader('allow', 'PUT')
				 ->withAddedHeader('Content-Length', 10);

	} );


	$app->get('/json', function(Request $request, Response $response) {

		return $response->withJson( [
			"nome" => "Vitor Martins",
			"idade" => 25,
			"endereco" => "Rua I, 15"
		] );

	} );

	$app->get('/xml', function(Request $request, Response $response) {

		$xml = file_get_contents('arquivo');
		$response->write($xml);

		return $response->withHeader('Content-Type', 'application/xml');

	} );*/

	/* Middleware 

	$app->add( function($request, $response, $next) {

		$response->write(' Inicio camada 1 + ');
		//return $next($request, $response);
		$response = $next($request, $response);
		$response->write(' + Fim camada 1 ');

		return $response;

	});

	$app->add( function($request, $response, $next) {

		$response->write(' Inicio camada 2 + ');
		//return $next($request, $response);
		$response = $next($request, $response);
		$response->write(' + Fim camada 2 ');

		return $response;

	});

	$app->get('/usuarios', function(Request $request, Response $response) {

		$response->write(' Ação Principal usuario');

	});

	$app->get('/postagens', function(Request $request, Response $response) {

		$response->write(' Ação Principal postagens');

	});*/

	/* Container dependency injection 
	class Servico {

		public function txt() {

			$txt;

			$txt = "Este é o serviço <br>";

			echo $txt;
		}
		

	}

	 Container Pimple 
	$container = $app->getContainer();
	$container['servico'] = function() {
		
		return new Servico;

	};



	$app->get('/', function() {

		echo "Página inicial Slim. <br>";
		echo "<a href='servico'>servico</a> <br>";
		echo "<a href='usuario'>usuario</a>";

	});


	$app->get('/servico', function(Request $request, Response $response) {

		$servico = $this->get('servico');
		$servico->txt();
		var_dump($servico);

	} );

	 Controllers como serviço 
	$container = $app->getContainer();
	$container['Home'] = function() {
		
		return new MyApp\controllers\Home( new MyApp\View );

	};

	$app->get('/usuario', 'Home:index');

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