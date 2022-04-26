<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Collection;
use League\CommonMark\GithubFlavoredMarkdownConverter;

/**
 * @todo Implement caching of compiled Markdown files.
 *       can be done by saving the compiled static HTML
 *       in the Laravel storage and proxying the request.
 *
 *       Note that pages using custom content, such as injecting
 *       account information or API tokens must not be cached.
 *
 * @todo Add support for nested pages.
 * @todo Add CommonMark extensions.
 *
 * @info A note about extensions: Lagrafo uses a lot of extensions,
 *       which is okay as it assumes that the end result will be cached,
 *       thus making any extension performance impact less of a concern.
 *       It also assumes that all Markdown input is safe and trusted.
 */
class Lagrafo
{
    /**
     * A mapping of all the Markdown pages. Used to generate the sidebar.
     */
    protected Collection $pages;

    /**
     * An index of page content mapped by page name, used for the search feature.
     * May very well be rather memory intensive and can be disabled in config.
     * For sites with a lot of pages/content, use Algolia instead.
     */
    protected Collection $searchIndex;

    public GithubFlavoredMarkdownConverter $markdownConverter;

    public function __construct()
    {
        $this->pages = $this->mapPages();
        $this->markdownConverter = MarkdownConverter::create();
    }

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
        if (app()->environment() === 'local') {
            return '<style>' . file_get_contents(__DIR__ . '/../dist/lagrafo.css') . '</style>';
        }

        return '<link rel="stylesheet" href="https://cdn.jsdelivr.net/gh/caendesilva/lagrafo@master/dist/lagrafo.min.css">';
    }

    public function scripts(): string
    {
        return '<script defer>' . file_get_contents(__DIR__ . '/../dist/lagrafo.js') . '</script>';
    }

    protected function mapPages(): Collection
    {
        $pages = new Collection();

        foreach (glob(resource_path("docs/*.md")) as $filepath) {
            $pages->push(new SidebarItem($filepath));
        }

        $pages = $pages->filter(function (SidebarItem $item) {
            return ! $item->hidden;
        });

        $pages = $pages->sortBy('priority');

        return $pages;
    }

    public function getSidebarItems(): Collection
    {
        return $this->pages;
    }

    public function getInstance(): self
    {
        return $this;
    }
}
