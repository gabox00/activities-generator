<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf716448cae7f01d02287dd1481b86f54
{
    public static $prefixLengthsPsr4 = array (
        'U' => 
        array (
            'UF1\\Models\\' => 11,
            'UF1\\Enums\\' => 10,
            'UF1\\Controllers\\' => 16,
            'UF1\\Config\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'UF1\\Models\\' => 
        array (
            0 => __DIR__ . '/../..' . '/models',
        ),
        'UF1\\Enums\\' => 
        array (
            0 => __DIR__ . '/../..' . '/enums',
        ),
        'UF1\\Controllers\\' => 
        array (
            0 => __DIR__ . '/../..' . '/controllers',
        ),
        'UF1\\Config\\' => 
        array (
            0 => __DIR__ . '/../..' . '/config',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf716448cae7f01d02287dd1481b86f54::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf716448cae7f01d02287dd1481b86f54::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf716448cae7f01d02287dd1481b86f54::$classMap;

        }, null, ClassLoader::class);
    }
}
