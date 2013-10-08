<?php

namespace Warrior\Core;

class Game
{
    private
        $step,
        $endConditionCheckers;
    
    public function __construct()
    {
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
        try
        {
            while($this->nextStep())
            {
                $this->checkEndConditions();
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
}