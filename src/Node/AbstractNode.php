<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 13:49
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Node;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery;
	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\Reply;

	class AbstractNode
	{

		public function __construct(
			protected ServerQuery $serverQuery
		){}

		public function version(): Reply
		{
			return $this->serverQuery->execute("version");
		}

		public function hostinfo(): Reply
		{
			return $this->serverQuery->execute("hostinfo");
		}

		public function instanceInfo(): Reply
		{
			return $this->serverQuery->execute("instanceinfo");
		}

		public function whoAmI(): Reply
		{
			return $this->serverQuery->execute("whoami");
		}

		public function gm(string $msg): Reply
		{
			return $this->serverQuery->execute("gm", ["msg" => $msg]);
		}

		public function serverList(): Reply
		{
			return $this->serverQuery->execute("serverlist");
		}
	}