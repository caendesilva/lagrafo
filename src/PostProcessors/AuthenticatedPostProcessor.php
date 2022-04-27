<?php

namespace DeSilva\Lagrafo\PostProcessors;

use Illuminate\Foundation\Auth\User;

abstract class AuthenticatedPostProcessor extends PostProcessor implements AuthenticatedPostProcessorContract
{
    protected User $user;

    protected bool $canCache = false;

    public function __construct(User $user)
    {
        $this->user = $user;
    }

    public function process(string $html): string
    {
        return $html;
    }

    public function canCache(): bool
    {
        return $this->canCache;
    }
}
