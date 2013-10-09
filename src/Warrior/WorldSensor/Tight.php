<?php

namespace Warrior\WorldSensor;

use Warrior\Core\WorldSensor;
use Warrior\Core\World;
use Warrior\Core\Direction;

class Tight implements WorldSensor
{
    private 
        $world,
        $sensorPlaceId;
    
    public function __construct(World $w)
    {
        $this->world = $w;
        $this->sensorPlaceId = $w->getMobPlaceId($w->getPlayer());
    }
    
    public function look($direction = Direction::FORWARD)
    {
        return $this->world->getNextPlaceId($this->sensorPlaceId, $direction);
    }
}