<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 05.07.2024 16:31
	 * @updated at 05.07.2024 16:31
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Abstract;
	
	abstract class AbstractPermissionChannel
	{
		public function __construct(
			protected int $permission_id,
			protected string $permission_name,
			protected int $permission_value,
			protected int $channel_id,
			protected string $channel_name,
			protected int $invoker_id,
			protected string $invoker_name,
		){}
		
		public function getPermissionId(): int
		{
			return $this->permission_id;
		}
		
		public function getPermissionName(): string
		{
			return $this->permission_name;
		}
		
		public function getPermissionValue(): int
		{
			return $this->permission_value;
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		public function getChannelName(): string
		{
			return $this->channel_name;
		}
		
		public function getInvokerId(): int
		{
			return $this->invoker_id;
		}
		
		public function getInvokerName(): string
		{
			return $this->invoker_name;
		}
		
	}