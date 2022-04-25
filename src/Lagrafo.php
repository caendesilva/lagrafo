<?php

namespace DeSilva\Lagrafo;

/**
 * @todo Implement caching of compiled Markdown files.
 *       can be done by saving the compiled static HTML
 *       in the Laravel storage and proxying the request.
 */
class Lagrafo
{
    // Build your next great package.
    public function route(string $destination): string
    {
        return route('docs', $destination);
    }
}
