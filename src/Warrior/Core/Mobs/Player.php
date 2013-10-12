<?php

namespace Warrior\Core\Mobs;

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
        
        $this->attackStrength = 5;
        $this->shootStrength = 2;
    }
    
    public function getName()
    {
        return $this->name;
    }
}
