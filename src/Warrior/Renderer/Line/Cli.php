<?php

namespace Warrior\Renderer\Line;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class Cli implements EventSubscriberInterface
{
    public static function getSubscribedEvents()
    {
        return array(
            'world.init' => array('onWorldInit', 0)    
        );
    }
    
    public function onWorldInit()
    {
        echo "hello world\n";
    }
}
