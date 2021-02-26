<?php
use Cake\Event\Event;
use Cake\Event\EventManager;

EventManager::instance()->on('Bake.initialize', function(Event $event) {
	$view	=	$event->getSubject();
	$view->loadHelper('CleanerBake.CleanerBake');
});