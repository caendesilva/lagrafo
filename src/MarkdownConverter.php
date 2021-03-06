<?php

namespace DeSilva\Lagrafo;

use League\CommonMark\Extension\Attributes\AttributesExtension;
use League\CommonMark\Extension\HeadingPermalink\HeadingPermalinkExtension;
use League\CommonMark\GithubFlavoredMarkdownConverter;
use Torchlight\Commonmark\V2\TorchlightExtension;
use League\CommonMark\Extension\DescriptionList\DescriptionListExtension;
use League\CommonMark\Extension\Footnote\FootnoteExtension;
use League\CommonMark\Extension\DisallowedRawHtml\DisallowedRawHtmlExtension;

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
        // Important: If your post-processor injects dynamic content, you may need to disable the cache
        $html = PostProcessors::run($html);

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
            'disallowed_raw_html' => [
                'disallowed_tags' => [],
            ],
        ];

        $converter = new GithubFlavoredMarkdownConverter($config);

        $converter->getEnvironment()->addExtension(new AttributesExtension);

        $converter->getEnvironment()->addExtension(new HeadingPermalinkExtension());
        $converter->getEnvironment()->addExtension(new TorchlightExtension());
        $converter->getEnvironment()->addExtension(new DescriptionListExtension());
        $converter->getEnvironment()->addExtension(new FootnoteExtension());
        $converter->getEnvironment()->addExtension(new DisallowedRawHtmlExtension());

        return $converter;
    }
}
