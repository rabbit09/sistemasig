<?php

use Doctrine\Common\Annotations\AnnotationRegistry;
use Composer\Autoload\ClassLoader;

/**
 * @var $loader ClassLoader
 */
$loader = require __DIR__ . '/../vendor/autoload.php';

AnnotationRegistry::registerLoader(array($loader, 'loadClass'));

// Register modules
/*AnnotationRegistry::registerAutoloadNamespace('Fightmaster', __DIR__ . '/../vendor/dao/src');
AnnotationRegistry::registerAutoloadNamespace('Fightmaster', __DIR__ . '/../vendor/bundles');*/

//AnnotationRegistry::registerAutoloadNamespace('PunkAve', __DIR__ . '/../vendor/bundles');

return $loader;
