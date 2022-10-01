<?php

namespace Simajkeee\Transcriptions;

class Line
{

    public function __construct(private string $timestamp, private string $text)
    {
    }

    public static function valid(string $line)
    {
         return trim($line) !== 'WEBVTT' && $line != '' && !is_numeric($line);
    }
}