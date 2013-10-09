<?php

use Warrior\Core\Game;
use Warrior\Core\Exceptions as Exceptions;
use Warrior\Core\EndConditionCheckers\Timeout;
use Warrior\World\Line;
use Warrior\Mobs\Dumb;
use Warrior\Renderer\Line\Cli;

require '../vendor/autoload.php';

$world = new Line(12);
$world->setPlayer(new Dumb(), 0)
      ->addEventSubscriber(new Cli());

$g = new Game($world);
$g->addEndConditionChecker(new Timeout(15));

$g->launch();