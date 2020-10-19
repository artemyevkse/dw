<?

class Autoloader
{
    public function __construct()
    {
        spl_autoload_register(array($this, '_autoload'));
    }

    protected function _autoload($class)
    {
        $path = '';

        if ($pos = strpos($class, 'Model')) {
            $path = strtolower(substr($class, 0, $pos)) . '/';
        }

        include $path . $class . '.php';
    }
}
