<?php

namespace Warrior\Core;

interface Mob extends MobDescription
{
    public function setStrategy(MobStrategy $strategy);

    /**
     * @param WorldSensor $sensor
     * @return \Warrior\Core\Action
     */
    public function play(WorldSensor $sensor);
    
    public function injury($modifier);
    
    public function getAttackStrength();
    public function getShootStrength();
    
    public function rest();
}

