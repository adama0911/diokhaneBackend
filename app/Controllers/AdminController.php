<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;
use \App\Models\AdminModel;

session_start();

class AdminController extends Controller {

  	public function addprod(Request $request, Response $response, $args){
  		header("Access-Control-Allow-Origin: *");
        

        $data = $request->getParsedBody();
        $params = json_decode($data['params']);

        $adminModel = new AdminModel($this->db);
      	$getAllProds = $adminModel->produits();
        
        return $response->withJson(array("id", $params));
    }


    public function confirmerAchat(Request $request, Response $response, $args){
  		  header("Access-Control-Allow-Origin: *");
        

        $data = $request->getParsedBody();
        $idProd = intval($data['idProd']);
        $idListeCom = intval($data['idListeCom']);
        $statut = intval($data['statut']);
        // $quantite = intval($data['quantite']);

        $adminModel = new AdminModel($this->db);

      	$modifStatutCom = $adminModel->modifStatutCom($idListeCom,$statut);
      	// $adminModel->modifQuantiteStok($idProd,$quantite);
        
        return $response->withJson(array("confirmation", $modifStatutCom));
    }

    public function produits(Request $request, Response $response, $args){
  		header("Access-Control-Allow-Origin: *");

      	$adminModel = new AdminModel($this->db);
      	$getAllProds = $adminModel->produits();

      	return $response->withJson(array("datas"=> $getAllProds));
    }

    


    
}