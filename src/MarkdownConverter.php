<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Str;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Torchlight\Commonmark\V2\TorchlightExtension;

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
        $config = [
            'heading_permalink' =>[
                'id_prefix' => '',
                'fragment_prefix' => '',
                'symbol' => '',
            ],
        ];

        $converter = new GithubFlavoredMarkdownConverter($config);

        $converter->getEnvironment()->addExtension(new AttributesExtension);

        $converter->getEnvironment()->addExtension(new HeadingPermalinkExtension());
        $converter->getEnvironment()->addExtension(new TorchlightExtension());

        return $converter;
    }
}
