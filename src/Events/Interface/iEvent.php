<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 4:46 PM
	 * @updated at 7/3/24 4:46 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Interface;
	
	interface iEvent
	{
		public function getInvokerId(): int;
		public function getInvokerName(): string;
	}