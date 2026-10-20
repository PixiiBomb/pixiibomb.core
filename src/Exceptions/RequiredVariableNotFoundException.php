<?php

namespace PixiiBomb\Core\Exceptions;

use RuntimeException;

/**
 * Thrown when a required Blade view variable is missing.
 */
class RequiredVariableNotFoundException extends RuntimeException
{
    /**
     * Creates a required-variable exception.
     *
     * @param string $variable The required variable name.
     */
    public function __construct(string $variable)
    {
        parent::__construct(
            "This view requires the \${$variable} variable."
        );
    }
}
