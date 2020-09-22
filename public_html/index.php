<?
    define('APPLICATION_PATH', getcwd() . '/application/');
    
    set_include_path(get_include_path() . PATH_SEPARATOR
        . APPLICATION_PATH . 'services/'
    );

    include('library/Starter.php');

    $starter = new Starter();
    $starter->run();
