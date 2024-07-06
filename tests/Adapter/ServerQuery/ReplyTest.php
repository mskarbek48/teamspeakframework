<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 15:22
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace Adapter\ServerQuery;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\Reply;
	use PHPUnit\Framework\TestCase;

	class ReplyTest extends TestCase
	{

		public function testFactory()
		{
			$reply = Reply::factory("error id=0 msg=ok\n");
			$this->assertEquals($reply->getErrorId(), 0);
			$this->assertEquals($reply->getErrorMessage(), "ok");

			$reply = Reply::factory("error id=256 msg=invalid\\sparameter\n");
			$this->assertEquals($reply->getErrorId(), 256);
			$this->assertEquals($reply->getErrorMessage(), "invalid parameter");
		}
	}
