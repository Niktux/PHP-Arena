<?php

namespace Warrior\Core\EndConditionCheckers;

use Warrior\Core\EndConditionChecker;
use Warrior\Core\Game;
use Warrior\Core\Exceptions\GameEndCondition;
use Warrior\Core\Mobs\Filter\PlayerFilterIterator;

class ExitReached implements EndConditionChecker
{
    private
        $exitBlockId;
    
    public function __construct($exitBlockId)
    {
        $this->exitBlockId = $exitBlockId;
    }
    
    public function check(Game $g)
    {
        $w = $g->getWorld();
        
        $players = new PlayerFilterIterator($w->getMobs());
        
        foreach($players as $player)
        {
            $playerBlockId = $w->getMobBlockId($player);
            
            if($playerBlockId === $this->exitBlockId)
            {
                throw new GameEndCondition(sprintf('%s WINS', $player->getName()));
            }
        }
    }    
}