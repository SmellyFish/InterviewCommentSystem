<?php

// Add app root to include path for convenience
ini_set(
    'include_path',
    sprintf(
        "%s:%s",
        ini_get('include_path'),
        dirname(__DIR__)
    )
);

require_once 'vendor/autoload.php';

use Pimple\Container;
$container = new Container();

$container['config'] = function ($c) {
    return json_decode(file_get_contents("conf/config.json", true), true);
};

$container['databaseConnection'] = function ($c) {
    $pdoDsn = sprintf(
        'mysql:host=%s;dbname=%s;charset=%s',
        $c['config']['mysql']['host'],
        $c['config']['mysql']['database'],
        'utf8'
    );

    $pdoOptions = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        PDO::ATTR_EMULATE_PREPARES => false,
    ];

    return new PDO(
        $pdoDsn,
        $c['config']['mysql']['username'],
        $c['config']['mysql']['password'],
        $pdoOptions
    );
};
