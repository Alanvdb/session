<?php

declare(strict_types=1);

namespace AlanVdb\Session\Factory;

use AlanVdb\Session\Session;
use AlanVdb\Session\SessionManager;
use AlanVdb\Session\Definition\SessionFactoryInterface;
use AlanVdb\Session\Definition\SessionInterface;
use AlanVdb\Session\Throwable\InvalidSessionVarProvided;

class SessionFactory implements SessionFactoryInterface
{
    /**
     * Create a SessionInterface object
     * @param array $vars Session vars by name
     * @throws InvalidSessionVarProvided
     * @return SessionInterface
     */
    public function createSession(array $vars): SessionInterface
    {
        $sessionManager = new SessionManager();
        $session = new Session($sessionManager);
        foreach ($vars as $key => $value) {
            $session->add($key, $value);
        }
        return $session;
    }
}
