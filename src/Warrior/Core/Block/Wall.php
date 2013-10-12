<?php

namespace Warrior\Core\Block;

use Warrior\Core\Block;

class Wall implements Block
{
    public function isReachable()
    {
        return false;
    }
    
    public function hasMob()
    {
        return false;
    }
    
    public function getMob()
    {
        throw new \RuntimeException('Walls never have mob');
    }
}