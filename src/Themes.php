<?php

namespace Heidkaemper\StatamicThemes;

class Themes
{
    public const Statamic5 = [
        'statamic5' => [
            'display' => 'Statamic 5',
            'theme' => [
                'primary' => 'oklch(0.6362 0.1586 249.36)',
                'body-bg' => 'oklch(0.9593 0.0069 247.9)',
                'dark-body-bg' => 'oklch(0.2395 0.0059 271.17)',
                'dark-body-border' => 'oklch(0.2139 0.0134 243.56)',
                'global-header-bg' => 'oklch(1 0 0)',
                'dark-global-header-bg' => 'oklch(0.2963 0.0061 258.36)',
                'content-bg' => 'transparent',
                'content-border' => 'oklch(0.913 0.0104 247.94)',
                'dark-content-bg' => 'transparent',
                'dark-content-border' => 'oklch(0.3006 0.0023 247.9)',
                'switch-bg' => 'oklch(72.3% 0.219 149.579)',
                'dark-switch-bg' => 'oklch(62.7% 0.194 149.214)',
                'gray-50' => 'oklch(0.9904 0.0045 258.32)',
                'gray-100' => 'oklch(0.975 0.0062 255.47)',
                'gray-200' => 'oklch(0.915 0.0115 252.09)',
                'gray-300' => 'oklch(0.8414 0.0142 248)',
                'gray-400' => 'oklch(0.6369 0.0235 246.02)',
                'gray-500' => 'oklch(0.5933 0.0239 246.06)',
                'gray-600' => 'oklch(0.3699 0.0198 227.56)',
                'gray-700' => 'oklch(0.3361 0.0163 221.87)',
                'gray-800' => 'oklch(0.2892 0.0277 227.65)',
                'gray-850' => 'oklch(0.2695 0.0241 223.43)',
                'gray-900' => 'oklch(0.2139 0.0134 243.56)',
                'gray-950' => 'oklch(0.2139 0.0134 243.56)',
            ],
            'file' => __DIR__ . '/../resources/css/statamic5.css',
        ],
    ];

    public const Rad = [
        'rad' => [
            'display' => 'Rad',
            'theme' => [
                'primary' => 'oklch(0.665 0.2571 354.12)',
                'global-header-bg' => 'transparent',
                'dark-global-header-bg' => 'transparent',
                'dark-content-bg' => 'transparent',
                'switch-bg' => 'oklch(0.665 0.2571 354.12)',
                'dark-switch-bg' => 'oklch(62.7% 0.194 149.214)',
            ],
            'file' => __DIR__ . '/../resources/css/rad.css',
        ],
    ];
}
