<?php
	/**
	 * This file is a part of TeamSpeak
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 05.07.2024 16:34
	 * @updated at 05.07.2024 16:34
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\teamspeakframework\Transport;

	interface TransportInterface
	{
		public function readLine(): string;

		public function writeLine(string $string): void;

		public function close(): void;

		public function isConnected(): bool;

	}