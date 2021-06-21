<?php

/**
 * FileSource.php
 *
 * Handle the reading of files.
 *
 * PHP version 7.4 and up.
 *
 * @category Sources
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */


namespace JM\BinaryReader\Sources;

/**
 * Class FileSource
 *
 * @category Sources
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
class FileSource extends SourceAbstract implements SourceInterface
{

    /**
     * Create the stream.
     *
     * @return void
     * @throws \Exception
     */
    public function setup(): void
    {
        if (is_file($this->source) === false || is_readable($this->source) === false) {
            throw new \Exception('File not found or not readable.');
        }

        $this->stream = fopen($this->source, 'rw+');
        rewind($this->stream);
    }

    /**
     * Close the active stream.
     *
     * @return void
     */
    public function end(): void
    {
        if (is_resource($this->stream)) {
            fclose($this->stream);
        }
    }
}