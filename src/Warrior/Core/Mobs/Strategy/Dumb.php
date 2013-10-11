<?php

namespace Warrior\Core\Mobs\Strategy;

use Warrior\Core\Mob;
use Warrior\Core\World;
use Warrior\Core\WorldSensor;
use Warrior\Core\Direction;
use Warrior\Core\MobStrategy;
use Warrior\Core\Action\Move;
use Warrior\Core\Block;

class Dumb implements MobStrategy
{
    private
        $direction;
    
    public function __construct()
    {
        $this->direction = Direction::FORWARD;
    }
    
    public function play(WorldSensor $sensor)
    {
        $block = $sensor->look($this->direction);
        
        if(!$block instanceof Block)
        {
            $this->changeDirection(); 
        }
        else if(! $block->isReachable())
        {
            $this->changeDirection();
        }

        return new Move($this->direction);
    }
    
    private function changeDirection()
    {
        if($this->direction === Direction::BACKWARD)
        {
            $this->direction = Direction::FORWARD;
        }
        else 
        {
            $this->direction = Direction::BACKWARD;
        }
    }
}