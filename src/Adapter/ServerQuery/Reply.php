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

	use mskarbek48\TeamspeakFramework\Exception\TeamSpeakException;
	use mskarbek48\TeamspeakFramework\Exception\TeamSpeakPermissionException;
	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use mskarbek48\TeamspeakFramework\Utils\StringHelper;

	class Reply
	{

		private string $reply;

		private bool $throw;

		private int $errorId = 0;

		private string $errorMessage = "";

		private int $failed_perm_id = 0;

		/*
		 * @param string $reply - Reply from server query transport
		 * @return Reply - Instance of Reply
		 */
		public static function factory(array $reply, bool $throw = true): Reply
		{
			return new Reply($reply, $throw);
		}

		private function __construct(array $reply, bool $throw)
		{
			$this->throw = $throw;
			$this->parseReply($reply);
			$this->parseError(array_pop($reply));
		}

		public function parseReply(array $reply): void
		{
			unset($reply[array_key_last($reply)]);
			$this->reply = implode("", $reply);
		}

		public function parseError(string $results): void
		{
			$data = StringHelper::factory(str_replace("error", "", $results))->toArray();
			if($data['id'] != 0 && $this->throw && $data['id'] != 1281)
			{
				if(!isset($data['failed_permid']))
				{
					throw new TeamSpeakException($data['msg'], $data['id']);
				} else {
					throw new TeamSpeakPermissionException($data['msg'] . ", failed on permission id: " .  $this->failed_perm_id, $data['id'],  $this->failed_perm_id);
				}

			}
			$this->errorId = $data['id'];
			$this->errorMessage = $data['msg'];
			if(isset($data['failed_permid']))
			{
				$this->failed_perm_id = $data['failed_permid'];
			}
		}

		/*
		 * @return array - Data from reply as array
		 */
		public function toArray(): array
		{
			return StringHelper::factory($this->reply)->toArray();
		}

		/*
		 * @return array - Data from reply as associative array
		 */
		public function toAssocArray(): array
		{
			$array = [];
			$elements = StringHelper::factory($this->reply)->explode("|");
			foreach($elements as $value)
			{
				$array[] = StringHelper::factory($value)->toArray();
			}

			return $array;
		}

		public function success(): bool
		{
			return $this->errorId == 0;
		}

		/*
		 * @return string - Error message
		 */
		public function getErrorMessage(): string
		{
			return $this->errorMessage;
		}

		/*
		 * @return int - Error id
		 */
		public function getErrorId(): int
		{
			return $this->errorId;
		}

	}