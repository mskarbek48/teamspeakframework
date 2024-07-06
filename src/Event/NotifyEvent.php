<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 16:19
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Event;

	use mskarbek48\TeamspeakFramework\Utils\StringHelper;

	class NotifyEvent
	{
		private static $instance;

		private $events = [];

		private $observers = [];

		private function __construct() { }

		public static function getInstance(): NotifyEvent
		{
			if(!self::$instance)
			{
				self::$instance = new NotifyEvent();
			}
			return self::$instance;
		}

		public function subscribe(callable $observer)
		{
			$this->observers[] = $observer;
		}

		public function notify($event)
		{
			foreach($this->observers as $observer)
			{
				$observer($event);
			}
		}

		public function onEvent(string $event_raw)
		{
			$event = new StringHelper($event_raw);
			$array = $event->toArray();
			$this->notify($array);
		}
	}