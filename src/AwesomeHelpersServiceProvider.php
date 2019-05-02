<?php

namespace Calebporzio\AwesomeHelpers;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Illuminate\Support\ServiceProvider;

class AwesomeHelpersServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Str::mixin(new StrMacros);

        Collection::mixin(new CollectionMacros);

        foreach (scandir(__DIR__.DIRECTORY_SEPARATOR.'helpers') as $helperFile) {
            $path = sprintf(
                '%s%s%s%s%s',
                __DIR__,
                DIRECTORY_SEPARATOR,
                'helpers',
                DIRECTORY_SEPARATOR,
                $helperFile
            );

            if (! is_file($path)) {
                continue;
            }

            $function = str_before($helperFile, '.php');

            if (! function_exists($function)) {
                require($path);
            }
        }
    }
}
