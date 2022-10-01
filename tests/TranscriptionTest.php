<?php

use Simajkeee\Transcriptions\Line;
use Simajkeee\Transcriptions\Transcription;
use PHPUnit\Framework\TestCase;

class TranscriptionTest extends TestCase
{
    /** @test */
    function it_loads_vtt_file_as_a_string()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringContainsString("00:00:03.210 --> 00:00:04.110", $transcription);
        $this->assertStringContainsString("Here is a", $transcription);
        $this->assertStringContainsString("00:00:04.110 --> 00:00:05.630", $transcription);
        $this->assertStringContainsString("example of a VTT file.", $transcription);

    }

    /**
     * @test
     */
    function it_can_convert_to_an_array_of_lines_objects()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $lines = Transcription::load($file)->lines();

        $this->assertCount(2, $lines);

        $this->assertContainsOnlyInstancesOf(Line::class, $lines);
    }

    /**
     * @test
     */
    function it_discards_irrelevant_lines_from_the_vtt_file()
    {
        $file = __DIR__ . '/stubs/basic-example.vtt';

        $transcription = Transcription::load($file);

        $this->assertStringNotContainsString('WEBVTT', $transcription);

        $this->assertCount(2, $transcription->lines());
    }
}