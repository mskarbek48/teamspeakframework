<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 12:03 PM
	 *
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Entity\Channel;
	use mskarbek48\TeamspeakFramework\Entity\Client;
	
	class channelCreated use AbstractNotifyEvent
	{
		private Client $invoker;
		private Channel $channel;

		public function __construct(
			private Ts3admin $teamSpeak,
			private array $event_array
		){
			
		}
	}