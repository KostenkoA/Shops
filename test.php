<?php

require __DIR__ . '/vendor/autoload.php';

use  \App\Service\Filesystem\PathName;

$result = new PathName();

$result->getNameFile('sony.jpg');

var_dump($result->getNameFile('sony.jpg'));
