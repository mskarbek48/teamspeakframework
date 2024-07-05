<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 8:45 AM
	 * @updated at 7/4/24 8:45 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Abstract;
	
	abstract class AbstractGroupCopied
	{
		public function __construct(
			protected int $group_id,
			protected string $group_name,
			protected int $group_id_from,
			protected string $group_name_from,
			protected int $invoker_id,
			protected string $invoker_name,
		){}
		
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
		
		public function getGroupIdFrom(): int
		{
			return $this->group_id_from;
		}
		
		public function getGroupNameFrom(): string
		{
			return $this->group_name_from;
		}
		

	}