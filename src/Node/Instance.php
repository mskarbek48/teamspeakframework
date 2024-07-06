<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 13:48
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Node;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\Reply;

	class Instance extends AbstractNode
	{
		public function login(string $username, string $password): Reply
		{
			return $this->serverQuery->execute("login", ["client_login_name" => $username, "client_login_password" => $password]);
		}


		public function getServerById(int $id, string $nickname = ""): ?Server
		{
			$select = $this->serverQuery->execute("use", ["sid" => $id, "client_nickname" => $nickname]);
			if($select->getErrorId() != 0)
			{
				throw new \Exception($select->getErrorMessage());
			}
			return new Server($this->serverQuery);
		}

		public function getServerByPort(int $port, string $nickname): ?Server
		{
			$select = $this->serverQuery->execute("use", ["port" => $port, "client_nickname" => $nickname]);
			if($select->getErrorId() != 0)
			{
				throw new \Exception($select->getErrorMessage());
			}
			return new Server($this->serverQuery);
		}

	}