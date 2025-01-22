<?php

return [

    'topbar' => [
        'logo' => config('app.name').' homepage',
        'search' => 'Ricerca',
        'language' => 'Impostazioni di posizione e lingua',
    ],

    'footer' => [
        'privacy' => 'Politica sulla privacy',
        'terms' => 'Termini e condizioni',
    ],

    'home' => [
        'title' => 'Trova <em>tutte</em> le <span class="text-teal-500 inline-block font-extrabold">Things</span> Needed',
        'recently' => 'Articoli aggiunti di recente',
    ],

    'page' => [
        'read' => ':minute minuti di lettura',
        'author' => 'Raccolto da',
        'tips' => [
            'id' => 'Suggerimenti',
            'title' => 'Suggerimenti aggiuntivi',
        ],
        'steps' => [
            'id' => 'Passi',
            'title' => 'Guida passo passo',
        ],
        'related' => [
            'id' => 'Related',
            'title' => 'Elementi necessari per altre cose',
        ],
        'amazon' => [
            'buy' => 'Compra su Amazon',
            'disclaimer' => config('app.name').' partecipa al programma Amazon Services LLC Associates, un programma di pubblicità affiliata progettato per fornire ai siti un mezzo per guadagnare commissioni pubblicitarie pubblicizzando e collegandosi al tuo sito web Amazon locale.',
        ],
        'legal' => 'Potrebbero esserci ulteriori requisiti importanti (inclusi quelli legali). Si consiglia di effettuare ulteriori ricerche per assicurarsi di avere tutto il necessario.',
        'disclaimer' => 'Non forniamo alcuna dichiarazione o garanzia, espressa o implicita, che il contenuto di questa pagina sia accurato, completo o aggiornato.',
    ],

    'category' => [
        'intro' => 'Tutte le :count pagine nella categoria <em class="text-teal-600 font-semibold">:category</em>.',
    ],

    'tag' => [
        'intro' => 'Tutte le :count agine con il tag <em class="text-teal-600 font-semibold">:tag</em>.',
    ],

    'search' => [
        'title' => 'Ricerca',
        'button' => 'Cerca',
        'placeholder' => 'Inserisci parole chiave...',
        'noresults' => 'Spiacenti, nessun articolo trovato.',
    ],

    'image' => [
        'representing' => 'Immagine che rappresenta :image',
    ],

];
