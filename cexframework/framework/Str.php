<?php

namespace Framework;

class Str
{
    public static function replaceFirst($search, $replace, $subject)
    {
        $position = strpos($subject, $search);

        if ($position !== false) {
            return substr_replace($subject, $replace, $position, strlen($search));
        }

        return $subject;
    }

    public static function contains($key, $contains)
    {
        return strpos($key, $contains) !== false;
    }
}
