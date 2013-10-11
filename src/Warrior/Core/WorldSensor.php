<?php

namespace Warrior\Core;

interface WorldSensor extends MobDescription
{
    /**
     * @return BlockInfo
     */
    public function look($direction = Direction::FORWARD);
}