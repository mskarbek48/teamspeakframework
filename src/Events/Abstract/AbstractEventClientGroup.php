<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 9:13 PM
	 * @updated at 7/3/24 9:13 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Abstract;
	
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