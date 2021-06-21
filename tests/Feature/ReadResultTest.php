<?php

use \JM\BinaryReader\Sources\FileSource;
use \JM\BinaryReader\Sources\StringSource;
use \JM\BinaryReader\ReadResult;
use \JM\BinaryReader\Reader;

beforeEach(function () {
    $this->string = 'AAABBBBCCCDDDEEEFFFGGGG';
    $this->base64EncodedString = 'QUFBQkJCQkNDQ0REREVFRUZGRkdHR0c=';

    $this->base6EncodedReader = new Reader(
        new StringSource($this->base64EncodedString)
    );

    $this->base6DecodedReader = new Reader(
        new StringSource($this->string)
    );
});

test('->base64->encode() should return an encoded string.', function () {

    $stringReaderSize = fstat($this->base6DecodedReader->getSource()->getStream());

    $result = $this->base6DecodedReader->read($stringReaderSize['size'])->base64->encode();

    expect($result)->toBe($this->base64EncodedString);
});

test('->base64->decode() should return an decoded string.', function () {

    $stringReaderSize = fstat($this->base6EncodedReader->getSource()->getStream());

    $result = $this->base6EncodedReader->read($stringReaderSize['size'])->base64->decode();

    expect($result)->toBe($this->string);
});