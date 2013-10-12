<?php

namespace Warrior\Core\Mobs\Strategy;

use Warrior\Core\Mob;
use Warrior\Core\World;
use Warrior\Core\WorldSensor;
use Warrior\Core\Direction;
use Warrior\Core\MobStrategy;
use Warrior\Core\Block;
use Warrior\Core\Action\Wait;
use Warrior\Core\Action\Attack;
use Warrior\Core\Player;

class WaitAndAttack implements MobStrategy
{
    public function play(WorldSensor $sensor)
    {
        $directions = array(Direction::FORWARD, Direction::BACKWARD);
        
        foreach($directions as $direction)
        {
            $block = $sensor->look($direction);
            
            if($block instanceof Block)
            {
                if($block->hasMob())
                {
                    if($block->getMob() instanceof Player)
                    {
                        return new Attack($direction);
                    }
                }
            }
        }
        
        return new Wait();
    }
}