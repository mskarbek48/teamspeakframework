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

		private array $events = [];

		/*
		 * @var callable[] - array of observers
		 */
		private array $observers = [];

		private function __construct() { }

		/**
		 * @return NotifyEvent
		 */
		public static function getInstance(): NotifyEvent
		{
			if(!self::$instance)
			{
				self::$instance = new NotifyEvent();
			}
			return self::$instance;
		}

		/**
		 * @param callable $callback
		 */
		public function subscribe(callable $observer)
		{
			$this->observers[] = $observer;
		}

		/**
		 * @param array $event
		 */
		public function notify($event)
		{
			foreach($this->observers as $observer)
			{
				$observer($event);
			}
		}

		/**
		 * @param string $event_raw - raw event string from TeamSpeak
		 */
		public function onEvent(string $event_raw)
		{
			$event = new StringHelper($event_raw);
			$array = $event->toArray();
			$this->notify($array);
		}
	}