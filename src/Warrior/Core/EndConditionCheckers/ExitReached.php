<?php

namespace Warrior\Core\EndConditionCheckers;

use Warrior\Core\EndConditionChecker;
use Warrior\Core\Game;
use Warrior\Core\Exceptions\GameEndCondition;

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
        $playerPlaceId = $w->getMobPlaceId($w->getPlayer());
        
        if($playerPlaceId === $this->exitPlaceId)
        {
            throw new GameEndCondition('VICTORY');
        }
    }    
}