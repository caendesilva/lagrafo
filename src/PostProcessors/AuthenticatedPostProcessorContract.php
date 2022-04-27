<?php

namespace DeSilva\Lagrafo\PostProcessors;

use Illuminate\Foundation\Auth\User;

interface AuthenticatedPostProcessorContract
{
    public function __construct(User $user);

    public function process(string $html): string;

    public function canCache(): bool;
}
