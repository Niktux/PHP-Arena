<?php

namespace Warrior\Core;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface World
{
    public function addMob(Mob $mob, $BlockId);
    
    /**
     * @return \ArrayIterator
     */
    public function getMobs();
    
    public function getNextBlock($blockId, $direction);
    public function getMobBlockId(Mob $mob);
    
    public function move(Mob $mob, $direction);
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber);
    public function startGame();
}