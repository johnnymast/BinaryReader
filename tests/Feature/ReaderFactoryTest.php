<?php

namespace JM\BinaryReader\Tests\Feature;

use JM\BinaryReader\Exceptions\InvalidSourceTypeException;
use JM\BinaryReader\ReaderFactory;

it('Should throw en Exception if invalid type is passed.', function () {
    ReaderFactory::create('abc', 123);
})->throws(\Exception::class, 'Invalid source type');


it('Destroy should throw an exception on invalid instance.', function () {
    ReaderFactory::destroy(null);
})->throws(\Exception::class, 'Invalid instance pasted.');
