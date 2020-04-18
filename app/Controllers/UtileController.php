<?php

namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;

use \App\Models\HomeModel;


class UtileController extends Controller {

  	public function home(Request $request, Response $response, $args){
  		header("Access-Control-Allow-Origin: *");
  		$data = $request->getBody();
  		$params = $data['user'];

  		return $response->withJson(array("response"=> "OK", "datas" => $params));
    }
    
}