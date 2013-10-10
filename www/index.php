<?php

use Warrior\Core\Game;
use Warrior\Core\Exceptions as Exceptions;
use Warrior\Core\EndConditionCheckers\Timeout;
use Warrior\World\Line;
use Warrior\Renderer\Line\Cli;
use Warrior\Core\EndConditionCheckers\ExitReached;
use Warrior\Mobs\Unit;
use Warrior\Mobs\Strategy\Dumb;

require '../vendor/autoload.php';

$player = new Unit(10);
$player->setStrategy(new Dumb());

$world = new Line(10);
$world->setPlayer($player, 5)
      ->addEventSubscriber(new Cli());

$g = new Game($world);
$g->addEndConditionChecker(new Timeout(15))
  ->addEndConditionChecker(new ExitReached(0));

$g->launch();