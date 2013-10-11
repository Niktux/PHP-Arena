<?php

namespace Warrior\Core;

interface Action
{
    public function execute(Mob $mob, World $world);
}