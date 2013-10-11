<?php

namespace Warrior\Core\Mobs\Filter;

use Warrior\Core\Player;

class PlayerFilterIterator extends \FilterIterator
{
    public function accept()
    {
         $mob = $this->getInnerIterator()->current();
         
         return $mob instanceof Player;
    }
}