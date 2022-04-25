<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Str;

class DocumentationPage
{
    public string $title;
    public string $filepath;
    public string $contents;
    public string $html;
    public array $data;

    public function __construct(?string $filepath = null)
    {
        if (isset($filepath)) {
            $this->filepath = $filepath;
        }
    }

    public function loadFromFile(): self
    {
        $document = (new MarkdownPreprocessor())->process(file_get_contents($this->filepath));
        $this->contents = $document->body();
        $this->data = $document->matter();
        $this->title = $this->data['title'] ??  $this->data['label'] ?? ucwords(basename($this->filepath, '.md'));

        return $this;
    }

    public function parseHtml(): self
    {
        $this->html = (new MarkdownConverter())->convert($this->contents);

        return $this;
    }

    public static function findOrFail(string $page): static
    {
        $filepath = resource_path("docs/$page.md");

        if (! file_exists($filepath)) {
            abort(404);
        }

        return new static($filepath);
    }

    public static function errorNotFoundDocument(?string $page = null): static
    {
        $document = new static();

        $document->title = '404 - Page not found';

        if (isset($page)) {
            $document->contents = "Page `$page` not found.";
        } else {
            $document->contents = 'Page not found.';
        }
        $document->parseHtml();

        return $document;
    }
}
