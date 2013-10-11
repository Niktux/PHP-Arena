<?php

namespace Warrior\Core;

class BlockInfo implements Block
{
    private
        $block;
    
    public function __construct(Block $block)
    {
        $this->block = $block;
    }
    
    public function isReachable()
    {
        return $this->block->isReachable();
    }
    
    public function hasMob()
    {
        return $this->block->hasMob();
    }
}
