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

namespace Kito\Router;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
class ProxyRouter {

    public static function getFromGlobals() {
        return new ProxyRouter($_SERVER['DOCUMENT_ROOT'], $_SERVER['REQUEST_URI']);
    }

    private $documentROOT;
    private $requestURI;

    public function __construct(string $documentROOT, string $requestURI) {
        $this->documentROOT = $documentROOT;
        $this->requestURI = $requestURI;
    }

    public function getDocumentROOT() {
        return $this->documentROOT;
    }

    public function getRequestURI() {
        return $this->requestURI;
    }

    public function setDocumentROOT($documentROOT): void {
        $this->documentROOT = $documentROOT;
    }

    public function setRequestURI($requestURI): void {
        $this->requestURI = $requestURI;
    }

    public function getPath(): string {
        $path = explode('?', $this->documentROOT . $this->getRequestURI(), 2);
        return $path[0];
    }

    public function route() {
        $path = $this->getPath();
        while (strlen($path) > strlen($this->documentROOT) + 1) {
            $routerPath = $path . '/index.php';

            if (file_exists($routerPath)) {
                require_once ($routerPath);
                return;
            }

            $path = dirname($path);
        }
    }

}
