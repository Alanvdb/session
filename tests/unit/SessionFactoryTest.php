<?php

declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use AlanVdb\Session\Factory\SessionFactory;
use AlanVdb\Session\Throwable\InvalidSessionVarProvided;
use AlanVdb\Session\Session;
use AlanVdb\Session\Definition\SessionInterface;

class SessionFactoryTest extends TestCase
{
    public function testCreateSession()
    {
        $vars = [
            'test1' => 'value1',
            'test2' => 'value2',
        ];

        $factory = new SessionFactory();
        $session = $factory->createSession($vars);

        $this->assertInstanceOf(SessionInterface::class, $session);
        $this->assertSame('value1', $session->get('test1'));
        $this->assertSame('value2', $session->get('test2'));
    }

    public function testCreateSessionWithInvalidVarThrowsException()
    {
        $this->expectException(InvalidSessionVarProvided::class);

        $vars = [
            '' => 'value1', // Invalid key
        ];

        $factory = new SessionFactory();
        $factory->createSession($vars);
    }
}
