<?php

/**
 * SourceInterface.php
 *
 * Interface with rules for reader sources.
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
 * Interface SourceInterface
 *
 * @category Sources
 * @package  BinaryReader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
interface SourceInterface
{
    /**
     * The constructor.
     *
     * @param string $source
     */
    public function __construct(string $source);

    /**
     * Create the stream.
     *
     * @return void
     */
    public function setup(): void;

    /**
     * Close the active stream.
     *
     * @return void
     */
    public function end(): void;

    /**
     * Return the source used.
     *
     * @return SourceInterface|null
     */
    public function getSource(): ?string;

    /**
     * Return the stream.
     *
     * @return resource|false
     */
    public function getStream();
}