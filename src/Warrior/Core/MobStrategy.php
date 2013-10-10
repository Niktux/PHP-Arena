<?php

namespace Warrior\Core;

interface MobStrategy
{
    public function play(WorldSensor $sensor);
}