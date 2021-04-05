<?php

require_once 'vendor/autoload.php';

use GCTL\Command\Group;
use GCTL\Command\Shutdown;
use GCTL\Command\Start;
use GCTL\Command\Status;
use Symfony\Component\Console\Application;

$application = new Application();
$application->add(new Status());
$application->add(new Group());
$application->add(new Shutdown());
$application->add(new Start());

try {
    $application->run();
} catch (Exception $e) {
}