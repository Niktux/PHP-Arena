<?php

namespace Warrior\Core\Action;

use Warrior\Core\Action;
use Warrior\Core\World;
use Warrior\Core\Mob;
use Warrior\Core\Direction;

class Move implements Action
{
    private
        $direction;
    
    public function __construct($direction = Direction::FORWARD)
    {
        $this->direction = $direction;
    }
    
    public function execute(Mob $mob, World $world)
    {
        $world->move($mob, $this->direction);
    }
}
