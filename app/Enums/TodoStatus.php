<?php

namespace App\Enums;

/**
 * todo status enum class
 *
 * @package \App\Enums
 */
final class TodoStatus extends Enum
{
    const Ready = 'ready';
    const Doing = 'doing';
    const Done = 'done';
}
