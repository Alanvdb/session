<?php declare(strict_types=1);


namespace AlanVdb\Session\Throwable;

use Throwable;
use RuntimeException;


class SessionCannotStart
    extends RuntimeException
    implements Throwable
{}