<?php

namespace Warrior\Core;

use Warrior\Core\WorldSensor\Tight;
use Warrior\Core\Event\WorldDescription;
use Warrior\Core\Mobs\Filter\PlayerFilterIterator;
use Warrior\Core\Mobs\Filter\BotFilterIterator;

class Game
{
    private
        $world,
        $endConditionCheckers;
    
    public function __construct(World $w)
    {
        $this->world = $w;
        $this->endConditionCheckers = array();
    }
    
    public function addEndConditionChecker(EndConditionChecker $checker)
    {
        $this->endConditionCheckers[] = $checker;
        
        return $this;
    }
    
    public function launch()
    {
        $this->world->startGame();
        $mobs = $this->world->getMobs();
        
        try
        {
            while(true)
            {
                $this->checkEndConditions();
                
                $this->playMobs(new PlayerFilterIterator($mobs));
                $this->playMobs(new BotFilterIterator($mobs));
            }
        }
        catch(Exceptions\GameEndCondition $e)
        {
            echo "End : " . $e->getMessage();
        }
    }
    
    private function checkEndConditions()
    {
        foreach($this->endConditionCheckers as $checker)
        {
            $checker->check($this);
        }
    }
    
    private function playMobs(\Iterator $mobs)
    {
        foreach($mobs as $mob)
        {
            $action = $mob->play(new Tight($this->world, $mob));
        
            if(! $action instanceof Action)
            {
                throw new \RuntimeException('Invalid action');
            }
        
            $action->execute($mob, $this->world);
        }
    }
    
    /**
     * @return Warrior\Core\World
     */
    public function getWorld()
    {
        return $this->world;
    }
}
