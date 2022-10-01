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

    /**
     * @return Line[]
     */
    public function lines(): array
    {
        return array_map(
            fn($line) => new Line(...$line),
            array_chunk($this->lines, 3)
        );
    }

    protected function discardInvalidLines(array $lines): array
    {
        return array_slice(array_filter($lines), 1);
    }

    public function htmlLines(): string
    {
        return implode("\n", array_map(
            fn($line) => $line->toAnchorTag(),
            $this->lines()
        ));
    }

    public function __toString(): string
    {
        return implode("\n", $this->lines);
    }
}