<?php

use Warrior\Core\Game;
use Warrior\Core\Exceptions as Exceptions;
use Warrior\Core\EndConditionCheckers\Timeout;
use Warrior\Core\World\Line;
use Warrior\Core\Renderer\Line\Cli;
use Warrior\Core\EndConditionCheckers\ExitReached;
use Warrior\Core\Mobs\Strategy\Dumb;
use Warrior\Core\Mobs\Player;
use Warrior\Bots\Goblin;
use Warrior\Core\MobStrategy;
use Warrior\Core\WorldSensor;
use Warrior\Core\Action\Attack;
use Warrior\Core\Action\Move;
use Warrior\Core\Action\Rest;

require 'vendor/autoload.php';

$player = new Player('Spartacus', 20);
$player->setStrategy(new Dumb());
/*
$level = new RW1();
$level->addEventSubscriber(new Cli())
      ->launch($player);

//*/
class Forward implements MobStrategy
{
	public function play(WorldSensor $sensor)
	{
	    $block = $sensor->look();
	    
	    if($block->hasMob())
	    {
	        return new Attack();
	    }
	    
	    return new Move();
	}
}

class ForwardAndRest implements MobStrategy
{
    public function play(WorldSensor $sensor)
    {
        $block = $sensor->look();
         
        if($block->hasMob())
        {
            return new Attack();
        }
         
        if($sensor->getHealth() < 20)
        {
            return new Rest();
        }
        
        return new Move();
    }
}


$player->setStrategy(new ForwardAndRest());

$level = new Warrior\Levels\RW3();
$level->addEventSubscriber(new Cli())
      ->launch($player);