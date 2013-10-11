<?php

namespace Warrior\Core;

interface WorldSensor extends MobDescription
{
    // FIXME will return BlockDescription instead of Block (wrapper)
    public function look($direction = Direction::FORWARD);
}