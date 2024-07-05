<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 8:53 AM
	 * @updated at 7/4/24 8:53 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Abstract;
	
	class AbstractPermissionClientChannel
	{
		public function __construct(
			protected int $permission_id,
			protected string $permission_name,
			protected int $permission_value,
			protected int $client_id,
			protected int $channel_id,
			protected string $channel_name,
			protected int $invoker_id,
			protected string $invoker_name,
		){}
		public function getPermissionName(): string
		{
			return $this->permission_name;
		}
		
		public function getPermissionValue(): int
		{
			return $this->permission_value;
		}
		
		
		public function getInvokerId(): int
		{
			return $this->invoker_id;
		}
		
		public function getInvokerName(): string
		{
			return $this->invoker_name;
		}
		
		public function getClientId(): int
		{
			return $this->client_id;
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		public function getChannelName(): string
		{
			return $this->channel_name;
		}
		
		public function getPermissionId(): int
		{
			return $this->permission_id;
		}
		
		
	}