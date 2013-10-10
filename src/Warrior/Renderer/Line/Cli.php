<?php

namespace Warrior\Renderer\Line;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Warrior\Event\WorldDescription;
use Warrior\Core\Mob;
use Warrior\Event\MobMovement;
use Warrior\Core\Direction;

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
        foreach($event->getPlaces() as $place)
        {
            if($place instanceof Mob)
            {
                echo "M";
            }
            else
            {
                echo "-";
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
