<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 08.07.2024 08:21
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Exception;



	class TeamSpeakPermissionException extends \Exception
	{
		private int $failed_perm_id = 0;

		public function __construct($message = "", $code = 0, int $failed_perm_id = 0)
		{
			$this->failed_perm_id = $failed_perm_id;
			parent::__construct($message, $code);
		}

		public function getFailedPermId(): int
		{
			return $this->failed_perm_id;
		}

	}