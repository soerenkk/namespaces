<?php

namespace OOP;

/**
 * Autoloads classes
 *
 * @author    Søren K. Kjeldsen <soerenkk at soerenkk dot dk>
 * @license   MIT License
 */
class Autoloader
{
    private $dir;

    public function __construct($dir = null)
    {
        if (is_null($dir)) {
            $dir = dirname(__FILE__).'/..';
        }
        $this->dir = $dir;
    }
    /**
     * Registers Autoloader as an SPL autoloader.
     */
    public static function register($dir = null)
    {
        ini_set('unserialize_callback_func', 'spl_autoload_call');
        spl_autoload_register(array(new self($dir), 'autoload'));
    }

    /**
     * Handles autoloading of classes.
     *
     * @param  string  $class  A class name.
     *
     * @return boolean Returns true if the class has been loaded
     */
    public function autoload($class)
    {
        
        if (0 !== strpos($class, 'OOP')) {
            return;
        }

        if (file_exists($file = $this->dir.'/'.str_replace('\\', '/', $class).'.php')) {
            require $file;
        }
    }
}

?>
