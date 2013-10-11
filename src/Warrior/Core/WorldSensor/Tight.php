<?php

namespace Warrior\Core\WorldSensor;

use Warrior\Core\WorldSensor;
use Warrior\Core\World;
use Warrior\Core\Direction;
use Warrior\Core\Mob;
use Warrior\Core\Mobs\MobAware;
use Warrior\Core\BlockInfo;

class Tight implements WorldSensor
{
    use MobAware;
    
    private 
        $world;
    
    public function __construct(World $w, Mob $mob)
    {
        $this->mob = $mob;
        $this->world = $w;
    }
    
    public function look($direction = Direction::FORWARD)
    {
        $block = $this->world->getNextBlock($this->mob, $direction);
        
        return new BlockInfo($block);
    }
}