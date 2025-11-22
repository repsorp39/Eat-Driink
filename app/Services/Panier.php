<?php

namespace App\Services;

class Panier
{
    public $tabProduct=[];

    public function ajouterProduit(Produit $product, $quantite = 1){
        $id = $product->nom;

        if (isset($this->tabProduct[$id])) {
            $this->tabProduct[$id]['quantite']++;
        }
        else {
            $this->tabProduct[$id]["product"] = $product;
            $this->tabProduct[$id]["quantite"] = $quantite;
        }
    }

    public function supprimerProduit(string $id){
        if ($this->tabProduct[$id]["quantite"]>1) {
            $this->tabProduct[$id]["quantite"]--;
        }
        else{
            unset($this->tabProduct[$id]);    
        }
        
    }

    public function totalQuantite(){
        return array_sum(array_column($this->tabProduct, 'quantite'));
    }

    public function totalPrice(){
        $totalPrice=0;
        foreach($this->tabProduct as $product){
            $totalPrice += $product["quantite"] * $product["product"]->prix;
        }
        return $totalPrice;
    }

    public function getProduct(){
        return $this->tabProduct;
    }
}

