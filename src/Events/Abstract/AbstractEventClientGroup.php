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
	
	abstract class AbstractEventClientGroup
	{
		public function __construct(
			protected int $client_id,
			protected string $client_nickname,
			protected int $group_id,
			protected string $group_name,
			protected int $invoker_id,
			protected string $invoker_name
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
	}