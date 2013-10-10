<?php

namespace Warrior\Mobs;

class Player extends Unit implements \Warrior\Core\Player
{
    private
        $name;
    
    public function __construct($name, $health)
    {
        parent::__construct($health);
        
        if(! is_string($name))
        {
            throw new \RuntimeException("Invalid player name");
        }
        
        $this->name = $name;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
