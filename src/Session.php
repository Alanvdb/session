<?php

declare(strict_types=1);

namespace AlanVdb\Session;

use AlanVdb\Session\Definition\SessionInterface;
use AlanVdb\Session\Throwable\InvalidSessionVarProvided;
use AlanVdb\Session\Throwable\SessionCannotStart;

class Session implements SessionInterface
{
    private $sessionManager;

    public function __construct(SessionManager $sessionManager = null)
    {
        $this->sessionManager = $sessionManager ?? new SessionManager();
    }

    public function start(array $options = []): self
    {
        if (!$this->sessionManager->start($options)) {
            throw new SessionCannotStart('Could not start session.');
        }
        return $this;
    }

    public function add(string $id, $value): self
    {
        if (empty($id)) {
            throw new InvalidSessionVarProvided('Session variable name cannot be empty.');
        }
        $_SESSION[$id] = $value;
        return $this;
    }

    public function remove(string $offset): void
    {
        unset($_SESSION[$offset]);
    }

    public function get(string $offset, $default = null): mixed
    {
        return $_SESSION[$offset] ?? $default;
    }

    public function has(string $offset): bool
    {
        return isset($_SESSION[$offset]);
    }

    public function invalidate(): void
    {
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(session_name(), '', time() - 42000,
                $params['path'], $params['domain'],
                $params['secure'], $params['httponly']);
        }
        session_destroy();
        $this->start(); // Optionally start a new session
    }

    public function regenerate(): void
    {
        session_regenerate_id(true);
    }
}
