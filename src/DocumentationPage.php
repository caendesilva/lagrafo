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
    public int $priority;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function loadFromFile(): self
    {
        $document = (new MarkdownPreprocessor())->process(file_get_contents($this->filepath));
        $this->contents = $document->body();
        $this->data = $document->matter();
        $this->title = $this->data['title'] ?? ucwords(basename($this->filepath, '.md'));
        $this->priority = $this->data['priority'] ?? 500;

        return $this;
    }

    public function parseHtml(): self
    {
        // TODO: Implement parseHtml() method.
        $this->html = Str::markdown($this->contents);

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
}
