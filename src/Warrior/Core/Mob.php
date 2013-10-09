<?php

namespace Warrior\Core;

interface Mob
{
    public function setMobAction(MobAction $actions);
    public function play(WorldSensor $sensor);
}

