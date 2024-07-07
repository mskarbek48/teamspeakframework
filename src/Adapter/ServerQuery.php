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
	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\ServerQueryException;
	use mskarbek48\TeamspeakFramework\Event\NotifyEvent;
	use mskarbek48\TeamspeakFramework\Node\Instance;
	use mskarbek48\TeamspeakFramework\TeamSpeak;
	use mskarbek48\TeamspeakFramework\Utils\StringHelper;

	class ServerQuery extends AbstractTeamSpeakAdapter
	{

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

		public function waitForEvents(): void
		{
			NotifyEvent::getInstance()->onEvent($this->getTransport()->readLine());
		}

		public function isConnected(): bool
		{
			return $this->getTransport()->isConnected();
		}

		public function request(array $preparedCommand): Reply
		{
			$events = [];
			foreach($preparedCommand as $command_part)
			{
				$this->getTransport()->writeLine($command_part);
			}
			$this->lastExecutionTime = time();

			$reply = "";
			do {
				$str = $this->getTransport()->readLine();
				if(str_contains(substr($str,0,7), TeamSpeak::TEAMSPEAK_EVENT_PREFIX))
				{
					$events[] = $str;
					continue;
				}
				$reply .= $str;
			} while(!str_contains($str, TeamSpeak::TEAMSPEAK_ERROR_PREFIX));


			foreach($events as $event)
			{
				NotifyEvent::getInstance()->onEvent($event);
			}


			return Reply::factory($reply);

		}

		public function execute(string $command, array $arguments = [], array $params = []): Reply
		{
			return $this->request($this->prepare($command, $arguments, $params));
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

	}