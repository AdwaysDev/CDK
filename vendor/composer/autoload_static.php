<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit91797db5b47784680e6f5ace6777be8d
{
    public static $prefixesPsr0 = array (
        'A' => 
        array (
            'Adways\\Property\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
            'Adways\\Content\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
            'Adways\\Constant\\' => 
            array (
                0 => __DIR__ . '/..' . '/adways-constant/src',
            ),
            'Adways\\' => 
            array (
                0 => __DIR__ . '/../..' . '/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixesPsr0 = ComposerStaticInit91797db5b47784680e6f5ace6777be8d::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}
