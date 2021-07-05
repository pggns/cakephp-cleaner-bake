<?php
declare(strict_types=1);

namespace Pggns\CleanerBake;

use Cake\Core\BasePlugin;
use Cake\Core\PluginApplicationInterface;
use Cake\Event\Event;

class Plugin extends BasePlugin {
	/**
	 * @param \Cake\Core\PluginApplicationInterface $app PluginApplicationInterface
	 * @return void
	 */
	public function bootstrap(PluginApplicationInterface $app): void {
		$eventManager	=	$app->getEventManager();
		$eventManager->on('Bake.initialize', function(Event $event) {
			$view	=	$event->getSubject();
			$view->loadHelper('Pggns/CleanerBake.CleanBake');
		});
		
		parent::bootstrap($app);
	}
}
