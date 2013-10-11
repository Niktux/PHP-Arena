<?php

namespace Warrior\Core\Block;

use Warrior\Core\Block;
use Warrior\Core\Mob;

class Air implements Block
{
    private 
        $mob;
    
    public function __construct()
    {
        $this->mob = null;
    }
    
    public function isReachable()
    {
        return true;
    }    
    
    public function setMob(Mob $mob)
    {
        $this->mob = $mob;
        
        return $this;
    }
    
    public function getMob()
    {
        return $this->mob;
    }
    
    public function removeMob()
    {
        $mob = $this->mob;
        $this->mob = null;
        
        return $mob;
    }
    
    public function hasMob()
    {
        return $this->mob instanceof Mob;
    }
} 