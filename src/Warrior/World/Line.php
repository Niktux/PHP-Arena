<?php

namespace Warrior\World;

use Warrior\Core\World;
use Warrior\Core\Mob;
use Warrior\Core\Exceptions\InvalidPlaceId;
use Warrior\Core\Direction;
use Warrior\Core\MobAction;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Warrior\Event\WorldDescription;
use Warrior\Event\MobMovement;

class Line implements World
{
    const 
        DEFAULT_SIZE = 10;
    
    private
        $dispatcher,
        $player,
        $places,
        $mobs,
        $startingPoint;
    
    public function __construct($size = self::DEFAULT_SIZE)
    {
        $this->dispatcher = new EventDispatcher();
        $this->initializePlaces($size);
        $this->mobs = array();
        $this->startingPoint = 0;
    }
    
    private function initializePlaces($size)
    {
        $this->places = new \SplFixedArray($size);
        
        for($i = 0; $i < $size; $i++)
        {
            $this->places[$i] = null;
        }
    }
    
    public function setStartingPoint($placeId)
    {
        $this->checkPlaceIdValidity($placeId);
        
        $this->startingPoint = $placeId;
        
        return $this;
    }
    
    public function setPlayer(Mob $player, $placeId = null)
    {
        if($placeId === null)
        {
            $placeId = $this->startingPoint;
        }
        
        $this->player = $player;
        $this->setMobAt($player, $placeId);
        $this->player->setMobAction(new MobAction($this, $this->player));
        
        return $this;
    }
    
    public function addMob(Mob $mob, $placeId)
    {
        $this->mobs = $mob;
        $this->setMobAt($mob, $placeId);
    }
    
    private function setMobAt($mob, $placeId)
    {
        $this->checkPlaceIdValidity($placeId);
        
        if($this->isFree($placeId))
        {
            $this->places[$placeId] = $mob;
        }
    }
        
    private function checkPlaceIdValidity($placeId)
    {
        if(! $this->placeExists($placeId))
        {
            throw new InvalidPlaceId($placeId);
        }
    }
    
    private function placeExists($placeId)
    {
        return $this->places->offsetExists($placeId);    
    }
        
    private function isFree($placeId)
    {
        return $this->places[$placeId] === null;
    }
    
    public function getPlayer()
    {
        return $this->player;    
    }
    
    public function getNextPlaceId($placeId, $direction)
    {
        $modifier = 1;
        if($direction === Direction::BACKWARD)
        {
            $modifier = -1;
        }
        
        $placeId += $modifier;
        
        return $this->placeExists($placeId) ? $placeId : false;
    }
    
    public function getMobPlaceId(Mob $mob)
    {
        foreach($this->places as $placeId => $place)
        {
            if($place === $mob)
            {
                return $placeId;
            }
        }
        
        throw new \RuntimeException(sprintf("Mob not found (%s)", get_class($mob)));
    }
    
    public function move(Mob $mob, $direction)
    {
        $placeId = $this->getMobPlaceId($mob);
        $nextPlaceid = $this->getNextPlaceId($placeId, $direction);
    
        if($nextPlaceid !== false)
        {
            if($this->isFree($nextPlaceid))
            {
                $this->freePlace($placeId);
                $this->setMobAt($mob, $nextPlaceid);
            }
        }
        
        $this->notifyMobHasMoved($mob, $direction);
        $this->notifyWorldChange();
    }
    
    private function freePlace($placeId)
    {
        $this->places[$placeId] = null;
    }
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->addSubscriber($subscriber);
        
        return $this;
    }
    
    public function startGame()
    {
        $this->notifyWorldChange();
    }
    
    private function notifyWorldChange()
    {
        $this->dispatcher->dispatch('world.changed', new WorldDescription($this->places->toArray()));
    }
    
    private function notifyMobHasMoved(Mob $mob, $direction)
    {
        $this->dispatcher->dispatch('mob.moved', new MobMovement($mob, $direction));
    }
}