<?php

namespace Warrior\Core;

interface WorldSensor extends MobDescription
{
    public function look($direction = Direction::FORWARD);
}