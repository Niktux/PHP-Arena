<?php

namespace Warrior\Core;

use Warrior\WorldSensor\Tight;
use Warrior\Event\WorldDescription;
use Warrior\Mobs\Filter\PlayerFilterIterator;
use Warrior\Mobs\Filter\BotFilterIterator;

class Game
{
    private
        $world,
        $step,
        $endConditionCheckers;
    
    public function __construct(World $w)
    {
        $this->world = $w;
        $this->step = 0;
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
            while($this->nextStep())
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
    
    private function nextStep()
    {
        $this->step++;
        
        return true;
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
    
    public function getStep()
    {
        return $this->step;
    }
    
    /**
     * @return Warrior\Core\World
     */
    public function getWorld()
    {
        return $this->world;
    }
}
