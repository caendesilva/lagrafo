<?php

namespace DeSilva\Lagrafo\PreProcessors;

class Shortcode
{
    public string $key;
    public string $open;
    public string $close;

    public function __construct(string $key, string $open, string $close)
    {
        $this->key = $key;
        $this->open = $open;
        $this->close = $close;
    }
}
