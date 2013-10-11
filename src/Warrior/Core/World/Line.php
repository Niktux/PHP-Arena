<?php

namespace Warrior\Core\World;

use Warrior\Core\World;
use Warrior\Core\Mob;
use Warrior\Core\Exceptions\InvalidBlockId;
use Warrior\Core\Direction;
use Symfony\Component\EventDispatcher\EventDispatcher;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Warrior\Core\Event\WorldDescription;
use Warrior\Core\Event\MobMovement;
use Warrior\Core\Action;
use Warrior\Core\Block\Air;
use Warrior\Core\Block\Wall;
use Warrior\Core\Block;

class Line implements World
{
    const 
        DEFAULT_SIZE = 10;
    
    private
        $dispatcher,
        $blocks,
        $mobs;
    
    public function __construct($size = self::DEFAULT_SIZE)
    {
        $this->dispatcher = new EventDispatcher();
        $this->initializeBlocks($size);
        $this->mobs = array();
    }
    
    private function initializeBlocks($size)
    {
        $this->blocks = new \SplFixedArray($size);
        
        $lastId = $size - 1;
        for($i = 1; $i < $lastId; $i++)
        {
            $this->blocks[$i] = new Air();
        }
        
        $this->blocks[0] = new Wall();
        $this->blocks[$lastId] = new Wall();
    }
    
    public function addMob(Mob $mob, $blockId)
    {
        $this->mobs[] = $mob;
        $this->setMobAt($mob, $blockId);
        
        return $this;
    }
    
    private function setMobAt($mob, $blockId)
    {
        $this->checkBlockIdValidity($blockId);
        
        $block = $this->blocks[$blockId];
        if($this->isFree($block))
        {
            $block->setMob($mob);
        }
    }
        
    private function checkBlockIdValidity($blockId)
    {
        if(! $this->blockExists($blockId))
        {
            throw new InvalidBlockId($blockId);
        }
    }
    
    private function blockExists($blockId)
    {
        return $this->blocks->offsetExists($blockId);    
    }
        
    private function isFree(Block $block)
    {
        return $block->isReachable() && (! $block->hasMob());
    }
    
    public function getNextBlock(Mob $mob, $direction)
    {
        list($blockId, $block) = $this->searchMob($mob);
        
        $modifier = 1;
        if($direction === Direction::BACKWARD)
        {
            $modifier = -1;
        }
        
        $blockId += $modifier;
        
        return $this->blockExists($blockId) ? $this->blocks[$blockId] : false;
    }
    
    public function getMobBlock(Mob $mob)
    {
        list($blockId, $block) = $this->searchMob($mob);
        
        return $block;
    }
    
    private function searchMob(Mob $mob)
    {
        foreach($this->blocks as $blockId => $block)
        {
            if($block->hasMob() && $block->getMob() === $mob)
            {
                return array($blockId, $block);
            }
        }
        
        throw new \RuntimeException(sprintf("Mob not found (%s)", get_class($mob)));
    }
    
    public function move(Mob $mob, $direction)
    {
        $block = $this->getMobBlock($mob);
        $nextBlock = $this->getNextBlock($mob, $direction);
    
        if($nextBlock instanceof Block)
        {
            if($this->isFree($nextBlock))
            {
                $block->removeMob();
                $nextBlock->setMob($mob);
            }
        }
        
        $this->notifyMobHasMoved($mob, $direction);
        $this->notifyWorldChange();
    }
    
    public function addEventSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->dispatcher->addSubscriber($subscriber);
        
        return $this;
    }
    
    public function startGame()
    {
        $this->notifyWorldChange('world.init');
    }
    
    private function notifyWorldChange($eventName = 'world.changed')
    {
        $this->dispatcher->dispatch($eventName, new WorldDescription($this->blocks->toArray()));
    }
    
    private function notifyMobHasMoved(Mob $mob, $direction)
    {
        $this->dispatcher->dispatch('mob.moved', new MobMovement($mob, $direction));
    }
    
    public function getMobs()
    {
        return new \ArrayIterator($this->mobs);
    }
    
    public function attack(Mob $attacker, $direction)
    {
        $target = $this->getNextBlock($attacker, $direction);
        
        if($target instanceof Block)
        {
            if($target->hasMob())
            {
                $mob = $target->getMob();
                
                // TODO injury attackee (tmp echo code)
                echo "attack\n";
            }
        }
    }
    
    public function getBlock($blockId)
    {
        $this->checkBlockIdValidity($blockId);
        
        return $this->blocks[$blockId];
    }
}