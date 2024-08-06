<?php

declare(strict_types=1);

namespace AlanVdb\Session\Definition;

use AlanVdb\Session\Throwable\InvalidSessionVarProvided;

interface SessionFactoryInterface
{
    /**
     * Create a SessionInterface object
     * @param array $vars Session vars by name
     * @throws InvalidSessionVarProvided
     * @return SessionInterface
     */
    public function createSession(array $vars) : SessionInterface;
}
