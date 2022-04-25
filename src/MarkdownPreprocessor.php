<?php

namespace DeSilva\Lagrafo;

use Spatie\YamlFrontMatter\Document;
use Spatie\YamlFrontMatter\YamlFrontMatter;

class MarkdownPreprocessor
{
    public function process(string $markdown): Document
    {
        return YamlFrontMatter::markdownCompatibleParse($markdown);
    }
}
