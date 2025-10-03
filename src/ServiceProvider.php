<?php

namespace Heidkaemper\StatamicThemes;

use Heidkaemper\StatamicThemes\Middleware\InjectTheme;
use Statamic\Facades\Preference;
use Statamic\Providers\AddonServiceProvider;
use Statamic\Statamic;

class ServiceProvider extends AddonServiceProvider
{
    protected $middlewareGroups = [
        'statamic.cp.authenticated' => [
            InjectTheme::class,
        ],
    ];

    public function bootAddon()
    {
        Preference::extend(function () {
            $options = collect(Manager::all())
                ->mapWithKeys(fn ($theme, $key) => [$key => $theme['display']])
                ->prepend(__('Default'), 'default')
                ->all();

            return [
                'general' => [
                    'fields' => [
                        'base_theme' => [
                            'type' => 'select',
                            'display' => __('Theme'),
                            'instructions' => __('themes::general.instructions'),
                            'default' => 'default',
                            'options' => $options,
                        ],
                    ],
                ],
            ];
        });
    }

    protected function bootConfig(): self
    {
        $this->mergeConfigFrom(__DIR__ . '/../config/themes.php', 'statamic.themes');

        $this->publishes([
            __DIR__ . '/../config/themes.php' => config_path('statamic/themes.php'),
        ], 'statamic-themes-config');

        Statamic::afterInstalled(function ($command) {
            $command->call('vendor:publish', ['--tag' => 'statamic-themes-config']);
        });

        return $this;
    }

    protected function bootTranslations(): self
    {
        $this->loadTranslationsFrom(__DIR__ . '/../lang', 'themes');

        $this->publishes([
            __DIR__ . '/../lang' => app()->langPath() . '/vendor/statamic-themes',
        ], 'statamic-themes-translations');

        return $this;
    }
}
