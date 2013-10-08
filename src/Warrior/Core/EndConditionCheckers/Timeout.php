<?php

namespace Warrior\Core\EndConditionCheckers;

use Warrior\Core\EndConditionChecker;
use Warrior\Core\Game;
use Warrior\Core\Exceptions\GameEndCondition;

class Timeout implements EndConditionChecker
{
    private
        $stepLimit;
    
    public function __construct($stepLimit = 10)
    {
        $this->stepLimit = $stepLimit;
    }
    
    public function check(Game $g)
    {
        if($g->getStep() > $this->stepLimit)
        {
            throw new GameEndCondition('Step limit has been reached');
        }
    }    
}