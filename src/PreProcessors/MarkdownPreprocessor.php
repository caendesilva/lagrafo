<?php

namespace DeSilva\Lagrafo\PreProcessors;

use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class MarkdownPreprocessor
{
    protected array $shortcodes = [];

    public function process(string $markdown): Document
    {
        return YamlFrontMatter::markdownCompatibleParse($this->preprocess($markdown));
    }

    protected function preprocess(string $markdown): string
    {
        $lines = explode("\n", $markdown);

        // Expand shortcodes
        $this->shortcodes = $this->initializeShortcodes();
        foreach ($lines as $index => $line) {
            if (! str_starts_with($line, '::')) {
                continue;
            }

            $lines[$index] = $this->expandShortcode($line);
        }

        return implode("\n", $lines);
    }

    protected function initializeShortcodes(): array
    {
        $shortcodes = [];

        $shortcodes['::info'] = new Shortcode('::info', '<blockquote class="blockquote-info">', '</blockquote>');

        return $shortcodes;
    }

    protected function expandShortcode(string $line): string
    {
        // Split shortcode from content by getting everything before the first space
        $key = substr($line, 0, strpos($line, ' '));

        if (! isset($this->shortcodes[$key])) {
            return $line;
        }

        $shortcode = $this->shortcodes[$key];

        $line = str_replace($key, '', $line);

        return $shortcode->open . $line . $shortcode->close;
    }
}
