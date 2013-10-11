<?php

namespace Warrior\Core\Renderer\Line;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Warrior\Core\Event\WorldDescription;
use Warrior\Core\Mob;
use Warrior\Core\Event\MobMovement;
use Warrior\Core\Direction;
use Warrior\Core\Player;
use Warrior\Core\Block\Wall;
use Warrior\Bots\Goblin;

class Cli implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'world.init' => array('onWorldChange', 0),
            'world.changed' => array('onWorldChange', 0),
            'mob.moved' => array('onMobMove', 0),
        );
    }
    
    public function onWorldChange(WorldDescription $event)
    {
        foreach($event->getBlocks() as $block)
        {
            if($block->hasMob() === true)
            {
                $mob = $block->getMob();
                
                if($mob instanceof Player)
                {
                    echo 'P';
                }
                elseif($mob instanceof Mob)
                {
                    if($mob instanceof Goblin)
                    {
                        echo 'G';
                    }
                    else
                    {
                        echo 'M';
                    }
                }
            }
            elseif($block instanceof Wall)
            {
                echo '|';
            }
            else
            {
                echo '_';
            }
        }
        
        $this->lf();
    }
    
    public function onMobMove(MobMovement $event)
    {
     //   echo "Mob has moved " . ($event->getDirection() === Direction::BACKWARD ? "backward" : "forward");
     // $this->lf();
    }
    
    private function lf()
    {
        echo PHP_SAPI === 'cli' ? "\n" : "<br/>";
    }
}
