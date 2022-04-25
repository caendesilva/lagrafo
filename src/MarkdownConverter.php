<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * Convert a Markdown string to HTML using the CommonMark converter loaded in the Lagrafo Singleton.
 */
class MarkdownConverter
{
    /**
     * Convert a Markdown string to HTML.
     *
     * @param string $markdown
     *
     * @return string
     */
    public function convert(string $markdown): string
    {
        // Convert
        $html = \Lagrafo::getInstance()->markdownConverter->convertToHtml($markdown);

        // Run any post-processors

        // Return HTML
        return $html;
    }

    /**
     * Create a new Markdown converter instance.
     * @return GithubFlavoredMarkdownConverter
     */
    public static function create(): GithubFlavoredMarkdownConverter
    {
        $converter = new GithubFlavoredMarkdownConverter([
            'html_input' => 'strip',
            'allow_unsafe_links' => false,
        ]);

        return $converter;
    }
}
