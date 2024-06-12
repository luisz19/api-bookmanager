<?php

require __DIR__ . '/vendor/autoload.php';
require 'books.php';
require 'booksDAO.php';

use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Factory\AppFactory;

$app = AppFactory::create();

$app->addBodyParsingMiddleware();
$app->addRoutingMiddleware();
$app->addErrorMiddleware(true, true, true);
                                                             //args = array
$app->get('/books', function(Request $request, Response $response, $args) { //RESPONSE (PEGAR)
    $booksDAO = new booksDAO(); //cria uma instância
    $books = $booksDAO->allBooks(); //ver todos os livros
    $response->getBody()->write(json_encode($books)); //converte para json
    return $response->withHeader('Content-type', 'application/json'); //escreva como json a resposta no header

});
    
$app->post('/books', function(Request $request, Response $response, $args) { //REQUEST (CRIAR)
    $data = $request->getParsedBody(); 

    if (isset($data['titulo']) && isset($data['autor']) && isset($data['genero'])) { //atribuir no body
        $books = new Books($data['titulo'], $data['autor'], $data['genero']);
        $booksdao = new booksDAO();
        $booksdao->create($books);
        return $response->withStatus(201);
    } else {
        $response->getBody()->write('Dados incompletos');
        return $response->withStatus(400);
    }
});

$app->put('/books/{id}', function(Request $request, Response $response, $args) { //ATUALIZAR DE ACORDO COM ID PASSADO NA ROTA
   $id = $args['id'];
   $data = $request->getParsedBody();

   $books = new Books($data['titulo'], $data['autor'], $data['genero']);
   $books->setId($id);
   $booksdao = new booksDAO();
   $booksdao->update($books);

   return $response->withStatus(201);
});

$app->delete('/books/{id}', function(Request $request, Response $response, $args) { //APAGAR DE ACORDO COM ID PASSADO NA ROTA
    $id = $args['id'];
    $booksdao = new booksDAO();
    $books = new Books("", "", ""); // Dummy data
    $books->setId($id);
    $booksdao->delete($books);
    return $response->withStatus(200);
 });

 $app->get('/books/{id}', function(Request $request, Response $response, $args) {
    $id = $args['id'];
    $booksdao = new booksDAO();
    $books = $booksdao->read($id);
    $response->getBody()->write(json_encode($books));
    return $response->withHeader('Content-type', 'application/json');

 });



$app->run();