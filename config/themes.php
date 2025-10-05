<?php

use Heidkaemper\StatamicThemes\Themes;

return [

    /*
    |--------------------------------------------------------------------------
    | Statamic Themes
    |--------------------------------------------------------------------------
    |
    | Here you may specify additional themes to be used within the Statamic
    | Control Panel. The theme configured in `config/statamic/cp.php` will
    | be used as the default.
    |
    */

    'additional_themes' => [
        ...Themes::Statamic5,

        // 'custom-theme' => [
        //     'display' => 'Awesome Theme',
        //     'theme' => [
        //         'primary' => \Statamic\CP\Color::Red[500],
        //         'body-bg' => '#ff0',
        //         ...
        //     ],
        //     'file' => 'path/to/additional/theme-file.css',
        // ],
    ],
];
