<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInite11cb479b3a3883571702386eb81a99c
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInite11cb479b3a3883571702386eb81a99c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInite11cb479b3a3883571702386eb81a99c::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInite11cb479b3a3883571702386eb81a99c::$classMap;

        }, null, ClassLoader::class);
    }
}
