<?php

namespace Warrior\Core\EndConditionCheckers;

use Warrior\Core\EndConditionChecker;
use Warrior\Core\Game;
use Warrior\Core\Exceptions\GameEndCondition;
use Warrior\Core\Mobs\Filter\PlayerFilterIterator;
use Warrior\Core\Block;

class ExitReached implements EndConditionChecker
{
    private
        $exitBlock;
    
    public function __construct(Block $exitBlock)
    {
        $this->exitBlock = $exitBlock;
    }
    
    public function check(Game $g)
    {
        $w = $g->getWorld();
        
        $players = new PlayerFilterIterator($w->getMobs());
        
        foreach($players as $player)
        {
            $playerBlock = $w->getMobBlock($player);
            
            if($playerBlock === $this->exitBlock)
            {
                throw new GameEndCondition(sprintf('%s WINS', $player->getName()));
            }
        }
    }    
}