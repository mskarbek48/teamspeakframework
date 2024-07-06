<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 11:58
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery;

	class TeamSpeak
	{
		const TEAMSPEAK_PROTOCOL_IDENTIFIER = "TS3";

		const TEAMSPEAK_WELCOME_MESSAGE = "Welcome to the TeamSpeak 3 ServerQuery interface, type \"help\" for a list of commands and \"help <command>\" for information on a specific command.";

		const TEAMSPEAK_ESCAPE_PATTERNS = [
			"\t" => '\t',
			"\v" => '\v',
			"\r" => '\r',
			"\n" => '\n',
			"\f" => '\f',
			' ' => '\s',
			'|' => '\p',
			'/' => '\/'
		];

		const TEAMSPEAK_UNESCAPE_PATTERNS = [
			"\t" => '',
			"\v" => '',
			"\r" => '',
			"\n" => '',
			"\f" => '',
			"\s" => ' ',
			"\p" => '|',
			"\/" => '/'
		];

		const TEAMSPEAK_EVENT_PREFIX = "notify";

		const TEAMSPEAK_ERROR_PREFIX = "error id=";

		const TEAMSPEAK_KICK_SERVER = 5;

		const TEAMSPEAK_KICK_CHANNEL = 4;

		private string $host;

		private int $port;

		public static function factory(): TeamSpeak
		{
			return new TeamSpeak();
		}

		public function setHost(string $host): TeamSpeak
		{
			$this->host = $host;
			return $this;
		}

		public function setPort(int $port): TeamSpeak
		{
			$this->port = $port;
			return $this;
		}

		public function getHost(): string
		{
			return $this->host;
		}

		public function getPort(): int
		{
			return $this->port;
		}

		public function connect(): ServerQuery
		{
			return new ServerQuery($this);
		}
	}