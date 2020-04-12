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

namespace Kito\Lab;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
class CURL {

    private $curl;

    public function __construct() {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->curl, CURLOPT_MAXREDIRS, 3);
        curl_setopt($this->curl, CURLOPT_BINARYTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_USERAGENT, 'Mozilla/4.0 (Windows; U; Windows NT 5.1; en-US; rv:1.8.1.13) Gecko/20080311 Firefox/3.0.0.13');
    }

    public function setSOCKS5Proxy(string $proxyHost, int $proxyPort) {
        return $this->setProxy(CURLPROXY_SOCKS5, $proxyHost, $proxyPort);
    }

    public function setHTTPProxy(string $proxyHost, int $proxyPort) {
        return $this->setProxy(CURLPROXY_HTTP, $proxyHost, $proxyPort);
    }

    public function setHTTPSProxy(string $proxyHost, int $proxyPort) {
        return $this->setProxy(CURLPROXY_HTTPS, $proxyHost, $proxyPort);
    }

    private function setProxy(int $proxyType, string $proxyHost, int $proxyPort) {
        curl_setopt($this->curl, CURLOPT_PROXYTYPE, $proxyType);
        curl_setopt($this->curl, CURLOPT_PROXY, $proxyHost . ':' . $proxyPort);
        $this->curlSetCookiePath($this->curl, sys_get_temp_dir() . '/' . sha1($proxyType . '://' . $proxyHost . ':' . $proxyPort));
    }

    private function curlSetCookiePath($path) {
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $path);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, $path);
    }

    public function makeRequest(string $url, string $proxyType = 'socks5', string $proxyHost = '127.0.0.1:9050') {


        curl_setopt($this->curl, CURLOPT_URL, ltrim($url, '/'));
        $data = curl_exec($this->curl);

        if (curl_getinfo($this->curl, CURLINFO_HTTP_CODE) < 300) {
            return array(
                'content' => $data,
                'location' => curl_getinfo($this->curl, CURLINFO_EFFECTIVE_URL),
                curl_getinfo($this->curl)
            );
        }
    }

}
