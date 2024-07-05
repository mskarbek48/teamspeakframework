<?php


	namespace mskarbek48\teamspeakframework\Transport;

	use Exception;

	class TCP implements TransportInterface
	{
		private $socket;

		public function __construct(string $host, int $port, int $timeout = 2)
		{
			$this->socket = fsockopen($host, $port, $errno, $error, $timeout);
			if (!$this->socket) {
				throw new Exception("Can't connect to server: $error ($errno)");
			}
		}

		public function readLine(): string
		{
			$line = fgets($this->socket);
			if ($line === false) {
				throw new Exception("Can't read from socket");
			}
			return $line;
		}

		public function writeLine(string $string): void
		{
			$bytes = fwrite($this->socket, $string);
			if ($bytes === false) {
				throw new Exception("Can't write to socket");
			}
		}

		public function close(): void
		{
			@fclose($this->socket);
		}

		public function isConnected(): bool
		{
			return !feof($this->socket);
		}
	}