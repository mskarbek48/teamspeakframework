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