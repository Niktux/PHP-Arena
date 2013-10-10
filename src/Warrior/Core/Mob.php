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
}

