<?php

namespace App\Models;



class AdminModel {
	private $_db = null;

	public function __construct($db){
		$this->_db = $db;
	}

	public function produits(){
		$produits = array();
		$q = $this->_db->query('SELECT u.*,l.idListeProdsCom ,l.id_prod, l.id_com, l.quantite AS quantiteCom, l.prix AS prixCom, l.etat, l.created_at AS dateCom FROM Produit u , ListeProdsCom l where u.quantite > 0 AND u.idProd=l.id_prod AND l.etat=0');
		while( $user = $q->fetch() ){
			$produits[] = $user;
		}
		$q->closeCursor();
		return $produits;
	}

	public function modifStatutCom($idListeCom,$statut){
		$q = $this->_db->prepare('UPDATE ListeProdsCom u SET u.etat=:statut WHERE u.idListeProdsCom=:idListeCom');
        
        $rep = $q->execute(array(':statut' => $statut, ':idListeCom' => $idListeCom));
		
		$q->closeCursor();
		
		if(!$rep){
			return array(
	            "errorCode" => true,
	            "confirmer" => false
	        );
		}

		return array(
            "errorCode" => false,
            "confirmer" => true
        );
	}
	

	public function modifQuantiteStok($idProd,$quantite){
		// $produits = array();
		// $q = $this->_db->query('SELECT u.*,l.idListeProdsCom ,l.id_prod, l.id_com, l.quantite AS quantiteCom, l.prix AS prixCom, l.etat, l.created_at AS dateCom FROM Produit u , ListeProdsCom l where u.quantite > 0 AND u.idProd=l.id_prod');
		// while( $user = $q->fetch() ){
		// 	$produits[] = $user;
		// }
		// $q->closeCursor();
		// return $produits;
	}

	


}