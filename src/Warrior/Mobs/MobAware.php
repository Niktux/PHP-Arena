<?php

namespace Warrior\Mobs;

use Warrior\Core\Mob;
use Warrior\Core\MobDescription;

trait MobAware
{
    private
        $mob;
    
    public function getHealth()
    {
        return $this->mob->getHealth();
    }
    
    public function isDead()
    {
        return $this->mob->isDead();
    }
}