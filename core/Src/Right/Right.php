<?php

namespace Src\Right;

use Src\Traits\FindUser;

class Right
{
    use FindUser;

    public static function suitableRight(string $role): bool
    {
        if (self::user()->role === $role) {
            return true;
        }
        return false;
    }
}