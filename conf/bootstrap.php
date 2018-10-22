<?php

// Add app root to include path for convenience
ini_set(
    'include_path',
    sprintf(
        "%s:%s",
        ini_get('include_path'),
        dirname(dirname(__FILE__))
    )
);

require_once 'vendor/autoload.php';

use Pimple\Container;
$container = new Container();
$container['database'] = new Database();