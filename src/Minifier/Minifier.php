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

namespace Kito\Minifier;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
abstract class Minifier {

    protected $maxLineSize = 8000;

    public function __construct(int $maxLineSize = 8000) {
        $this->maxLineSize = $maxLineSize;
    }

    public function getMaxLineSize(): int {
        return $this->maxLineSize;
    }

    public function setMaxLineSize($maxLineSize): void {
        $this->maxLineSize = $maxLineSize;
    }

    protected abstract function minifyLine($codeLine);

    public function parseFromString(string $code): string {
        $_ = '';

        foreach (explode("\n", str_replace("\r", "\n", $code)) as $codeLine) {
            $codeLine = trim($codeLine);

            if (empty($codeLine))
                continue;

            $_ .= $this->minifyLine($codeLine);
        }

        return $_;
    }

    public function parseFromFile(string $filePath, ?string $filePathMin = null): void {
        if ($filePathMin === null)
            $filePathMin = pathinfo($filePath, PATHINFO_DIRNAME) . DIRECTORY_SEPARATOR . pathinfo($filePath, PATHINFO_FILENAME) . '.min.' . pathinfo($filePath, PATHINFO_EXTENSION);        
        
        $sourceFileDescriptor = fopen($filePath, "r");
        $destinationFileDescriptor = fopen($filePathMin, "w");
        
        foreach (fgets($sourceFileDescriptor, $this->maxLineSize) as $codeLine) {
            $codeLine = trim($codeLine);

            if (empty($codeLine))
                continue;

            fwrite($destinationFileDescriptor, $this->minifyLine($codeLine));
        }

        fclose($destinationFileDescriptor);
        fclose($sourceFileDescriptor);
    }

}
