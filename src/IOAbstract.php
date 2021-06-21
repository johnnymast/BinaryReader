<?php

/**
 * IOAbstract.php
 *
 * Generic functions for using streams.
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

namespace JM\BinaryReader;

/**
 * Abstract class IOAbstract
 *
 * @category Core
 * @package  Reader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
abstract class IOAbstract
{

    /**
     * Validate the validity of the source stream.
     *
     * @return bool
     */
    public function validateSource(): bool
    {
        return ($this->source and $this->source->isOpen());
    }

    /**
     * Return the current position into the stream.
     *
     * @return false|int
     */
    public function getSeek()
    {
        if ($this->validateSource()) {
            return ftell($this->source->getStream());
        }

        return false;
    }

    /**
     * Set position to current location plus offset.
     *
     * @param int $offset The offset to move to.
     *
     * @return $this
     */
    public function seekAhead(int $offset = 0): self
    {
        if ($this->validateSource()) {
            fseek($this->source->getStream(), $offset, SEEK_CUR);
        }
        return $this;
    }

    /**
     * Set position equal to offset bytes.
     *
     * @param int $offset The offset to move to.
     *
     * @return $this
     */
    public function seekOffset(int $offset = 0): self
    {
        if ($this->validateSource()) {
            fseek($this->source->getStream(), $offset, SEEK_SET);
        }

        return $this;
    }

    /**
     * Set position to end-of-file plus offset.
     *
     * Note: String source cannot write behind eof.
     *
     * @param int $offset The offset to move to.
     *
     * @return $this
     */
    public function seekAtEnd(int $offset = 0): self
    {
        if ($this->validateSource()) {
            fseek($this->source->getStream(), $offset, SEEK_END);
        }

        return $this;
    }

    /**
     * Is this result at the end of the stream?
     *
     * @return bool
     */
    public function isEof(): bool
    {
       return $this->source->isEof();
    }

    /**
     * @param int $length The number of bytes to read.
     * @param int $fromOffset (optional) The start offset to read from.
     * @return ReadResult|false
     */
    public function read(int $length = 0, int $fromOffset = -1)
    {
        if ($fromOffset > -1) {
            $this->seekOffset($fromOffset);
        }

        $data = fread($this->source->getStream(), $length);

        if (!$data) {
            return false;
        }

        return new ReadResult($data, $this);
    }
}