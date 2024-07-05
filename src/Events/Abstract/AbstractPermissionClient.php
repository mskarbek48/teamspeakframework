<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 9:06 AM
	 * @updated at 7/4/24 9:06 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Abstract;
	
	abstract class AbstractPermissionClient
	{
		public function __construct(
			protected int $permission_id,
			protected string $permission_name,
			protected string $permission_value,
			protected int $client_id,
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
		
		public function getClientId(): int
		{
			return $this->client_id;
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
		
	}