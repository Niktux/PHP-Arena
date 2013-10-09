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
        $actions;
    
    public function __construct()
    {
        $this->actions = null;
    }
    
    public function setMobAction(MobAction $actions)
    {
        $this->actions = $actions;
        
        return $this;
    }
    
    public function play(WorldSensor $sensor)
    {
        $direction = Direction::FORWARD;
        
        if($sensor->look($direction) !== false)
        {
            $this->actions->move($direction);
            echo "Move forward\n";
        }
    }
}