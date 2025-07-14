<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Messages de validation
    |--------------------------------------------------------------------------
    */
    'accepted'             => 'Le champ :attribute doit être accepté.',
    'active_url'           => 'Le champ :attribute n\'est pas une URL valide.',
    'after'                => 'Le champ :attribute doit être une date postérieure à :date.',
    // ... [autres messages par défaut] ...

    /*
    |--------------------------------------------------------------------------
    | Messages personnalisés
    |--------------------------------------------------------------------------
    */
    'custom' => [
        'business_name' => [
            'required' => 'Veuillez renseigner le nom de votre entreprise',
            'max' => 'Le nom de l\'entreprise ne peut excéder 150 caractères',
        ],
        'email' => [
            'required' => 'L\'adresse email est obligatoire ',
            'unique' => 'Cette adresse email est déjà associée à un compte existant',
            'email' => 'Veuillez saisir une adresse email valide',
            'exists' => 'Aucun utilisateur correspondant'
        ],
        'password' => [
            'required' => 'Un mot de passe sécurisé est requis',
            'min' => 'Votre mot de passe doit contenir au minimum :min caractères',
        ],
        'owner_fullname' => [
            'required' => 'Le nom complet du responsable est obligatoire',
            'name' => 'Veuillez saisir un nom valide (caractères alphabétiques et espaces seulement)',
            'regex' => "Lettres,espaces et tirets uniquement autorisés"
        ],
        'business_img' => [
            'image' => 'Le fichier doit être une image (formats acceptés: jpg, png, gif,jpeg)',
            'max' => 'La taille de l\'image ne doit pas dépasser 2MB',
        ],
        'stand_name' => [
            'required' => 'Le nom du stand est requis',
            'max' => 'La taille de ce champ ne peut dépasser :max',
        ],
        'description' => [
            'required' => 'Vous devez fournir une description à votre stand',
            'max' => 'La taille de ce champ ne peut dépasser :max',
        ],
    ],

    /*
    |--------------------------------------------------------------------------
    | Noms d'attributs personnalisés
    |--------------------------------------------------------------------------
    */
    'attributes' => [
        'business_name' => 'Nom de l\'entreprise',
        'email' => 'Adresse email',
        'password' => 'Mot de passe',
        'owner_fullname' => 'Nom du responsable',
        'business_image' => 'Logo de l\'entreprise',
    ],

    /*
    |--------------------------------------------------------------------------
    | Messages de validation pour règles complexes (Password::min)
    |--------------------------------------------------------------------------
    */
    'password' => [
        'letters' => 'Le mot de passe doit contenir au moins une lettre',
        'mixed' => 'Le mot de passe doit contenir au moins une majuscule et une minuscule',
        'numbers' => 'Le mot de passe doit contenir au moins un chiffre',
        'symbols' => 'Le mot de passe doit contenir au moins un caractère spécial',
        'uncompromised' => 'Ce mot de passe a été compromis dans une fuite de données',
    ],
];