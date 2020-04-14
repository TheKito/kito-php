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

namespace Kito\Loader;

/**
 *
 * @author TheKito < blankitoracing@gmail.com >
 */
class Sources {

    public static function attach(Loader $loader): void {
        $loader->addRepository('/Psr/Log', 'https://raw.githubusercontent.com/php-fig/log/master/Psr/Log');
        $loader->addRepository('/Psr/Http/Message', 'https://raw.githubusercontent.com/php-fig/http-message/master/src');
        $loader->addRepository('/Psr/Http/Message', 'https://raw.githubusercontent.com/php-fig/http-factory/master/src');
        $loader->addRepository('/Psr/Http/Server', 'https://raw.githubusercontent.com/php-fig/http-server-handler/master/src');
        $loader->addRepository('/Psr/Http/Server', 'https://raw.githubusercontent.com/php-fig/http-server-middleware/master/src/');
        $loader->addRepository('/Psr/Container', 'https://raw.githubusercontent.com/php-fig/container/master/src/');
        
        $loader->addRepository('/Fig/Http/Message', 'https://raw.githubusercontent.com/php-fig/http-message-util/master/src/');
        
        $loader->addRepository('/Jasny/HttpMessage', 'https://raw.githubusercontent.com/jasny/http-message/master/src/');
        
        $loader->addRepository('/Nyholm/Psr7', 'https://raw.githubusercontent.com/Nyholm/psr7/master/src/');
        $loader->addRepository('/Nyholm/Psr7Server', 'https://raw.githubusercontent.com/Nyholm/psr7-server/master/src/');
        
        $loader->addRepository('/PHPMailer/PHPMailer', 'https://raw.githubusercontent.com/PHPMailer/PHPMailer/master/src/');        
                
        $loader->addRepository('/FastRoute', 'https://raw.githubusercontent.com/nikic/FastRoute/master/src/');
        $loader->addRepository('/FastRoute', 'https://raw.githubusercontent.com/TheKito/FastRoute/master/src/');

        $loader->addRepository('/Slim', 'https://raw.githubusercontent.com/TheKito/Slim/4.x/Slim/');
        $loader->addRepository('/Slim/Psr7', 'https://raw.githubusercontent.com/slimphp/Slim-Psr7/master/src/');
        $loader->addRepository('/Slim/Http', 'https://raw.githubusercontent.com/slimphp/Slim-Http/master/src/');



        
        $loader->addRepository('/GeoIp2', 'https://raw.githubusercontent.com/maxmind/GeoIP2-php/master/src/');        

        $loader->addRepository('/Guzzle/Http', 'https://raw.githubusercontent.com/thekito/guzzle/master/src');

        $loader->addRepository('/Symfony', 'https://raw.githubusercontent.com/symfony/symfony/master/src/Symfony');

        $loader->addRepository('/Illuminate', 'https://raw.githubusercontent.com/laravel/framework/6.x/src');


        $loader->addRepository('/Datto/JsonRpc', 'https://github.com/datto/php-json-rpc/blob/master/src');
        $loader->addRepository('/Datto/JsonRpc/Http', 'https://github.com/datto/php-json-rpc-http/blob/master/src');
        $loader->addRepository('/Datto/JsonRpc/Ssh', 'https://github.com/datto/php-json-rpc-ssh/blob/master/src');

        $loader->addRepository('/Gnello/OpenFireRestAPI', 'https://raw.githubusercontent.com/gnello/php-openfire-restapi/master/src');

        $loader->addRepository('/Kito/Proxy', 'https://raw.githubusercontent.com/TheKito/proxy/master/src');
    }

}
