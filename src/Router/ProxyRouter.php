<?php

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
