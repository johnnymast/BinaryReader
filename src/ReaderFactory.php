<?php

/**
 * ReaderFactory.php
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

use JM\BinaryReader\Sources\FileSource;
use JM\BinaryReader\Sources\SourceAbstract;
use JM\BinaryReader\Sources\StringSource;
use Exception;

/**
 * Class ReaderFactory
 *
 * @category Core
 * @package  Reader
 * @author   Johnny Mast <mastjohnny@gmail.com>
 * @license  https://opensource.org/licenses/MIT MIT
 * @link     https://github.com/johnnymast/BinaryReader
 * @since    1.0
 */
class ReaderFactory
{
    public const TYPE_STRING = 0;
    public const TYPE_FILE = 1;

    /**
     * Create a Reader instance with a factory method.
     *
     * @param string $source The source string to read from.
     * @param int $type The type of source to use TYPE_FILE or TYPE_STRING.
     *
     * @return ?Reader
     * @throws Exception
     */
    public static function create(string $source, int $type): ?Reader
    {
        $instance = null;

        switch ($type) {
            case self::TYPE_STRING:
                $instance = new StringSource($source);
                break;
            case self::TYPE_FILE:
                $instance = new FileSource($source);
                break;
        }

        if (is_null($instance)) {
            throw new Exception('Invalid source type');
        } else {
            $instance->setup();

            return new Reader($instance);
        }
    }

    /**
     * Destroy the source.
     *
     * @param SourceAbstract|null $source The source.
     *
     * @return void
     * @throws Exception
     */
    public static function destroy(?SourceAbstract $source)
    {
        if (is_null($source) === true || !($source instanceof SourceAbstract)) {
            throw new Exception('Invalid instance pasted.');
        }

        $source->end();
    }
}