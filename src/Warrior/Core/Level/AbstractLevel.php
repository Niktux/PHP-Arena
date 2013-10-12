<?php

namespace Warrior\Core\Level;

use Warrior\Core\Level;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

abstract class AbstractLevel implements Level
{
    protected 
        $subscribers;
    
    public function __construct()
    {
        $this->subscribers = array();
    }

    public function addEventSubscriber(EventSubscriberInterface $subscriber)
    {
        $this->subscribers[] = $subscriber;
        
        return $this;
    }
}