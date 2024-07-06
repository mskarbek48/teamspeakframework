<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 12:53
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Adapter\ServerQuery;

	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use mskarbek48\TeamspeakFramework\Utils\StringHelper;

	class Reply
	{

		private StringHelper $reply;

		public static function factory(string $reply): Reply
		{
			return new Reply($reply);
		}

		public function __construct(string $reply)
		{
			$this->reply = new StringHelper($reply);
		}

		public function getError(): array
		{
			return $this->reply->pregMatch('/error id=(\d*) msg=(.*)/');
		}

		private function getData(): string
		{
			return $this->reply->explode("error id=")[0];
		}

		public function toArray(): array
		{
			return StringHelper::factory($this->getData())->toArray();
		}

		public function toAssocArray(): array
		{
			$array = [];
			$elements = StringHelper::factory($this->getData())->explode("|");
			foreach($elements as $value)
			{
				$array[] = StringHelper::factory($value)->toArray();
			}

			return $array;
		}

		public function getErrorMessage(): string
		{
			return StringHelper::factory($this->getError()[2])->unescape();
		}

		public function getErrorId(): int
		{
			return $this->getError()[1];
		}

	}