<?php

namespace Heidkaemper\StatamicThemes;

use Heidkaemper\StatamicThemes\Exceptions\ThemeException;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\View;
use Statamic\Facades\Config;

class Manager
{
    public static function all(): array
    {
        return config('statamic.themes.themes') ?? [];
    }

    public static function find(string $key): ?array
    {
        return self::all()[$key] ?? null;
    }

    public static function set(string $key): void
    {
        $theme = self::find($key);

        if (! $theme) {
            return;
        }

        Config::set('statamic.cp.theme', $theme['theme'] ?? []);

        if ($theme['file']) {
            self::pushCss($theme['file']);
        }
    }

    protected static function pushCss(string $file): void
    {
        try {
            $path = is_file($file) ? $file : base_path($file);

            if (! is_file($path)) {
                throw new ThemeException("Unable to locate theme file: {$file}");
            }

            $css = file_get_contents($path);

            View::startPush('head', "<style>{$css}</style>");
        } catch (\Exception $e) {
            throw_if(config('app.debug'), $e);

            Log::debug($e->getMessage());
        }
    }
}
