<?php

namespace Dadinaks\Task\Domain\Enum;

/**
 * task complexity
 * @enum Quote
 * @package Dadinaks\Task\Domain\Enum
 * @author Dadinaks Cedrick <cedrick.henintsoa.8821@gmail.com>
 */
enum Quote: string
{
    case LOW        = 'Low';
    case MEDIUM     = 'Medium';
    case DIFFICULT  = 'Difficult';
    case COMPLEX    = 'Complex';
    case EXTERNAL   = 'External Assistance';
}
