<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit78e4b320a8b2cdbdc2dd611168adbf99
{
    public static $files = array (
        'a15242c4c110da6c11366ed896c0f878' => __DIR__ . '/../..' . '/includes/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'H' => 
        array (
            'Health\\Care\\' => 12,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Health\\Care\\' => 
        array (
            0 => __DIR__ . '/../..' . '/includes',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit78e4b320a8b2cdbdc2dd611168adbf99::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit78e4b320a8b2cdbdc2dd611168adbf99::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit78e4b320a8b2cdbdc2dd611168adbf99::$classMap;

        }, null, ClassLoader::class);
    }
}
