<?php

return [

    'topbar' => [
        'logo' => config('app.name').' homepage',
        'search' => 'Search',
        'language' => 'Location and language settings',
    ],

    'footer' => [
        'privacy' => 'Privacy Policy',
        'terms' => 'Terms & Conditions',
    ],

    'home' => [
        'title' => 'Find <em>all</em> the <span class="text-teal-500 inline-block font-extrabold">Things</span> Needed',
        'recently' => 'Recently added articles',
    ],

    'page' => [
        'read' => ':minute minute read',
        'author' => 'Collated by',
        'tips' => [
            'id' => 'Tips',
            'title' => 'Additional tips',
        ],
        'steps' => [
            'id' => 'Steps',
            'title' => 'Step by step guide',
        ],
        'related' => [
            'id' => 'Related',
            'title' => 'Things needed for other things',
        ],
        'amazon' => [
            'buy' => 'Buy on Amazon',
            'disclaimer' => config('app.name').' is a participant in the Amazon Services LLC Associates Program, an affiliate advertising program designed to provide a means for sites to earn advertising fees by advertising and linking to your local Amazon website.',
        ],
        'legal' => 'There maybe additional important (including legal) requirements. Further research is encouraged to ensure you have everything you need.',
        'disclaimer' => 'We make no representations or guarantees, whether expressed or implied, that the content on this page is accurate, complete or up-to-date.',
    ],

    'category' => [
        'intro' => 'All :count pages in the <em class="text-teal-600 font-semibold">:category</em> category.',
    ],

    'tag' => [
        'intro' => 'All :count pages featuring the <em class="text-teal-600 font-semibold">:tag</em> tag.',
    ],

    'search' => [
        'title' => 'Search',
        'button' => 'Go',
        'placeholder' => 'Enter keywords...',
        'noresults' => 'Sorry, no articles could be found.',
    ],

    'image' => [
        'representing' => 'Image representing :image',
    ],

];
