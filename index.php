<?php
include('Templates/header.php');

/**
 * Autoload
 */
spl_autoload_register(function($class) {
    include str_replace('\\', '/', $class) . '.php';
});

$controller = new Controllers\UserController();
$controller->index();

include('Templates/footer.php');
