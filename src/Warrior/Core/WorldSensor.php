<?php

namespace Warrior\Core;

interface WorldSensor
{
    public function look($direction = Direction::FORWARD);
}