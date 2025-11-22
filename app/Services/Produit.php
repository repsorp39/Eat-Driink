<?php

namespace App\Services;

class Produit
{
    /**
     * Create a new class instance.
     */

    public $nom, $prix;
    public function __construct($nom, $prix)
    {
        $this->nom = $nom;
        $this->prix = $prix;
    }
}
