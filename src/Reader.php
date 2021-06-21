<?php

/**
 * Reader.php
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

namespace JM\BinaryReader;


use JM\BinaryReader\Converters\Base64;
use JM\BinaryReader\Sources\SourceInterface;

/**
 * Class Reader
 *
 * @category Core
 * @package  Reader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
class Reader extends IOAbstract
{

    /**
     * The source to read from.
     *
     * @var SourceInterface|null
     */
    protected ?SourceInterface $source = null;

    /**
     * Reader constructor.
     * @param SourceInterface $source
     */
    public function __construct(SourceInterface $source)
    {
        $this->source = $source;
    }

    /**
     * Return the Reader Source.
     *
     * @return SourceInterface|null
     */
    public function getSource(): ?SourceInterface
    {
        return $this->source;
    }
}