<?php

namespace Warrior\Core\Mobs\Filter;

use Warrior\Core\Player;
use Warrior\Core\Mob;

class AliveFilterIterator extends \FilterIterator
{
    public function accept()
    {
         $mob = $this->getInnerIterator()->current();
         
         return $mob instanceof Mob  &&  $mob->isAlive();
    }
}
