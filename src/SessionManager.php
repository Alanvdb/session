<?php

declare(strict_types=1);

namespace AlanVdb\Session;

class SessionManager
{
    public function start(array $options = []): bool
    {
        return session_start($options);
    }
}
