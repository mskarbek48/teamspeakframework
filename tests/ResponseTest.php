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

	use \mskarbek48\TeamspeakFramework\Adapter\Response;
	use PHPUnit\Framework\TestCase;

	require_once __DIR__ . '/../src/Adapter/AbstractTeamSpeakAdapter.php';
	require_once __DIR__ . '/../src/Adapter/Response.php';

	class ResponseTest extends TestCase
	{

		public function testResponse()
		{
			$class = new Response("version=3.13.7 build=1655727713 platform=Linux\nerror id=0 msg=ok");
			$array = [
				"version" => "3.13.7",
				"build" => "1655727713",
				"platform" => "Linux"
			];

			$this->assertEquals($array, $class->response());
			$this->assertEquals(0, $class->errorNumber());
			$this->assertEquals("ok", $class->errorMessage());

			$class = new Response("version=3.13.7| build=1655727713 platform=Linux\nerror id=3 msg=invalid");
			$array = [
				[
					"version" => "3.13.7",
				],
				[
					"build" => "1655727713",
					"platform" => "Linux"
				],
			];
			$this->assertEquals($array, $class->response());
			$this->assertEquals(3, $class->errorNumber());
			$this->assertEquals("invalid", $class->errorMessage());

		}
	}
