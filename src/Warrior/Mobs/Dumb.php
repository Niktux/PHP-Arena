<?php

namespace Warrior\Mobs;

use Warrior\Core\Mob;
use Warrior\Core\World;
use Warrior\Core\WorldSensor;
use Warrior\Core\Direction;
use Warrior\Core\MobAction;

class Dumb implements Mob
{
    private
        $direction,
        $actions;
    
    public function __construct()
    {
        $this->direction = Direction::FORWARD;
        $this->actions = null;
    }
    
    public function setMobAction(MobAction $actions)
    {
        $this->actions = $actions;
        
        return $this;
    }
    
    public function play(WorldSensor $sensor)
    {
        if($sensor->look($this->direction) === false)
        {
            $this->changeDirection(); 
        }
        
        $this->actions->move($this->direction);
    }
    
    private function changeDirection()
    {
        $this->direction = $this->direction === Direction::BACKWARD ? Direction::FORWARD : Direction::BACKWARD;
    }
}