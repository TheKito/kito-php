<?php
define('base', __DIR__ . DIRECTORY_SEPARATOR . '..' . DIRECTORY_SEPARATOR);
define('baseDir', base . 'src');
define('baseVendor', 'Kito');



$out = '<?php
use PHPUnit\Framework\TestCase;

class ExceptionTest extends TestCase
{';

scan(baseDir . DIRECTORY_SEPARATOR);

$out.='}';
var_dump($out);
file_put_contents(base . 'tests' .DIRECTORY_SEPARATOR .'ExceptionTest.php', $out);
function scan($path)
{
    foreach (scandir($path) as $name) {
        if ($name == '.') {
            continue;
        }
        if ($name == '..') {
            continue;
        }

        $subPath = $path . $name;

        if (is_file($subPath)) {
            scanFile($subPath);
        }

        if (is_dir($subPath)) {
            scan($subPath . DIRECTORY_SEPARATOR);
        }
    }
}

function scanFile($path)
{
    if (substr($path, -13) != 'Exception.php') {
        return;
    }
    
    $path = substr($path, 0, -4);
    
    $ns = str_replace('/', '\\', baseVendor . substr($path, strlen(baseDir)));
    $fn = 'test'.str_replace('\\', '', $ns);
    
    global $out;
    $out.= '
    public function '.$fn.'()
    {        
        $this->expectException('.$ns.'::class);
        throw new '.$ns.'("Test");
    }
' ;
}
