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
    
    public function getBlock($blockId);
    public function getMobBlock(Mob $mob);
    public function getNextBlock(Mob $mob, $direction);
        
    public function move(Mob $mob, $direction);
    public function attack(Mob $attacker, $direction);
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber);
    public function startGame();
}