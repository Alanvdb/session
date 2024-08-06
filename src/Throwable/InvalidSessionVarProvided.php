<?php declare(strict_types=1);


namespace AlanVdb\Session\Throwable;

use Throwable;
use InvalidArgumentException;


class InvalidSessionVarProvided
    extends InvalidArgumentException
    implements Throwable
{}