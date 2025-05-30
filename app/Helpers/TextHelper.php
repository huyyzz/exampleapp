<?php

if (! function_exists('truncate_text')) {
    function truncate_text($text, $length = 100, $ending = '...')
    {
        if (strlen($text) > $length) {
            $text = substr($text, 0, $length - strlen($ending)) . $ending;
        }

        return $text;
    }
}
