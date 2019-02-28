<?php
// DIC configuration
$container = $app->getContainer();

// monolog
$container['logger'] = function ($c) {
    $settings = $c->get('settings')['logger'];
    $logger = new Monolog\Logger($settings['name']);
    $logger->pushProcessor(new Monolog\Processor\UidProcessor());
    $logger->pushHandler(new Monolog\Handler\StreamHandler($settings['path'], $settings['level']));
    return $logger;
};

$container['em'] = function ($c) {
  
   $config = Doctrine\ORM\Tools\Setup::createAnnotationMetadataConfiguration(
        $c->get('settings')['doctrine']['metadata_dirs'],
        $c->get('settings')['doctrine']['dev_mode']
    );

    $config->setMetadataDriverImpl(
        new Doctrine\ORM\Mapping\Driver\AnnotationDriver(
            new Doctrine\Common\Annotations\AnnotationReader,
            $c->get('settings')['doctrine']['metadata_dirs']
        )
    );

    $config->setMetadataCacheImpl(
        new Doctrine\Common\Cache\FilesystemCache(
            $c->get('settings')['doctrine']['cache_dir']
        )
    );

    return Doctrine\ORM\EntityManager::create(
        $c->get('settings')['doctrine']['connection'],
        $config
    );
};