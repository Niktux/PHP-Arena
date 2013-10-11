<?php

namespace Warrior\Core;

interface Block
{
    public function isReachable();
    public function hasMob();
}