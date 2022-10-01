VTT Parser Package

Load and parse VTT files

Use "$transcription = Transcription::load(__DIR__ . '/path/to/vtt-file.vtt')"; to parse the contents of a file into lines.

Then you can use "$tanscription->lines()" in your code e.g. to render custom html markup.
Transcription class has a method to render default html markup "$tanscription->htmlLines()".

Nothing to add, just try it.