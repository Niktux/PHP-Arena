<?php

namespace Warrior\Core\Event;

use Symfony\Component\EventDispatcher\Event;

class WorldDescription extends Event
{
    private
        $blocks;
    
    public function __construct(array $blocks)
    {
        $this->blocks = $blocks;
    }    
    
    public function getBlocks()
    {
        return $this->blocks;
    }
}