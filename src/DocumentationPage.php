<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Str;

class DocumentationPage
{
    public string $title;
    public string $filepath;
    public string $contents;
    public string $html;

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
