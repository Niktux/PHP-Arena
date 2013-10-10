<?php

namespace Warrior\Core;

use Warrior\WorldSensor\Tight;
use Warrior\Event\WorldDescription;
use Warrior\Mobs\Filter\PlayerFilterIterator;

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
                
                $players = new PlayerFilterIterator($mobs);
                foreach($players as $player)
                {
                    $action = $player->play(new Tight($this->world, $player));
                    
                    if(! $action instanceof Action)
                    {
                        throw new \RuntimeException('Invalid action');
                    }
                    
                    $action->execute($player, $this->world);
                }
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
    
    /**
     * @return Warrior\Core\World
     */
    public function getWorld()
    {
        return $this->world;
    }
}
