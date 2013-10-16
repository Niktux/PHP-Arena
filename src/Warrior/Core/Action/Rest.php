<?php

namespace Warrior\Core\Action;

use Warrior\Core\Action;
use Warrior\Core\World;
use Warrior\Core\Mob;
use Warrior\Core\Direction;

final class Rest implements Action
{
    public function execute(Mob $mob, World $world)
    {
        $mob->rest();
    }
}
