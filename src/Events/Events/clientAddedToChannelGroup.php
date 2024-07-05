<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 4:30 PM
	 * @updated at 7/3/24 4:30 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEvent;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventClient;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventGroup;
	
	final class clientAddedToChannelGroup implements iEventGroup, iEventClient, iEvent, iEventChannel {
		
		public function __construct(
			protected int $client_id,
			protected string $client_nickname,
			protected int $group_id,
			protected string $group_name,
			protected int $invoker_id,
			protected string $invoker_name,
			protected int $channel_id,
			protected string $channel_name,
		){}
		
		public function getClientId(): int
		{
			return $this->client_id;
		}
		
		public function getClientNickname(): string
		{
			return $this->client_nickname;
		}
		
		public function getGroupId(): int
		{
			return $this->group_id;
		}
		
		public function getGroupName(): string
		{
			return $this->group_name;
		}
		
		public function getInvokerId(): int
		{
			return $this->invoker_id;
		}
		
		public function getInvokerName(): string
		{
			return $this->invoker_name;
		}
		
		public function getChannelName(): string
		{
			return $this->channel_name;
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		
		
	}