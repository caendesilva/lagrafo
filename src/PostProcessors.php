<?php

namespace DeSilva\Lagrafo;

class PostProcessors
{
    protected static array $postProcessors = [
        //
    ];

    protected static array $authenticatedPostProcessors = [
        //
    ];

    public static function run($html): string
    {
        foreach (array_merge(self::$postProcessors, config('lagrafo.postProcessors')) as $class) {
            $html = (new $class)->process($html);
        }

        if (auth()->check()) {
            foreach (array_merge(self::$authenticatedPostProcessors,
                config('lagrafo.authenticatedPostProcessors')) as $class) {
                $html = (new $class(auth()->user()))->process($html);
            }
        }

        return $html;
    }
}
