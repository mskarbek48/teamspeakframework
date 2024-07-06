<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 05.07.2024 19:59
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Events\Abstract;

	abstract class AbstractNotifyEvent
	{
		public function __construct(
			private Ts3admin $teamSpeak,
			private array $event_array
		){ }
	}