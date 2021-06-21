<?php

/**
 * Base64.php
 *
 * Convert a string from and to Base64
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

namespace JM\BinaryReader\Converters;

/**
 * Class Base64
 *
 * @package JM\BinaryReader\Converters
 */
class Base64
{
    /**
     * The data to encode or decode.
     *
     * @var string
     */
    protected string $data = '';

    /**
     * Base64 constructor.
     *
     * @param string $data The data to encode or decode.
     */
    public function __construct(string $data)
    {
        $this->data = $data;
    }

    /**
     * Encode a string to base64.
     *
     * @return string
     */
    public function encode(): string
    {
        return base64_encode($this->data);
    }

    /**
     * Decode a base64 string.
     *
     * @return string
     */
    public function decode(): string
    {
        return base64_decode($this->data);
    }
}