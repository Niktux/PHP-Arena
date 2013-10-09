<?php

namespace Warrior\Event;

use Symfony\Component\EventDispatcher\Event;

class WorldDescription extends Event
{
    private
        $places;
    
    public function __construct(array $places)
    {
        $this->places = $places;
    }    
    
    public function getPlaces()
    {
        return $this->places;
    }
}