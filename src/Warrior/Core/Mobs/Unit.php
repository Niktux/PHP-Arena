<?php

namespace Warrior\Core\Mobs;
use Warrior\Core\Mob;
use Warrior\Core\MobStrategy;
use Warrior\Core\WorldSensor;
use Warrior\Core\Action\Wait;

class Unit implements Mob
{
    private 
        $health,
        $strategy;
    
    protected
        $attackStrength,
        $shootStrength;
        
    public function __construct($health)
    {
        if(!is_numeric($health) || $health <= 0)
        {
            throw new \InvalidArgumentException(
                    sprintf('Invalid health (%d)', $health));
        }
        
        $this->health = (int) $health;
        $this->attackStrength = 0;
        $this->shootStrength = 0;
    }
    
    public function getHealth()
    {
        return $this->health;
    }
    
    public function isAlive()
    {
        return $this->health > 0;
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
    
    public function injury($modifier)
    {
        $this->health -= $modifier;
        
        return $this;
    }
    
    public function getAttackStrength()
    {
        return $this->attackStrength;
    }
    
    public function getShootStrength()
    {
        return $this->shootStrength;
    }
}
