<?php

namespace Warrior\Core\Mobs;

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
    
    public function isAlive()
    {
        return $this->mob->isAlive();
    }
}