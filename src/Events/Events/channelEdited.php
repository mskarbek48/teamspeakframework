<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 12:00 PM
	 *
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Entity\Channel;
	use dBot\TeamSpeak\Entity\Client;
	use dBot\TeamSpeak\Ts3admin;
	
	class channelEdited
	{
		private Client $invoker;
		private Channel $channel;
		public function __construct(
			private Ts3admin $ts,
			private array $event_array,
		)
		{
			$this->invoker = new Client($ts,$event_array['invokerid']);
			$this->channel = new Channel($ts,$event_array['cid']);
		}
	}