<?php

return [

    'topbar' => [
        'logo' => config('app.name').' página de inicio',
        'search' => 'Búsqueda',
        'language' => 'Configuración de ubicación e idioma',
    ],

    'footer' => [
        'privacy' => 'Política de privacidad',
        'terms' => 'Términos y condiciones',
    ],

    'home' => [
        'title' => 'Encuentra <em>todas</em> las <span class="text-teal-500 inline-block font-extrabold">Things</span> Needed',
        'recently' => 'Últimos artículos agregados',
    ],

    'privacy' => [
        'title' => 'Política de privacidad',
    ],

    'page' => [
        'read' => 'Lectura de :minute minutos',
        'author' => 'Recopilado por',
        'tips' => [
            'id' => 'Consejos',
            'title' => 'Consejos adicionales',
        ],
        'steps' => [
            'id' => 'Pasos',
            'title' => 'Paso a paso',
        ],
        'related' => [
            'id' => 'Related',
            'title' => 'Cosas necesarias para otras cosas',
        ],
        'amazon' => [
            'buy' => 'Compra en Amazon',
            'disclaimer' => config('app.name').' es participante del Programa de Asociados de Amazon Services LLC, un programa de publicidad de afiliados diseñado para proporcionar a los sitios web un medio para obtener comisiones por publicidad mediante la publicidad y el enlace a su sitio web local de Amazon.',
        ],
        'legal' => 'Podría haber requisitos adicionales importantes (incluidos legales). Se recomienda realizar más investigaciones para asegurarse de que tiene todo lo que necesita.',
        'disclaimer' => 'No ofrecemos ninguna declaración ni garantía, ya sea expresa o implícita, de que el contenido de esta página sea preciso, completo o esté actualizado.',
    ],

    'category' => [
        'intro' => 'Las :count páginas de la categoría <em class="text-teal-600 font-semibold">:category</em>.',
    ],

    'tag' => [
        'intro' => 'Las :count páginas que contienen la etiqueta <em class="text-teal-600 font-semibold">:tag</em>.',
    ],

    'search' => [
        'title' => 'Búsqueda',
        'button' => 'Buscar',
        'placeholder' => 'Introducir palabras clave...',
        'noresults' => 'Lo sentimos, no se han encontrado artículos.',
    ],

    'image' => [
        'representing' => 'Imagen que representa :image',
    ],

];
