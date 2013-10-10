<?php

namespace Warrior\Core\Mobs\Strategy;

use Warrior\Core\Mob;
use Warrior\Core\World;
use Warrior\Core\WorldSensor;
use Warrior\Core\Direction;
use Warrior\Core\MobStrategy;
use Warrior\Core\Action\Move;

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
        if($sensor->look($this->direction) === false)
        {
            $this->changeDirection(); 
        }

        return new Move($this->direction);
    }
    
    private function changeDirection()
    {
        $this->direction = $this->direction === Direction::BACKWARD ? Direction::FORWARD : Direction::BACKWARD;
    }
}