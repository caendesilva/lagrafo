<?php

namespace DeSilva\Lagrafo;

use Illuminate\Support\Collection;

class Pagination
{
    protected array $pages;
    protected string $currentPage;
    protected int $currentPosition;

    public function __construct(string $currentPage)
    {
        $this->currentPage = $currentPage;
        $this->pages = static::mapToArray(\Lagrafo::getInstance()->getSidebarItems());
        $this->currentPosition = array_search($currentPage, $this->pages);
    }

    protected static function mapToArray(Collection $collection): array
    {
        $array = [];
        foreach ($collection as $item) {
            $array[] = basename($item->destination);
        }
        return $array;
    }

    protected function getPrevious(): string
    {
        return \Lagrafo::route($this->pages[$this->currentPosition - 1]);
    }

    protected function getNext(): string
    {
        return \Lagrafo::route($this->pages[$this->currentPosition + 1]);
    }

    public function previous(): string
    {
        if ($this->currentPosition === 0) {
            return '<span id="previous" title="This is the first page"><span role="presentation">«</span> <span class="label">Previous</span></span>';
        }

        return '<a href="'.$this->getPrevious().'" id="previous"><span role="presentation">«</span> <span class="label">Previous</span></a>';
    }
    public function next(): string
    {
        if ($this->currentPosition === count($this->pages) - 1) {
            return '<span id="next" title="This is the last page"><span class="label">Next</span> <span role="presentation">»</span></span>';
        }
        return '<a href="'.$this->getNext().'" id="next"><span class="label">Next</span> <span role="presentation">»</span></a>';

    }
}
