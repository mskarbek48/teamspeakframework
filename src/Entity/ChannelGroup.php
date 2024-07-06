<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 05.07.2024 19:03
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Entity;

	use mskarbek48\TeamspeakFramework\Adapter\Response;
	use mskarbek48\TeamspeakFramework\Entity\Abstract\EntityAbstract;
	use mskarbek48\TeamspeakFramework\TeamSpeak;

	class ServerGroup extends EntityAbstract
	{
		public function __construct(
			private TeamSpeak $teamSpeak,
			protected array $data
		) {
			if(array_key_exists('cid', $data)) {
				$this->id = $data['cid'];
			} else {
				throw new \Exception('Group ID not found');
			}
		}
		public function delete(): Response
		{
			return $this->teamSpeak->serverGroupDelete($this->id);
		}

		public function delPerm(array $permissions): Response
		{
			return $this->teamSpeak->serverGroupDelPerm($this->id, $permissions);
		}

		public function addPerm(array $permissions): Response
		{
			return $this->teamSpeak->serverGroupAddPerm($this->id, $permissions);
		}

		public function rename(string $name): Response
		{
			return $this->teamSpeak->serverGroupRename($this->id, $name);
		}

		public function permList($permsid = false): Response
		{
			return $this->teamSpeak->serverGroupPermList($this->id, $permsid);
		}
	}