<?php

use Warrior\Core\Game;
use Warrior\Core\Exceptions as Exceptions;
use Warrior\Core\EndConditionCheckers\Timeout;
use Warrior\Core\World\Line;
use Warrior\Core\Renderer\Line\Cli;
use Warrior\Core\EndConditionCheckers\ExitReached;
use Warrior\Core\Mobs\Strategy\Dumb;
use Warrior\Core\Mobs\Player;

require '../vendor/autoload.php';

$player = new Player('bob', 10);
$player->setStrategy(new Dumb());

$world = new Line(10);
$world->addMob($player, 5)
      ->addEventSubscriber(new Cli());

$g = new Game($world);
$g->addEndConditionChecker(new Timeout(15))
  ->addEndConditionChecker(new ExitReached(0));

$g->launch();