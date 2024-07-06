<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 12:43
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Utils;

	use mskarbek48\TeamspeakFramework\TeamSpeak;

	class StringHelper
	{
		public function __construct(
			private string $string
		){}

		public static function factory(string $string): StringHelper
		{
			return new StringHelper($string);
		}

		public function escape(): string
		{
			return str_replace(array_keys(TeamSpeak::TEAMSPEAK_ESCAPE_PATTERNS), TeamSpeak::TEAMSPEAK_ESCAPE_PATTERNS, $this->string);
		}

		public function unescape(): string
		{
			return str_replace(array_keys(TeamSpeak::TEAMSPEAK_UNESCAPE_PATTERNS), TeamSpeak::TEAMSPEAK_UNESCAPE_PATTERNS, $this->string);
		}

		public function explode(string $delimiter, int $limit = PHP_INT_MAX): array
		{
			return explode($delimiter, $this->string, $limit);
		}

		public function pregMatch(string $pattern): array
		{
			preg_match($pattern, $this->string, $matches);
			return $matches;
		}

		public function toArray(): array
		{
			$array = [];
			$data = self::factory($this->string)->explode(" ");
			foreach($data as $key_value)
			{
				$key_value = self::factory($key_value)->explode("=", 2);
				$key = null;
				$value = null;
				if(isset($key_value[0]))
				{
					$key = self::factory($key_value[0])->unescape();
				}
				if(isset($key_value[1]))
				{
					$value = self::factory($key_value[1])->unescape();
				}
				if($key == null && $value == null)
				{
					continue;
				}
				$array[$key] = $value;
			}
			return $array;
		}
	}