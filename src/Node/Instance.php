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
			return $this->getParent()->execute("login", ["client_login_name" => $username, "client_login_password" => $password]);
		}

		public function getServerById(int $id, string $nickname = ""): ?Server
		{
			$select = $this->getParent()->execute("use", ["sid" => $id, "client_nickname" => $nickname]);
			if ($select->getErrorId() != 0) {
				throw new \Exception($select->getErrorMessage());
			}
			return new Server($this->getParent());
		}

		public function getServerByPort(int $port, string $nickname): ?Server
		{
			$select = $this->getParent()->execute("use", ["port" => $port, "client_nickname" => $nickname]);
			if ($select->getErrorId() != 0) {
				throw new \Exception($select->getErrorMessage());
			}
			return new Server($this->getParent());
		}

		public function serverList(): Reply
		{
			return $this->getParent()->execute("serverlist");
		}

		public function gm(string $msg): Reply
		{
			return $this->getParent()->execute("gm", ["msg" => $msg]);
		}

		public function version(): Reply
		{
			return $this->getParent()->execute("version");
		}

		public function hostinfo(): Reply
		{
			return $this->getParent()->execute("hostinfo");
		}

		public function instanceInfo(): Reply
		{
			return $this->getParent()->execute("instanceinfo");
		}

		public function whoAmI(): Reply
		{
			return $this->getParent()->execute("whoami");
		}

		public function logout(): Reply {
			return $this->getParent()->execute("logout");
		}
	}

