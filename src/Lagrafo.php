<?php

namespace DeSilva\Lagrafo;

/**
 * @todo Implement caching of compiled Markdown files.
 *       can be done by saving the compiled static HTML
 *       in the Laravel storage and proxying the request.
 *       
 *       Note that pages using custom content, such as injecting
 *       account information or API tokens must not be cached.
 */
class Lagrafo
{
    public function appName(): string
    {
        return config('app.name', 'Lagrafo') . ' Documentation';
    }

    public function route(string $destination): string
    {
        return route('docs', $destination);
    }

    public function styles(): string
    {
        return '<style>' . file_get_contents(__DIR__ . '/../dist/lagrafo.css') . '</style>';
    }
}
