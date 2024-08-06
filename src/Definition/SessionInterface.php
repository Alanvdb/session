<?php

declare(strict_types=1);

namespace AlanVdb\Session\Definition;

use AlanVdb\Session\Throwable\InvalidSessionVarProvided;

interface SessionInterface
{
    /**
     * Add session var
     * @param string $varName Session var name
     * @param mixed  $value  Value to assign
     * @throws InvalidSessionVarProvided if $varName is empty
     * @return self
     */
    public function add(string $id, $value) : self;

    /**
     * Remove session var
     * @param string $offset Session var offset
     */
    public function remove(string $offset) : void;

    /**
     * Retrieve session value from specified offset.
     * @param string $offset  Offset to retrieve value from
     * @param mixed  $default Value to return if offset does not exists
     * @return mixed
     */
    public function get(string $offset, $default = null) : mixed;

    /**
     * Returns wether or not provided offset exists
     * @param string $offset Session var offset
     * @return bool
     */
    public function has(string $offset) : bool;

    /**
     * Invalidate the current session
     */
    public function invalidate(): void;

    /**
     * Regenerate the session ID
     */
    public function regenerate(): void;

}
