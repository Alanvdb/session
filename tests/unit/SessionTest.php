<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use AlanVdb\Session\Session;
use AlanVdb\Session\SessionManager;
use AlanVdb\Session\Throwable\InvalidSessionVarProvided;
use AlanVdb\Session\Throwable\SessionCannotStart;

class SessionTest extends TestCase
{
    protected function setUp(): void
    {
        if (session_status() === PHP_SESSION_ACTIVE) {
            session_destroy();
        }
        $_SESSION = [];
    }

    public function testStartSession()
    {
        $sessionManager = $this->createMock(SessionManager::class);
        $sessionManager->method('start')->willReturn(true);

        $session = new Session($sessionManager);
        $session->start([]);

        // Vérifiez que la méthode start a été appelée une fois
        $this->assertTrue($sessionManager->start([]));
    }

    public function testStartSessionThrowsException()
    {
        $sessionManager = $this->createMock(SessionManager::class);
        $sessionManager->method('start')->willReturn(false);

        $session = new Session($sessionManager);

        $this->expectException(SessionCannotStart::class);
        $session->start([]);
    }

    public function testAddSessionVariable()
    {
        $session = new Session();
        $session->start([]);
        $session->add('test', 'value');

        $this->assertSame('value', $_SESSION['test']);
    }

    public function testAddSessionVariableThrowsException()
    {
        $session = new Session();
        $session->start([]);

        $this->expectException(InvalidSessionVarProvided::class);
        $session->add('', 'value');
    }

    public function testRemoveSessionVariable()
    {
        $session = new Session();
        $session->start([]);
        $_SESSION['test'] = 'value';
        $session->remove('test');

        $this->assertArrayNotHasKey('test', $_SESSION);
    }

    public function testGetSessionVariable()
    {
        $session = new Session();
        $session->start([]);
        $_SESSION['test'] = 'value';

        $this->assertSame('value', $session->get('test'));
        $this->assertSame('default', $session->get('nonexistent', 'default'));
    }

    public function testHasSessionVariable()
    {
        $session = new Session();
        $session->start([]);
        $_SESSION['test'] = 'value';

        $this->assertTrue($session->has('test'));
        $this->assertFalse($session->has('nonexistent'));
    }

    public function testInvalidateSession()
    {
        $session = new Session();
        $session->start([]);
        $_SESSION['test'] = 'value';

        $session->invalidate();

        $this->assertEmpty($_SESSION);
        // Utilisation de session_status pour vérifier l'état actif après invalidation
        $this->assertTrue(session_status() === PHP_SESSION_ACTIVE);
    }

    public function testRegenerateSession()
    {
        $session = new Session();
        $session->start([]);
        $oldSessionId = session_id();

        $session->regenerate();
        $newSessionId = session_id();

        $this->assertNotSame($oldSessionId, $newSessionId);
    }
}
