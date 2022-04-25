<?php

namespace DeSilva\Lagrafo;

class DocumentationPage
{
    protected string $title;
    protected string $filepath;
    protected string $contents;
    protected string $html;

    public function __construct(string $filepath)
    {
        $this->filepath = $filepath;
    }

    public function loadContents(): self
    {
        $this->contents = file_get_contents($this->filepath);

        return $this;
    }

    public function parseTitle(): self
    {
        // TODO: Implement parseTitle() method.
        $this->title = basename($this->filepath, '.md');

        return $this;
    }

    public function parseHtml(): self
    {
        // TODO: Implement parseHtml() method.
        $this->html = $this->contents;

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
