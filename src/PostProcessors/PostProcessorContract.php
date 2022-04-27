<?php

namespace DeSilva\Lagrafo\PostProcessors;

interface PostProcessorContract
{
    public function process(string $html): string;

    public function canCache(): bool;
}
