<?
    define('APPLICATION_PATH', getcwd() . '/application/');

    set_include_path(implode(PATH_SEPARATOR . APPLICATION_PATH, array(get_include_path(),
		'services/', '../library/', 'forms/'
    )));

    include('library/Starter.php');

    $starter = new Starter();
    $starter->run();