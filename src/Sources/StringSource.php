<?php

/**
 * StringSource.php
 *
 * Handle the reading of strings.
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
 * Class StringSource
 *
 * @category Sources
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
class StringSource extends SourceAbstract implements SourceInterface
{

    /**
     * Create the stream.
     *
     * @return void
     */
    public function setup(): void
    {
        $this->stream = fopen('php://memory', 'rw+');
        fwrite($this->stream, $this->source);
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