<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;

use \App\Models\UserModel;
use \App\Models\HomeModel;
use \App\Models\SingleProductModel;

session_start();

class SingleProductController extends Controller {

  	public function accueil(Request $request, Response $response, $args){
  		header("Access-Control-Allow-Origin: *");
       	$data = $request->getParsedBody();
        $params = json_decode($data['params']);

        return $response->withJson(array("message" => $params));

        // data = $request->getParsedBody();
        // $params = json_decode($data['params']);
        // return $response->withJson(array("id", $params));
    }


    public function produits(Request $request, Response $response, $args){
  		  header("Access-Control-Allow-Origin: *");

      	$homeModel = new HomeModel($this->db);
      	$getAllProds = $homeModel->produits();

      	return $response->withJson(array("datas"=> $getAllProds));
    }

    public function singleProduct(Request $request, Response $response, $args){
		    header("Access-Control-Allow-Origin: *");
       	$data = $request->getParsedBody();
        $params = json_decode($data['params']);

        $singleProductModel = new SingleProductModel($this->db);
        $prod = $singleProductModel->getProd(intval($params->idProd));
        return $response->withJson(array("message" =>$prod));
    }
 
}