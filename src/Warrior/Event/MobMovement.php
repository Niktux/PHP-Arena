<?php

namespace Warrior\Event;
use Symfony\Component\EventDispatcher\Event;
use Warrior\Core\Mob;

class MobMovement extends Event
{
    private 
        $mob,
        $direction;
    
    public function __construct(Mob $mob, $direction)
    {
        $this->mob = $mob;
        $this->direction = $direction;
    }
    
    public function getMob()
    {
        return $this->mob;
    }
    
    public function getDirection()
    {
        return $this->direction;
    }
}
