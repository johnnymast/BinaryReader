<?php


namespace JM\BinaryReader\Tests\Unit\Sources;


use JM\BinaryReader\ReaderFactory;

it('Should throw en error if file is not found.', function () {
    ReaderFactory::create('no_where_on_earth_i_exist.txt', ReaderFactory::TYPE_FILE);
})->throws(\Exception::class, 'File not found or not readable.');;