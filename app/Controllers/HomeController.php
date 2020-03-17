<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;

use \App\Models\UserModel;


class HomeController extends Controller {

  	public function accueil(Request $request, Response $response, $args){
        return $response->withJson(array("message", "WELCOME"));

        // data = $request->getParsedBody();
        // $params = json_decode($data['id']);
        // return $response->withJson(array("id", $params));
    }
    
}