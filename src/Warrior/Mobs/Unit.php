<?php

namespace Warrior\Mobs;

use Warrior\Core\Mob;
use Warrior\Core\MobStrategy;
use Warrior\Core\WorldSensor;
use Warrior\Core\Action\Wait;

class Unit implements Mob
{
    private 
        $health,
        $strategy;
    
    public function __construct($health)
    {
        if($health <= 0)
        {
            throw new \InvalidArgumentException(sprintf('Invalid health (%d)', $health));
        }
        
        $this->health = $health;
    }
    
    public function getHealth()
    {
        return $this->health;
    }
    
    public function isDead()
    {
        return $this->health <= 0;
    }
    
    public function setStrategy(MobStrategy $strategy)
    {
        $this->strategy = $strategy;
        
        return $this;
    }
    
    /**
     * @param WorldSensor $sensor
     * @return \Warrior\Core\Action
     */
    public function play(WorldSensor $sensor)
    {
        if($this->strategy instanceof MobStrategy)
        {
            return $this->strategy->play($sensor);
        }
        
        return new Wait();
    }
}

