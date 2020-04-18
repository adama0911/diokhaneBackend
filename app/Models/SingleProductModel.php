<?php

namespace App\Models;



class SingleProductModel {
	private $_db = null;

	public function __construct($db){
		$this->_db = $db;
	}

    public function getProd($id){
        $q = $this->_db->prepare('SELECT p.* FROM Produit p WHERE p.idProd=:id');
        $q->execute(array(':id' => $id));
        $prod = $q->fetch();
        return $prod;
    }


}