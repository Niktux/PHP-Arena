<?php

namespace Warrior\Mobs\Filter;

use Warrior\Core\Player;

class BotFilterIterator extends \FilterIterator
{
    public function accept()
    {
         $mob = $this->getInnerIterator()->current();
         
         return ($mob instanceof Mob) && (! $mob instanceof Player);
    }
}
