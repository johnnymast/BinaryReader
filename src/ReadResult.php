<?php

/**
 * ReadResult.php
 *
 * This class will store the result of a read action.
 *
 * PHP version 7.4 and up.
 *
 * @category Core
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */

namespace JM\BinaryReader;

use JM\BinaryReader\Converters\Base64;

/**
 * Class ReadResult
 *
 * @category Core
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
class ReadResult
{

    /**
     * The raw data passed trough the constructor.
     *
     * @var string
     */
    protected string $raw = '';

    /**
     * Reference to the stream reader.
     *
     * @var Reader|null
     */
    protected ?Reader $reader = null;

    /**
     *
     * @var Base64|null
     */
    public ?Base64 $base64 = null;

    /**
     * ReadResult constructor.
     *
     * @param string $data The data read from stream.
     */
    public function __construct(string $data = '', Reader $reader = null)
    {
        $this->raw = $data;
        $this->reader = $reader;

        $this->base64 = new Base64($this->raw);
    }

    /**
     * Return the raw data passed to the constructor.
     *
     * @return string
     */
    public function getRawData(): string
    {
        return $this->raw;
    }

    /**
     * Is this result at the end of the stream?
     *
     * @return bool
     */
    public function isEof(): bool
    {
        return $this->reader->isEof();
    }

    /**
     * Return the current position in the file.
     *
     * @return false|int
     */
    public function getSeek()
    {
        return $this->reader->getSeek();
    }
}