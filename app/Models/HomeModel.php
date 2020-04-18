<?php

namespace App\Models;



class HomeModel {
	private $_db = null;

	public function __construct($db){
		$this->_db = $db;
	}

	public function produits(){
		$produits = array();
		$q = $this->_db->query('SELECT * FROM Produit u where u.quantite > 0');
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}

	// public function produit($idProd){
	// 	$produit = null;

	// 	$q = $this->_db->prepare('SELECT * FROM Produit u where u.idProd=:idProd');
	// 	$q->execute(array(':idProd' => intval($idProd)));

	// 	$produit = $q->fetch();

	// 	$q->closeCursor();
	// 	return $idProd;
	// }

	public function produit($id){
		$produits = array();
		$q = $this->_db->prepare("SELECT u.* FROM Produit u where u.idProd=:idProd");
		$q->execute(array(':idProd' => intval($id)));
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}

	public function produitsNext($id){
		$produits = array();
		$q = $this->_db->prepare('SELECT u.* FROM Produit u where u.idProd>:idProd AND u.quantite > 0');
		$q->execute(array(':idProd' => intval($id)));
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}

	public function produitsNextMotif($id,$motif){
		$produits = array();
		$q = $this->_db->prepare("SELECT u.* FROM Produit u where u.idProd>:idProd AND u.quantite > 0 AND u.descriptionProd LIKE '%".$motif."%'");
		$q->execute(array(':idProd' => intval($id)));
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}

	public function insertCommande($id_Client,$tel,$email){
		$q = $this->_db->prepare('INSERT INTO Commande SET id_Client=:id_Client,email=:email,tel=:tel,created_at=NOW() , updated_at=NOW()');
        $q->execute(array(':id_Client'=>$id_Client,':email'=>$email,':tel'=>$tel));

        return $this->_db->lastInsertId();
	}

	public function insertListeProdsCom($idProd,$quantite, $email,$prix,$id_com){
		$produits = array();

		$q = $this->_db->prepare('INSERT INTO ListeProdsCom SET id_prod=:id_prod, id_com=:id_com, quantite=:quantite , prix=:prix , etat=:etat,created_at=NOW() , updated_at=NOW()');
        $q->execute(array(':id_prod'=>$idProd, ':id_com'=>$id_com, ':quantite'=>$quantite, ':prix'=>$prix, ':etat'=>0));

        return $this->_db->lastInsertId();
	}



	public function produitsMotif($motif){
		$produits = array();
		$q = $this->_db->prepare("SELECT u.* FROM Produit u where u.quantite > 0 AND u.descriptionProd LIKE '%".$motif."%'");
		$q->execute();
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}


}