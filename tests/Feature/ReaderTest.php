<?php

use \JM\BinaryReader\Sources\FileSource;
use \JM\BinaryReader\Sources\StringSource;
use \JM\BinaryReader\ReadResult;
use \JM\BinaryReader\Reader;

beforeEach(function () {
    $this->fileReader = new Reader(
        new FileSource(__DIR__ . '/../Data/Binary.bin')
    );

    $this->stringReader = new Reader(
        new StringSource('AAABBBBCCCDDDEEEFFFGGGG')
    );
});

test('getSeek should return 0 without any reading.', function () {
    expect($this->fileReader->getSeek())->toBe(0);
    expect($this->stringReader->getSeek())->toBe(0);
});

test('seekOffset should return the current offset into the source.', function () {
    $offset = 5;

    $this->fileReader->seekOffset($offset);
    $this->stringReader->seekOffset($offset);

    expect($this->fileReader->getSeek())->toBe($offset);
    expect($this->stringReader->getSeek())->toBe($offset);
});

test('seekAhead should return seek (x) bytes forward from current position.', function () {

    $offset = 5;
    $nextOffset = 2;

    $this->fileReader->seekOffset($offset)->seekAhead($nextOffset);
    $this->stringReader->seekOffset($offset)->seekAhead($nextOffset);

    expect($this->fileReader->getSeek())->toBe($offset + $nextOffset);
    expect($this->stringReader->getSeek())->toBe($offset + $nextOffset);
});

test('seekAtEnd(0) should point to the end of the file.', function () {

    $offset = 0;

    $this->fileReader->seekAtEnd($offset);
    $this->stringReader->seekAtEnd($offset);

    $fileReaderSize = fstat($this->fileReader->getSource()->getStream());
    $stringReaderSize = fstat($this->stringReader->getSource()->getStream());

    expect($this->fileReader->getSeek())->toBe($fileReaderSize['size']);
    expect($this->stringReader->getSeek())->toBe($stringReaderSize['size']);
});

/**
 * Note: String source cannot write behind eof.
 */
test('File only: seekAtEnd(x) should point x bytes behind to the end of the stream.', function () {

    $offset = 2;

    $this->fileReader->seekAtEnd($offset);
    $fileReaderSize = fstat($this->fileReader->getSource()->getStream());

    expect($this->fileReader->getSeek())->toBe($fileReaderSize['size'] + $offset);
});

test('read should return an instance of ReadResult.', function () {
    $length = 2;

    expect($this->fileReader->read($length))->toBeInstanceOf(ReadResult::class);
    expect($this->stringReader->read($length))->toBeInstanceOf(ReadResult::class);
});

test('read(3) should read 3 bytes from seekOffset.', function () {

    $seek = 2;
    $length = 3;

    $this->fileReader->seekOffset($seek);
    $this->stringReader->seekOffset($seek);

    expect($this->fileReader->read($length)->getRawData())->toBe('XXX');
    expect($this->stringReader->read($length)->getRawData())->toBe('ABB');
});

test('read(3) should read 3 bytes from seekAhead.', function () {

    $seek = 5;
    $length = 3;

    $this->fileReader->seekAhead($seek);
    $this->stringReader->seekAhead($seek);

    expect($this->fileReader->read($length)->getRawData())->toBe('ZZZ');
    expect($this->stringReader->read($length)->getRawData())->toBe('BBC');
});