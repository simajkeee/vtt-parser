<?php

namespace Simajkeee\Transcriptions;

class Line
{

    public function __construct(public string $timestamp, public string $text)
    {
    }

    public static function valid(string $line)
    {
         return trim($line) !== 'WEBVTT' && $line != '' && !is_numeric($line);
    }

    public function getBeginningTimestamp()
    {
        preg_match('/\d{2}:(\d{2}:\d{2}).\d{3}/', $this->timestamp, $matches);

        return $matches[1];
    }

    public function toAnchorTag()
    {
        return "<a href=\"?time={$this->getBeginningTimestamp()}\">{$this->text}</a>";

    }
}