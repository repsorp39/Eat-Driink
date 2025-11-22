<?php

namespace App;

class Panier
{
    /**
     * Create a new class instance.
     */
    public $produitPaniers;

    public function __construct()
    {
        $this->produitPaniers = [];
    }

    public function add($nom,$quantity,$pu){
        foreach($this->produitPaniers as $product){
            if($product->nom === $nom){
                exit("Ce produit existe déjà");
            }
        }
        $this->produitPaniers[] =  new Produit($nom,$quantity,$pu);
        echo "\nProduit ajouter!\n";
    }

    public function delete($nom){
        $this->produitPaniers = array_filter($this->produitPaniers, function($p) use ($nom){
            return $p->nom !== $nom;
        });
    }

    public function increment($nom){
        foreach($this->produitPaniers as $product){
            if($product->nom === $nom){
                $product->increment();
            }
        }
    }

    public function getTotal(){
        $total = 0;
        foreach($this->produitPaniers as $product){
            $total += $product->getMontant();
        }
        echo $total . "FCFA dans votre panier";
    }

    public function afficher(){
        foreach($this->produitPaniers as $product){
            echo "Nom ". $product->nom . "\n";
            echo "Qte ". $product->quantity . "\n";
        }
    }
}


class Produit
{
    /**
     * Create a new class instance.
     */
    public  $nom, $quantity, $pu;

    public function __construct($nom, $quantity, $pu)
    {
        $this->nom = $nom;
        $this->quantity = $quantity;
        $this->pu = $pu;
    }

    public function increment(){
        $this->quantity++;
    }

    public function getMontant(){
        return $this->pu * $this->quantity;
    }
}


$isRunning = true;
$Panier = new Panier();

while($isRunning){
    print("1-Ajouter un produit\n");
    print("2-Incrementer une quantite\n");
    print("3-Total Panier\n");
    print("4-Afficher\n");
    print("5-Fin\n");

    $option = readline("Votre choix:-->\t");

    if($option == 1){
        $nom = readline("\nNom du produit: -->");
        $qte = readline("\nquantite du produit: -->");
        $pu = readline("\nPrix unitaire du produit:-->");

        $Panier->add($nom, $qte, $pu);
    }elseif($option  == 2) {
         $nom = readline("\nNom du produit: -->");
         $Panier->increment($nom);
    }else if($option == 3){
        $Panier->getTotal();
    }
    else if($option == 4){
        $Panier->afficher();
    }
    else{
        exit("Byye");
    }
}
