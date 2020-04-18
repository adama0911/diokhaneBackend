<?php
namespace App\Controllers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Message\ResponseInterface as Response;

use \App\Controller;

use \App\Models\UserModel;
use \App\Models\HomeModel;

session_start();

class HomeController extends Controller {

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

    public function produitsNext(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");

        $data = $request->getParsedBody();
        $idProd = $data['idProd'];

        $homeModel = new HomeModel($this->db);
        $getAllProds = $homeModel->produitsNext($idProd);

        return $response->withJson(array("datas"=> $getAllProds));
    }


    public function produitsNextMotif(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");

        $data = $request->getParsedBody();
        $idProd = $data['idProd'];
        $motif = $data['motif'];



        $homeModel = new HomeModel($this->db);
        $getAllProds = $homeModel->produitsNextMotif($idProd,$motif);

        return $response->withJson(array("datas"=> $getAllProds));
    }

    public function vendre(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");

        $data = $request->getParsedBody();

        $idProd = intval($data['idProd']);
        $quantite = intval($data['quantite']);
        $tel = intval($data['tel']);
        $email = $data['email'];


        $homeModel = new HomeModel($this->db);
        $prod = json_encode($homeModel->produit($idProd));

        $id_com = $homeModel->insertCommande($tel,$tel,$email);

        if($prod!=null){
                $prix = intval($prod['prix']) * $quantite;

                $insertListeProdsCom = $homeModel->insertListeProdsCom($idProd,$quantite , $email,$prix,$id_com);

                return $response->withJson(array("datas"=> array("message"=>"OK")));
        }


        return $response->withJson(array("datas"=> array("message"=>"NO")));
    }

    public function produitsMotif(Request $request, Response $response, $args){
        header("Access-Control-Allow-Origin: *");

        $data = $request->getParsedBody();
        $motif = $data['motif'];

        $homeModel = new HomeModel($this->db);
        $getAllProds = $homeModel->produitsMotif($params->motif);

        return $response->withJson(array("datas"=> $getAllProds));
    }

    public function cart(Request $request, Response $response, $args){
		header("Access-Control-Allow-Origin: *");
       	$data = $request->getParsedBody();
        $params = json_decode($data['params']);
        $_SESSION['idProd'] = $params->idProd;
        return $response->withJson(array("message" =>$_SESSION['idProd']));

    }

    public function wishlist(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
        $data = $request->getParsedBody();
        $params = json_decode($data['params']);
        $_SESSION['idProd'] = $params->idProd;
        return $response->withJson(array("message" =>$_SESSION['idProd']));
    }
    public function compare(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
        $data = $request->getParsedBody();
        $params = json_decode($data['params']);
        $_SESSION['idProd'] = $params->idProd;
        return $response->withJson(array("message" =>$_SESSION['idProd']));
    }
    public function singleProduct(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
        $data = $request->getParsedBody();
        $params = json_decode($data['params']);
        $_SESSION['idProd'] = $params->idProd;
        if($params->quantite){
           $_SESSION['quantiteProd'] = $params->quantite;
            return $response->withJson(array("idProd" =>$_SESSION['idProd'], "quantite" =>$_SESSION['quantiteProd']));
        }
        return $response->withJson(array("message" =>$_SESSION['idProd']));
    }

     public function achat(Request $request, Response $response, $args){
      header("Access-Control-Allow-Origin: *");
        $data = $request->getParsedBody();
        $params = json_decode($data['params']);

        return $response->withJson(array("message" =>'OK', "idProd" => $params->idProd, "quantite" => $params->quantite));
    }    
}