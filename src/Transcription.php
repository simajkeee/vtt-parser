<?php

namespace Simajkeee\Transcriptions;

class Transcription
{
    public function __construct(protected array $lines)
    {
        $this->lines = $this->discardInvalidLines($lines);
    }

    public static function load(string $path): self
    {
        return new static(file($path, FILE_IGNORE_NEW_LINES));
    }

    public function lines(): array
    {
        $lines = [];
        for ($i = 0; $i < count($this->lines); $i+=2) {
            $lines[] = new Line($this->lines[$i], $this->lines[$i + 1]);
        }
        return $lines;
    }

    protected function discardInvalidLines(array $lines): array
    {
        return array_values(array_filter($lines, function ($line) {
            return Line::valid($line);
        }));
    }
    
    public function __toString(): string
    {
        return implode("", $this->lines);
    }
}