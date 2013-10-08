<?php

namespace Warrior\Core;

interface EndConditionChecker
{
    public function check(Game $g);
}