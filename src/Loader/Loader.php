<?php

/**
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 */

namespace Kito\Loader;

/**
 * OnRun download and loader use PSR-0 scheme for cache storage and PSR-4 for respository references.
 *
 * @author TheKito
 */
class Loader
{
    private static function pathFromString(string $stringPath): array
    {
        $_ = [];

        foreach (explode('/', str_replace('\\', '/', $stringPath)) as $name) {
            if (empty($name)) {
                continue;
            }

            if ($name == '.') {
                continue;
            }

            if ($name == '..' && count($_) > 0) {
                array_pop($_);
                continue;
            }

            $_[] = $name;
        }

        return $_;
    }

    private static function pathToHash(array $path): string
    {
        return sha1(implode(0x00, $path));
    }

    private static function pathToString(array $path): string
    {
        if (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN') {
            return implode('/', $path);
        } else {
            return '/'.implode('/', $path);
        }
    }

    private static function createDirectories(array $path): void
    {
        $_ = [];

        foreach ($path as $name) {
            $_[] = array_shift($path);

            $__ = self::pathToString($_);

            if (!@is_dir($__)) {
                @mkdir($__);
            }
        }
    }

    private $cachePath = [];

    public function getCachePath(): string
    {
        return self::pathToString($this->cachePath);
    }

    public function setCachePath(string $path): self
    {
        $this->cachePath = self::pathFromString($path);

        return $this;
    }

    private $repositories = [];

    public function addRepository(string $nameSpace, string $url): self
    {
        $index = self::pathToHash(self::pathFromString($nameSpace));

        if (!isset($this->repositories[$index])) {
            $this->repositories[$index] = [];
        }

        array_push($this->repositories[$index], $url);

        return $this;
    }

    public function __construct(string $cachePath = __DIR__)
    {
        $this->setCachePath($cachePath);
        $this->addRepository('/Kito', 'https://raw.githubusercontent.com/TheKito/kito-php/master/src/');
        spl_autoload_register([$this, 'loadClass']);

        Sources::attach($this);
    }

    public function loadClass(string $classNameSpace): void
    {
        $classPath = self::pathFromString($classNameSpace);
        $classFile = self::pathToString(array_merge($this->cachePath, $classPath)).'.php';

        if (!file_exists($classFile)) {
            $this->downloadClass($classPath, $classFile);
        }

        if (file_exists($classFile)) {
            include_once $classFile;
        }
    }

    private function downloadClass(array $classPath, string $classFile): void
    {
        $className = array_pop($classPath);

        $middlePath = [];
        while (count($classPath) > 0) {
            $key = self::pathToHash($classPath);
            if (isset($this->repositories[$key])) {
                foreach ($this->repositories[$key] as $repository) {
                    $repositoryFile = $repository.'/'.implode('/', array_reverse($middlePath)).'/'.$className.'.php';
                    $data = file_get_contents($repositoryFile);

                    if ($data !== false) {
                        self::createDirectories(self::pathFromString(dirname($classFile)));
                        if (file_put_contents($classFile, $data) !== false) {
                            break;
                        }
                    }
                }
            }

            $middlePath[] = array_pop($classPath);
        }
    }
}
