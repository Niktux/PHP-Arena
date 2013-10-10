<?php

namespace Warrior\Core\EndConditionCheckers;

use Warrior\Core\EndConditionChecker;
use Warrior\Core\Game;
use Warrior\Core\Exceptions\GameEndCondition;
use Warrior\Mobs\Filter\PlayerFilterIterator;

class ExitReached implements EndConditionChecker
{
    private
        $exitPlaceId;
    
    public function __construct($exitPlaceId)
    {
        $this->exitPlaceId = $exitPlaceId;
    }
    
    public function check(Game $g)
    {
        $w = $g->getWorld();
        
        $players = new PlayerFilterIterator($w->getMobs());
        
        foreach($players as $player)
        {
            $playerPlaceId = $w->getMobPlaceId($player);
            
            if($playerPlaceId === $this->exitPlaceId)
            {
                throw new GameEndCondition(sprintf('%s WINS', $player->getName()));
            }
        }
    }    
}