<?php

/**
 * StringSource.php
 *
 * Abstract class used by sources.
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
 * Abstract Class SourceAbstract
 *
 * @category Sources
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
abstract class SourceAbstract
{

    /**
     * Reference to the stream used.
     *
     * @var mixed
     */
    protected $stream = false;

    /**
     * Reference to the source used.
     *
     * @var string|null
     */
    protected ?string $source = null;

    /**
     * SourceAbstract constructor.
     *
     * @param string $source The source to read.
     */
    public function __construct(string $source)
    {
        $this->source = $source;
        $this->setup();
    }

    /**
     * Deconstruct the Source.
     */
    public function __destruct()
    {
        $this->end();
    }

    /**
     * Return the source used.
     *
     * @return SourceInterface|null
     */
    public function getSource(): ?string
    {
        return $this->source;
    }

    /**
     * Return the stream.
     *
     * @return resource|false
     */
    public function getStream()
    {
        return $this->stream;
    }

    /**
     * Check if the source stream is open.
     *
     * @return bool
     */
    public function isOpen(): bool
    {
        return (is_resource($this->getStream()) == true);
    }

    /**
     * Returns true if the cursor is at the end of the stream.
     *
     * @return bool
     */
    public function isEof(): bool
    {
        return feof($this->getStream());
    }
}