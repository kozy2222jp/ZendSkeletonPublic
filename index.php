<?php
// Setting env_var of components of ZF2
putenv("ZF2_PATH=" . 'C:\xampp\Library\ZendFramework-2.4.8\library');

/**
 * This makes our life easier when dealing with paths. Everything is relative
 * to the application root now.
 */
chdir('C:\xampp\ZendSkeleten');

// Decline static file requests back to the PHP built-in webserver
// if the SAPI(server API) is PHP built-in server
// 指定したURLが、Webサーバー上のindex.phpでなく、しかもそのURLのファイルが存在した
// 場合、falseで処理を抜ける
if (php_sapi_name() === 'cli-server') {
    $path = realpath(__DIR__ . parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));
    if (__FILE__ !== $path && is_file($path)) {
        return false;
    }
    unset($path);
}

// Setup autoloading
require 'init_autoloader.php';

// Run the application!
Zend\Mvc\Application::init(require 'config/application.config.php')->run();
