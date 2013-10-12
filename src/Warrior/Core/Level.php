<?php

namespace Warrior\Core;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

interface Level
{
    public function launch(Player $player); 
    
    public function addEventSubscriber(EventSubscriberInterface $dispatcher);
}