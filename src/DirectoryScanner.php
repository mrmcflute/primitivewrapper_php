<?php

declare(strict_types=1);

namespace PrimitiveWrapper;

use FilesystemIterator;
use RecursiveDirectoryIterator;
use RecursiveIteratorIterator;
use SplFileInfo;

class DirectoryScanner
{
    public static function requireAllPHPFiles(string $startingDirectory): void
    {
        $iterator = new RecursiveIteratorIterator(
            new RecursiveDirectoryIterator($startingDirectory, FilesystemIterator::SKIP_DOTS)
        );

        /**
         * @var SplFileInfo $file
         */
        foreach ($iterator as $file) {
            if ($file->getExtension() === 'php') {
                require_once($file->getRealPath());
            }
        }
    }
}