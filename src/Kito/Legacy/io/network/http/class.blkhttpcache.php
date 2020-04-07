<?php

class BLKHTTPCache extends BLKHTTP
{

    private $cacheDir = null;

    public function __construct($sessionName = null, $workDir = '/tmp')
    {
        parent::__construct($sessionName, $workDir);

        $this->cacheDir = $workDir . DIRECTORY_SEPARATOR . 'CACHE';
        if (!file_exists($this->cacheDir)) {
            @mkdir($this->cacheDir, 0777, true);
        }
    }

    public function doCallCache($url, $params = array(), $post = false, $enctype = 'application/x-www-form-urlencoded', $referer = null)
    {
        $hash = sha1($url . '-' . implode('.', array_keys($params)) . '|' . implode('.', $params) . '-' . ($post ? 1 : 0) . '-' . $enctype . '-' . $referer);
        $file = $this->cacheDir . DIRECTORY_SEPARATOR . $hash . '.cache';
        var_dump($file);
        if (!file_exists($file)) {
            $cache = false;
        } else {
            $cache = json_decode(file_get_contents($file), true);
        }

        if ($cache === false) {
            $data = parent::doCall($url, $params, $post, $enctype, $referer);

            file_put_contents(
                $file, json_encode(
                    array(
                                'url' => $url,
                                'params' => $params,
                                'post' => $post,
                                'enctype' => $enctype,
                                'referer' => $referer,
                                'data' => base64_encode($data),
                            )
                )
            );
        } else {
            $data = base64_decode($cache['data']);
        }

        return $data;
    }

}
