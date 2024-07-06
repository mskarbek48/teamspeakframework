<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 15:17
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace Adapter;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery;
	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use PHPUnit\Framework\TestCase;

	class ServerQueryTest extends TestCase
	{

		public function testPrepare()
		{
			$teamSpeak = TeamSpeak::factory()
				->setHost('localhost')
				->setPort(10011)
				->connect();

			$command_raw = "examplecommand arg1=val1 arg2=val2 -flag1 -flag2\n";
			$prepared = $teamSpeak->prepare("examplecommand", ["arg1" => "val1", "arg2" => "val2"], ["flag1", "flag2"]);
			$this->assertEquals($command_raw, implode(" ", $prepared));


		}
	}
