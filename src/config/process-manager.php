<?php

return [
    'views' => [
        /*
        |--------------------------------------------------------------------------
        | Edit to set the views data
        |--------------------------------------------------------------------------
        */

        'extend' => 'admin.app',
        'content' => 'content',
        'parsley' => 'content',
    ],

    'auth' => 'admin',
    'route' =>'.process-managers',
];
