<?php

namespace Warrior\WorldSensor;

use Warrior\Core\WorldSensor;
use Warrior\Core\World;
use Warrior\Core\Direction;
use Warrior\Core\Mob;

class Tight implements WorldSensor
{
    private 
        $world,
        $sensorPlaceId;
    
    public function __construct(World $w, Mob $mob)
    {
        $this->world = $w;
        $this->sensorPlaceId = $w->getMobPlaceId($mob);
    }
    
    public function look($direction = Direction::FORWARD)
    {
        return $this->world->getNextPlaceId($this->sensorPlaceId, $direction);
    }
}