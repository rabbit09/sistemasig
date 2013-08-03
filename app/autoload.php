<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var $loader ClassLoader
 */
$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// Register modules
AnnotationRegistry::registerAutoloadNamespace(array('Fightmaster' => __DIR__ . '/../vendor/dao/src'));

return $loader;
