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

    'resource-views' => base_path('resources/views/admin/process-managers'),


    'auth' => 'admin',
    'route' =>'.process-managers',
];
