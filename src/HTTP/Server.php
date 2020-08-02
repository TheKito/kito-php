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

namespace Kito\HTTP;

use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
class Server
{
    public static function getRequest(): ServerRequestInterface
    {
        return (new \Jasny\HttpMessage\ServerRequest())->withGlobalEnvironment();
    }

    public static function sendResponse(ResponseInterface $response)
    {
        $emitter = new \Jasny\HttpMessage\Emitter();
        $emitter->emit($response);
    }
}
