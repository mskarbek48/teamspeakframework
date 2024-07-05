<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 11:56 AM
	 *
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Entity\Client;
	use dBot\TeamSpeak\Ts3admin;
	
	class clientEnterView
	{
		
		private Client $client;
		
		public function __construct(
			private Ts3admin $ts,
			private array $event_raw
		){
			$this->client = new Client($ts, $event_raw['clid']);
		}
		
	}