<?php

namespace Warrior\Bots;

use Warrior\Core\Mobs\Unit;
use Warrior\Core\Mobs\Strategy\WaitAndAttack;

class Goblin extends Unit
{
    public function __construct()
    {
        parent::__construct(10);
        
        $this->setStrategy(new WaitAndAttack());
    }
}