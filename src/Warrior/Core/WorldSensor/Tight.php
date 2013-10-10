<?php

namespace Warrior\Core\WorldSensor;

use Warrior\Core\WorldSensor;
use Warrior\Core\World;
use Warrior\Core\Direction;
use Warrior\Core\Mob;
use Warrior\Core\Mobs\MobAware;

class Tight implements WorldSensor
{
    use MobAware;
    
    private 
        $world,
        $sensorPlaceId;
    
    public function __construct(World $w, Mob $mob)
    {
        $this->mob = $mob;
        $this->world = $w;
        $this->sensorPlaceId = $w->getMobPlaceId($mob);
    }
    
    public function look($direction = Direction::FORWARD)
    {
        return $this->world->getNextPlaceId($this->sensorPlaceId, $direction);
    }
}