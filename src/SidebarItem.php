<?php

namespace DeSilva\Lagrafo;

use Spatie\YamlFrontMatter\YamlFrontMatter;

/**
 * Holds data for a sidebar item.
 * @todo Add support for nested items or namespaces.
 */
class SidebarItem
{
    public string $label;
    public string $destination;
    public int $priority = 500;
    public bool $hidden = false;

    public function __construct(string $filepath)
    {
        $matter = YamlFrontMatter::markdownCompatibleParse(file_get_contents($filepath))->matter();

        $this->destination = route('docs', basename($filepath));
        $this->label = $matter['label'] ?? $this->slugToTitle(basename($filepath, '.md'));
        $this->priority = $matter['priority'] ?? 500;
        $this->hidden = $matter['hidden'] ?? false;
    }

    protected function slugToTitle(string $slug): string
    {
        return ucwords(str_replace('-', ' ', $slug));
    }
}
