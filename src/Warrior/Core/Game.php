<?php

namespace Warrior\Core;

use Warrior\WorldSensor\Tight;

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
        $player = $this->world->getPlayer();
        
        if(! $player instanceof Mob)
        {
            throw new \RuntimeException('Invalid player');
        }
        
        try
        {
            while($this->nextStep())
            {
                $this->checkEndConditions();
                
                $player->play(new Tight($this->world));
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
    
    public function getStep()
    {
        return $this->step;
    }
    
    public function getWorld()
    {
        return $this->world;
    }
}
