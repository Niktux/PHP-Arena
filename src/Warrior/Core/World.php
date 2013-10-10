<?php

namespace Warrior\Core;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface World
{
    public function addMob(Mob $mob, $placeId);
    
    /**
     * @return \ArrayIterator
     */
    public function getMobs();
    
    public function getNextPlaceId($placeId, $direction);
    public function getMobPlaceId(Mob $mob);
    
    public function move(Mob $mob, $direction);
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber);
    public function startGame();
}