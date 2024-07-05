<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 9:10 AM
	 * @updated at 7/4/24 9:10 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Abstract;
	
	abstract class AbstractBan
	{
		public function __construct(
			private string $reason,
			private string $type,
			private string $value,
			private int $bantime,
			private string $invoker_id,
			private string $invoker_name,
			
		)
		{ }
		
		public function getReason(): string
		{
			return $this->reason;
		}
		
		public function getType(): string
		{
			return $this->type;
		}
		
		public function getValue(): string
		{
			return $this->value;
		}
		
		public function getBantime(): int
		{
			return $this->bantime;
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