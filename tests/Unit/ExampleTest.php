<?php

namespace Tests\Unit;

use App\Services\Panier;
use App\Services\Produit;
use PHPUnit\Framework\TestCase;

class ExampleTest extends TestCase
{
    // protected Panier $panier ;
    // protected function setUp(): void{
    //     $this-> panier = new Panier();
    // }

    // public function test_ajouter_un_produit_au_panier(){
    //     $panier = new Panier();
    //     $produit =  new Produit("Mangue", 3500);
    //     $panier->ajouterProduit($produit, 80);
    //     $this->assertTrue(count($panier->tabProduct) == 1);
    //     $this->assertArrayHasKey("Mangue",$panier->tabProduct);
    // }

    // public function test_quantite_incrementee_apres_un_nouvel_ajout(){
    //     $panier = new Panier();
    //     $produit =  new Produit("Rice", 100);
    //     $panier->ajouterProduit($produit);
    //     $panier->ajouterProduit($produit);
    //     $quantite = $panier->tabProduct['Rice']['quantite'];
    //     $this->assertEquals(2, $quantite);
    // }

    // public function test_produit_supprimer(){
    //     $panier = new Panier();
    //     $produit =  new Produit("Rice", 100);
    //     $panier->ajouterProduit($produit);
    //     $panier->ajouterProduit($produit);
    //     $panier->supprimerProduit("Rice");
    //     $quantite = $panier->tabProduct['Rice']['quantite'];
    //     $this->assertEquals(1,$quantite);
    //     $panier->supprimerProduit("Rice");
    //     $this->assertArrayNotHasKey("Rice",$panier->tabProduct);
    // }

    // public function test_produit_is_added(){
    //     $panier = new Panier();
    //     $panier->ajouterProduit(new Produit("Pomme", 2500), 2);
    //     $this->assertTrue(count($panier->tabProduct) == 1);
    // }

}