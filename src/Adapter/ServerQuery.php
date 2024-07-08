<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 12:08
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Adapter;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\Reply;
	use mskarbek48\TeamspeakFramework\Exception\ServerQueryException;
	use mskarbek48\TeamspeakFramework\Node\Instance;
	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use mskarbek48\TeamspeakFramework\Utils\StringHelper;

	class ServerQuery extends AbstractTeamSpeakAdapter
	{
		private array $events = [];

		private int $lastExecutionTime = 0;

		public function __construct(TeamSpeak $teamSpeak)
		{
			parent::__construct($teamSpeak);
			if(!str_contains($this->getTransport()->readLine(), TeamSpeak::TEAMSPEAK_PROTOCOL_IDENTIFIER))
			{
				throw new ServerQueryException("Invalid protocol identifier");
			}
			if(!str_contains($this->getTransport()->readLine(), TeamSpeak::TEAMSPEAK_WELCOME_MESSAGE))
			{
				throw new ServerQueryException("Invalid welcome message");
			}
		}

		public function getLastExecutedCommandTime(): int
		{
			return $this->lastExecutionTime;
		}

		public function waitForEvents(int $mode = 1): array
		{
			foreach($this->events as $event)
			{
				return StringHelper::factory($event)->toArray();
			}
			return $mode ? StringHelper::factory($this->getTransport()->readLine())->toArray() : array();
		}

		public function isConnected(): bool
		{
			return $this->getTransport()->isConnected();
		}

		public function request(array $preparedCommand, bool $throw = true): Reply
		{
			foreach($preparedCommand as $command_part)
			{
				echo $command_part . PHP_EOL;
				$this->getTransport()->writeLine($command_part);
			}
			$this->lastExecutionTime = time();
			$reply = [];
			do {
				$str = $this->getTransport()->readLine();
				if(str_contains(substr($str,0,7), TeamSpeak::TEAMSPEAK_EVENT_PREFIX))
				{
					$this->events[] = $str;
					continue;
				}
				$reply[] = $str;
			} while(!str_contains($str, TeamSpeak::TEAMSPEAK_ERROR_PREFIX));

			return Reply::factory($reply, $throw);
		}

		public function execute(string $command, array $arguments = [], array $params = [], bool $throw = true): Reply
		{
			return $this->request($this->prepare($command, $arguments, $params), $throw);
		}

		public function prepare(string $command, array $arguments, array $params): array
		{
			$command = strtolower($command);
			foreach($arguments as $key => $value)
			{
				if(strlen($value))
				{
					$key = new StringHelper($key);
					$value = new StringHelper($value);
					$command .= " " . $key->escape() . "=" . $value->escape();
				}
			}
			foreach($params as $param)
			{
				$param = new StringHelper($param);
				$command .= " -" . $param->escape();
			}

			$splitted = str_split($command, 1024);
			$splitted[count($splitted) - 1] .= "\n";
			return $splitted;
		}


		public function getInstance(): Instance
		{
			return new Instance($this);
		}

		public function convertPermissions(array $permissions, bool $without_values = false): string
		{
			$return = [];
			$i = 0;

			foreach($permissions as $key => $value)
			{
				$i++;
				if(!$without_values)
				{
					$return[$i] = "permid=" . $key;
					if(is_string($key))
					{
						$return[$i] = "permsid=" . $key;
					}
					$return[$i] .= " ";

					if(is_array($value))
					{
						if(isset($value[0]))
						{
							$return[$i] .= "permvalue=" . $value[0] . " ";
						}
						if(isset($value[1]))
						{
							$return[$i] .= "permskip=" . $value[2] . " ";
						}
						if(isset($value[2]))
						{
							$return[$i] .= "permnegated=" . $value[1] . " ";
						}
					} else {
						$return[$i] .= "permvalue=" . $value . " ";
					}
				} else {
					$return[$i] = "permid=" . $value;
					if(is_string($value))
					{
						$return[$i] = "permsid=" . $value;
					}
					$return[$i] .= " ";
				}
			}

			return implode("|", $return);
		}

	}