<?php

namespace DeSilva\Lagrafo\PostProcessors;

abstract class PostProcessor implements PostProcessorContract
{
    public function process(string $html): string
    {
        return $html;
    }

    public function canCache(): bool
    {
        return true;
    }
}
