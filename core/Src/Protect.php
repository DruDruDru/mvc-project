<?php

namespace Src;

class Protect
{
    public static function encode_string(string $data): string
    {
        return md5($data);
    }

    public static function check_string(string $encode, string $data): bool
    {
        if (md5($data) === $encode) {
            return true;
        }
        return false;
    }
}