<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 11:56 AM
	 *
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Entity\Client;
	use mskarbek48\TeamspeakFramework\Ts3admin;
	
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