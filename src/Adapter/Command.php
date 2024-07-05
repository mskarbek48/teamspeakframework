<?php
	/**
	 * This file is a part of TeamSpeak
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 05.07.2024 16:31
	 * @updated at 05.07.2024 16:31
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\teamspeakframework\Adapter;

	use mskarbek48\teamspeakframework\Transport\TransportInterface;

	class Command extends AbstractTeamSpeakAdapter
	{
		/**
		 * @param string $command
		 * @param array $arguments key => value eg. ['clid' => 1, 'msg' => 'Hello']
		 * @param array $params array of parameters eg. ['uid', 'groups', 'times']
		 * @param bool $multi If true, function will always return response as multi array, even if there is only one element
		 */
		public function __construct(
			private TransportInterface $transport,
			private string $command,
			private array $arguments,
			private array $params,
			private bool $multi
		) {}

		public function execute()
		{
			$command = $this->command . " ";
			foreach($this->arguments as $key => $value)
			{
				$command .= $this->escapeText($key) . "=" . $this->escapeText($value) . " ";
			}
			foreach($this->params as $param)
			{
				$command .= " -" . $this->escapeText($param);
			}
			$splitted = str_split($command, 1024);
			$splitted[count($splitted) - 1] .= "\n";
			foreach($splitted as $command_part)
			{
				$this->transport->writeLine($command_part);
			}
		}

		public function getResponse(): Response
		{
			$response = "";
			do {
				$line = $this->transport->readLine();
				if(str_starts_with($line, "notify"))
				{
					#TODO: Implement notify events
					continue;
				}
				$response .= $line;
			} while(!str_contains($line, "msg=") || !str_contains($line, "error id="));

			return new Response($response, $this->multi);
		}
	}