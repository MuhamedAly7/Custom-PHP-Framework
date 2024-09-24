<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit67e7c1ee15a1fcf02e0ff23ace2d59dc
{
    public static $files = array (
        '4ba729a45d96812744150a1622f5457d' => __DIR__ . '/..' . '/mvc/customframework/helpers/main.php',
    );

    public static $prefixLengthsPsr4 = array (
        'I' => 
        array (
            'Illuminates\\' => 12,
        ),
        'C' => 
        array (
            'Customframework\\' => 16,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Illuminates\\' => 
        array (
            0 => __DIR__ . '/..' . '/mvc/customframework/illuminates',
        ),
        'Customframework\\' => 
        array (
            0 => __DIR__ . '/..' . '/mvc/customframework/framework',
        ),
        'App\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit67e7c1ee15a1fcf02e0ff23ace2d59dc::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit67e7c1ee15a1fcf02e0ff23ace2d59dc::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit67e7c1ee15a1fcf02e0ff23ace2d59dc::$classMap;

        }, null, ClassLoader::class);
    }
}
