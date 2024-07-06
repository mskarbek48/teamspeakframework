<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 15:10
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery;
	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use PHPUnit\Framework\TestCase;

	class TeamSpeakTest extends TestCase
	{

		public function testSetHost()
		{
			$teamSpeak = new TeamSpeak();
			$teamSpeak->setHost("example.com");
			$this->assertEquals("example.com", $teamSpeak->getHost());
		}

		public function testSetPort()
		{
			$teamSpeak = new TeamSpeak();
			$teamSpeak->setPort(10011);
			$this->assertEquals(10011, $teamSpeak->getPort());
		}

		public function testFactory()
		{
			$teamSpeak = TeamSpeak::factory();
			$this->assertInstanceOf(TeamSpeak::class, $teamSpeak);
		}

		public function testConnect()
		{
			$teamSpeak = new TeamSpeak();
			$query = $teamSpeak
				->setHost("localhost")
				->setPort(10011)
				->connect();
			$this->assertInstanceOf(ServerQuery::class, $query);
			$instance = $query->getInstance();
			$this->assertInstanceOf(\mskarbek48\TeamspeakFramework\Node\Instance::class, $instance);
			$server = $instance->getServerById(1);
			$this->assertInstanceOf(\mskarbek48\TeamspeakFramework\Node\Server::class, $server);
		}

	}
