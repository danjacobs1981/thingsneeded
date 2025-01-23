<?php

return [

    'topbar' => [
        'logo' => config('app.name').' page d\'accueil',
        'search' => 'Recherche',
        'language' => 'Paramètres de lieu et de langue',
    ],

    'footer' => [
        'privacy' => 'Politique de confidentialité',
        'terms' => 'Conditions générales d\'utilisation',
    ],

    'home' => [
        'title' => 'Trouvez <em>toutes</em> les <span class="text-teal-500 inline-block font-extrabold">Things</span> Needed',
        'recently' => 'Derniers articles ajoutés',
    ],

    'privacy' => [
        'title' => 'Politique de confidentialité',
    ],

    'page' => [
        'read' => 'Lecture de :minute minutes',
        'author' => 'Compilé par',
        'tips' => [
            'id' => 'Conseils',
            'title' => 'Conseils supplémentaires',
        ],
        'steps' => [
            'id' => 'Étapes',
            'title' => 'Guide étape par étape',
        ],
        'related' => [
            'id' => 'Related',
            'title' => 'Choses nécessaires pour d\'autres choses',
        ],
        'amazon' => [
            'buy' => 'Acheter sur Amazon',
            'disclaimer' => config('app.name').' participe au programme Amazon Services LLC Associates, un programme de publicité par affiliation conçu pour permettre aux sites de gagner des commissions publicitaires en faisant de la publicité et en créant des liens vers votre site Amazon local.',
        ],
        'legal' => 'Il peut exister des exigences supplémentaires importantes (y compris légales). Des recherches complémentaires sont encouragées afin de vous assurer que vous avez tout le nécessaire.',
        'disclaimer' => 'Nous ne faisons aucune déclaration ni ne donnons aucune garantie, expresse ou implicite, que le contenu de cette page soit exact, complet ou à jour.',
    ],

    'category' => [
        'intro' => 'Les :count pages de la catégorie <em class="text-teal-600 font-semibold">:category</em>.',
    ],

    'tag' => [
        'intro' => 'Les :count pages comportant le tag <em class="text-teal-600 font-semibold">:tag</em>.',
    ],

    'search' => [
        'title' => 'Recherche',
        'button' => 'Chercher',
        'placeholder' => 'Saisir des mots-clés...',
        'noresults' => 'Désolé, aucun article n\'a été trouvé.',
    ],

    'image' => [
        'representing' => 'Image représentant :image',
    ],

];
