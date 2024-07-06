<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 11:48 AM
	 *
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventClient;
	use mskarbek48\TeamspeakFramework\Entity\Client;
	use mskarbek48\TeamspeakFramework\Ts3admin;
	
	class clientMoved implements iEventClient
	{
		const REASON_CHANNEL_KICK = 0x04;
		
		const REASON_MOVE = 0x01;
		
		private int $clid;
		private int $channel_id;
		private int $reasonid;
		
		private Client $invoker;
		
		private Client $client;
		private string $reasonmsg = '';
		
		public function __construct(Ts3admin $ts, array $event_raw)
		{
			$this->clid = (int) $event_raw['clid'];
			$this->channel_id = (int) $event_raw['ctid'];
			$this->reasonid = (int) $event_raw['reasonid'];
			$this->client = $ts->getClientByClid($this->clid);
			if(isset($event_raw['invokerid']))
			{
				$this->invoker = $ts->getClientByClid($event_raw['invokerid']);
			}
		}
		
		public function getClientId(): int
		{
			return $this->clid;
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		public function isKicked(): bool
		{
			return $this->reasonid === self::REASON_CHANNEL_KICK;
		}
		
		public function isInvoker(): bool
		{
			return $this->invokerid > 0;
		}
		
		public function getReasonId(): int
		{
			return $this->reasonid;
		}
		
		public function getInvokerId(): int
		{
			return $this->invokerid;
		}
		
		public function getInvokerName(): string
		{
			return $this->invokername;
		}
		
		public function getInvokerUid(): string
		{
			return $this->invokeruid;
		}
		
		public function getReasonMsg(): string
		{
			return $this->reasonmsg;
		}
	}