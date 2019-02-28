<?php

$autoloadFiles = array(
    __DIR__ . '/../vendor/autoload.php',
    __DIR__ . '/../../../autoload.php'
);

$autoloader = false;
foreach ($autoloadFiles as $autoloadFile) {
    if (file_exists($autoloadFile)) {
        require_once $autoloadFile;
        $autoloader = true;
    }
}

if (!$autoloader) {
    die('vendor/autoload.php could not be found. Did you run `php composer.phar install`?');
}