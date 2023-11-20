<?php

// autoload_real.php @generated by Composer

class ComposerAutoloaderInit274c6ddda92d8371c1d059cd911a473f
{
    private static $loader;

    public static function loadClassLoader($class)
    {
        if ('Composer\Autoload\ClassLoader' === $class) {
            require __DIR__ . '/ClassLoader.php';
        }
    }

    /**
     * @return \Composer\Autoload\ClassLoader
     */
    public static function getLoader()
    {
        if (null !== self::$loader) {
            return self::$loader;
        }

        spl_autoload_register(array('ComposerAutoloaderInit274c6ddda92d8371c1d059cd911a473f', 'loadClassLoader'), true, true);
        self::$loader = $loader = new \Composer\Autoload\ClassLoader(\dirname(__DIR__));
        spl_autoload_unregister(array('ComposerAutoloaderInit274c6ddda92d8371c1d059cd911a473f', 'loadClassLoader'));

        require __DIR__ . '/autoload_static.php';
        call_user_func(\Composer\Autoload\ComposerStaticInit274c6ddda92d8371c1d059cd911a473f::getInitializer($loader));

        $loader->register(true);

        return $loader;
    }
}
