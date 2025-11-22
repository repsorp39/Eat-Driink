<?php

namespace App\Services;

class Calculatrice
{
    /**
     * Create a new class instance.
     */
    public function __construct()
    {
        //
    }

    static function division(int $diviseur, int $dividende){
        return $diviseur / $dividende;
    }
}
