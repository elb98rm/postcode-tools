<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

use League\Flysystem\Adapter\Local;
use League\Flysystem\Filesystem;
use Floor9design\PostcodeTools\NSPLFileNameTransformer;

$adapter = new Local('/');
$filesystem = new Filesystem($adapter);
$sourceDir = $argv[1];
$sourceDir = realpath($sourceDir);
$destDir = isset($argv[2]) ? $argv[2] : __DIR__ . '/../source/';
$destDir = realpath($destDir);
$nameTransformer = new NSPLFileNameTransformer;

foreach (['Data', 'Documents'] as $directory) {
    $files = $filesystem->listContents($sourceDir . "/$directory");
    foreach ($files as $file) {
        if ($file['type'] === 'file' && $file['extension'] === 'csv') {
            $newFilename = $nameTransformer->transform($file['filename']);
            if ($newFilename !== $file['filename']) {
                $newPath = $destDir . "/$newFilename.csv";
                if ($filesystem->has($newPath)) {
                    $filesystem->delete($newPath);
                }
                $filesystem->copy($file['path'], $newPath);
            }
        }
    }
}
