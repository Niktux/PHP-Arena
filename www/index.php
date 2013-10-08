<?php

use Warrior\Core\Game;
use Warrior\Core\Exceptions as Exceptions;
use Warrior\Core\EndConditionCheckers\Timeout;

require '../vendor/autoload.php';

$g = new Game();
$g->addEndConditionChecker(new Timeout(5));

$g->launch();