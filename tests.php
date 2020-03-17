<?php
if (!isset($_GET['test'])) {
    include('Templates/header.php');
}

$controller = new Tests\TestController();
$controller->run();

if (!isset($_GET['test'])) {
    include('Templates/footer.php');
}


/**
 * Autoload
 */
function __autoload($className) {
    $extensions = array(".php", ".class.php", ".inc");
    $paths = explode(PATH_SEPARATOR, get_include_path());
    $className = str_replace("_" , DIRECTORY_SEPARATOR, $className);
    foreach ($paths as $path) {
        $filename = $path . DIRECTORY_SEPARATOR . $className;
        foreach ($extensions as $ext) {
            if (is_readable($filename . $ext)) {
                require_once $filename . $ext;
                break;
           }
       }    
    }
}