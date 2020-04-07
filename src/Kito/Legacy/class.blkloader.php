<?php

/**
 *
 * This program is free software; you can redistribute it and/or modify
 * it under the terms of the GNU Lesser General Public License as published by
 * the Free Software Foundation; either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU Lesser General Public License for more details.
 *
 */

/**
 *
 * @author The TheKito < blankitoracing@gmail.com >
 */
class BLKLoader
{

    private static $files = array();

    public static function addPath($directory)
    {
        if (!is_dir($directory)) {
            throw new Exception('Invalid directory: ' . $directory);
        }


        foreach (scandir($directory) as $name) {
            if ($name == '.' || $name == '..') {
                continue;
            }

            $path = $directory . '/' . $name;

            if (is_dir($path)) {
                self::addPath($path);
            } elseif (is_file($path) && strtolower(pathinfo($path, PATHINFO_EXTENSION)) == 'php' && (stripos(basename($path), 'class.') === 0 || stripos(basename($path), 'interface.') === 0)) {
                self::$files[$path] = $path;
            }
        }
    }

    public static function loadClass($name)
    {
        foreach (self::$files as $path) {
            if (stristr(basename($path), $name) !== false) {
                $txt = preg_replace("/[^A-Za-z0-9]/", '', file_get_contents($path));

                if (stristr($txt, 'class' . $name) !== false || stristr($txt, 'interface' . $name) !== false) {
                    include_once $path;
                }

                if (class_exists($name) || interface_exists($name)) {
                    break;
                }
            }
        }

        if (!class_exists($name) && !interface_exists($name)) {
            throw new Exception('Class not found: ' . $name);
        }
    }

}

spl_autoload_register(
    function ($name) {
        BLKLoader::loadClass($name);
    }
);
