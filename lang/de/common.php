<?php

return [

    'topbar' => [
        'logo' => config('app.name').' homepage',
        'search' => 'Suche',
        'language' => 'Standort- und Spracheinstellungen',
    ],

    'footer' => [
        'privacy' => 'Datenschutzerklärung',
        'terms' => 'Allgemeine Geschäftsbedingungen',
    ],

    'home' => [
        'title' => 'Finde <em>alle</em> <span class="text-teal-500 inline-block font-extrabold">Things</span> Needed',
        'recently' => 'Neueste Artikel',
    ],

    'page' => [
        'read' => ':minute minuten lesezeit',
        'author' => 'Zusammengestellt von',
        'tips' => [
            'id' => 'Tipps',
            'title' => 'Zusätzliche tipps',
        ],
        'steps' => [
            'id' => 'Schritte',
            'title' => 'Schritt-für-Schritt-Anleitung',
        ],
        'related' => [
            'id' => 'Related',
            'title' => 'Für anderes benötigte Dinge',
        ],
        'amazon' => [
            'buy' => 'Auf Amazon kaufen',
            'disclaimer' => config('app.name').' ist Teilnehmer am Amazon Services LLC Associates Program, einem Partnerwerbeprogramm, das zur Bereitstellung einer Möglichkeit für Websites entwickelt wurde, Werbeeinnahmen durch Werbung und Verlinkung mit Ihrer lokalen Amazon-Website zu erzielen.',
        ],
        'legal' => 'Es bestehen möglicherweise weitere wichtige (einschließlich rechtlicher) Anforderungen. Weiterführende Recherchen werden empfohlen, um sicherzustellen, dass Sie alles Notwendige haben.',
        'disclaimer' => 'Wir geben keinerlei Zusicherungen oder Gewährleistungen, weder ausdrücklich noch stillschweigend, dass die Inhalte auf dieser Seite korrekt, vollständig oder aktuell sind.',
    ],

    'category' => [
        'intro' => 'Alle :count Seiten in der Kategorie <em class="text-teal-600 font-semibold">:category</em>.',
    ],

    'tag' => [
        'intro' => 'Alle :count Seiten, die das <em class="text-teal-600 font-semibold">:tag</em>-Tag enthalten.',
    ],

    'search' => [
        'title' => 'Suche',
        'button' => 'Suchen',
        'placeholder' => 'Suchbegriffe eingeben...',
        'noresults' => 'Leider konnten keine Artikel gefunden werden.',
    ],

    'image' => [
        'representing' => 'Bild, das :image darstellt',
    ],

];
