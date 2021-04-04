<?php

require_once 'vendor/autoload.php';

use GCTL\Command\Group;
use GCTL\Command\Shutdown;
use GCTL\Command\Status;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Status());
$application->add(new Group());
$application->add(new Shutdown());


try {
    $application->run();
} catch (Exception $e) {
}