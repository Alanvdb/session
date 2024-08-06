# Session

A basic PHP session system.

## Overview

The `Session` library provides a simple and extensible session management system for PHP applications. It allows you to start sessions, add, remove, and retrieve session variables, and manage session lifecycle operations like regeneration and invalidation.

## Features

- Simple and easy-to-use API
- PSR compliant
- Supports adding, removing, and retrieving session variables
- Handles session lifecycle operations like starting, regenerating, and invalidating sessions
- Customizable session management using a `SessionManager` class

## Installation

To install the `Session` library, use Composer:

```sh
composer require alanvdb/session
```

## Usage

Here is an example of how to use the `Session`:

```php
<?php

require 'vendor/autoload.php';

use AlanVdb\Session\Session;
use AlanVdb\Session\SessionManager;
use AlanVdb\Session\Factory\SessionFactory;

// Create a SessionManager instance
$sessionManager = new SessionManager();

// Create a Session instance
$session = new Session($sessionManager);

// Start the session
$session->start();

// Add session variables
$session->add('username', 'john_doe');
$session->add('email', 'john@example.com');

// Get session variables
$username = $session->get('username'); // 'john_doe'
$email = $session->get('email'); // 'john@example.com'

// Check if a session variable exists
$hasUsername = $session->has('username'); // true

// Remove a session variable
$session->remove('username');

// Invalidate the session
$session->invalidate();

// Regenerate session ID
$session->regenerate();
```

## Testing

To run the tests, use PHPUnit. Ensure you have PHPUnit installed and execute the following command:

```sh
vendor/bin/phpunit
```

## License

This project is licensed under the MIT License. See the [LICENSE](LICENSE) file for details.

## Issues and Feedback

If you encounter any issues or have feedback, please open an issue on the [GitHub repository](https://github.com/alanvdb/session/issues).
