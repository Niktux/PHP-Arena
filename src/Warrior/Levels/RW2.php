<?php

namespace Warrior\Levels;

use Warrior\Core\Player;
use Warrior\Core\Level\AbstractLevel;
use Warrior\Core\World\Line;
use Warrior\Core\Game;
use Warrior\Core\EndConditionCheckers\Timeout;
use Warrior\Core\EndConditionCheckers\ExitReached;
use Warrior\Bots\Goblin;

class RW2 extends AbstractLevel
{
    public function launch(Player $player)
    {
        $world = $this->buildWorld();
        $world->addMob($player, 1);
        
        $game = new Game($world);
        $game->addEndConditionChecker(new Timeout())
             ->addEndConditionChecker(new ExitReached($world->getBlock(8)));
        
        $game->launch();
    }
    
    /**
     * @return \Warrior\Core\World
     */
    private function buildWorld()
    {
        $world = new Line(10);
        $world->addMob(new Goblin(10), 5);
        
        foreach($this->subscribers as $subscriber)
        {
            $world->addEventSubscriber($subscriber);
        }
        
        return $world;
    }
}