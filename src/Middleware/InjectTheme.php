<?php

namespace Heidkaemper\StatamicThemes\Middleware;

use Closure;
use Heidkaemper\StatamicThemes\Manager;
use Statamic\Facades\Preference;

class InjectTheme
{
    public function handle($request, Closure $next)
    {
        $theme = Preference::get('base_theme', 'default');

        if ($theme === 'default') {
            return $next($request);
        }

        Manager::set($theme);

        return $next($request);
    }
}
