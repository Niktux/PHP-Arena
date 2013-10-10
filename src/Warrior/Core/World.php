<?php

namespace Warrior\Core;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface World
{
    public function addMob(Mob $mob, $placeId);
    
    public function getPlayer();
    public function setPlayer(Mob $player, $placeId = null);
    
    public function getNextPlaceId($placeId, $direction);
    public function getMobPlaceId(Mob $mob);
    
    public function move(Mob $mob, $direction);
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber);
    public function startGame();
}