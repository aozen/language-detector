<?php

function removeWhitespaces(string &$str)
{
    $str = preg_replace('/\s/', '', $str);
}

function splitStringIntoChars(string $str)
{
    return mb_str_split($str);
}