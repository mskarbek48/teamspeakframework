<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 11:54 AM
	 *
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Adapter\Interface\iEventClient;
	use dBot\TeamSpeak\Entity\Client;
	use dBot\TeamSpeak\Ts3admin;
	
	class clientLeftView implements iEventClient
	{
		const REASON_DISCONNECT = 0x08;
		
		const REASON_DISCONNECT_SHUTDOWN = 0x0B;
		
		const REASON_SERVER_KICK = 0x05;
		
		const REASON_SERVER_BAN = 0x06;
		
		const REASON_TIMEOUT = 0x03;
		
		private Client $invoker;
		
		public function __construct(
			private Ts3admin $ts3admin,
			private array $event_raw
		){
			if(isset($this->event_raw['invokerid']))
			{
				$this->invoker = new Client($this->ts3admin, $this->event_raw['invokerid']);
			}
			
		}
		
		public function isBanned(): bool {
			return $this->reasonid === self::REASON_SERVER_BAN;
		}
		
		public function isKicked(): bool {
			return $this->reasonid === self::REASON_SERVER_KICK;
		}
		
		public function isDisconnected(): bool {
			return $this->reasonid === self::REASON_DISCONNECT;
		}
		
		public function isTimeout(): bool {
			return $this->reasonid === self::REASON_TIMEOUT;
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		public function getReasonId(): int
		{
			return $this->reasonid;
		}
		
		public function getReasonMsg(): string
		{
			return $this->reasonmsg;
		}
		
		public function getClientId(): int
		{
			return $this->clid;
		}
		
		public function getBanTime(): int
		{
			return $this->ban_time;
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
		
	}