<?php

namespace Warrior\Core;

class MobAction
{
    private 
        $world,
        $mob;
    
    public function __construct(World $w, Mob $mob)
    {
        $this->world = $w;
        $this->mob = $mob;
    }
    
    public function move($direction)
    {
       $this->world->move($this->mob, $direction);
    }
}