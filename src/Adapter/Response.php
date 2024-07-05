<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 27.06.2024 16:38
	 * @updated at 27.06.2024 16:38
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Adapter;

    class Response extends AbstractTeamSpeakAdapter
	{

        private bool $success;

        private string $error_message;

        private array $response;

        private int $error_number;

	    /**
	     * @param string $plain
	     * @param bool $force_multi - If true, function will always return response as multi array, even if there is only one element
	     */
	    public function __construct(
			string $plain,
			bool $force_multi = false
		){
            $response_array = [];
            $plain = explode("error ", $plain);
            if(str_contains($plain[0], "|"))
            {
                $matches = explode("|",$plain[0]);
                foreach($matches as $match)
                {
                   $response_array[] = $this->convertToArray($match);
                }
            } elseif(!$force_multi) {
                $response_array = $this->convertToArray($plain[0]);
            } else {
				$response_array[] = $this->convertToArray($plain[0]);
            }
            $status = $this->convertToArray($plain[1]);
            $this->success = $status['id'] == 0;
            $this->error_number = $status['id'];
            $this->error_message = $status['msg'];
			$this->response = $response_array;
        }

        public function response(): array
        {
            return $this->response;
        }

        public function success(): bool
        {
            return $this->success;
        }
        public function errorMessage(): string
        {
            return $this->error_message;
        }

		public function errorNumber(): int
		{
			return $this->error_number;
		}

	}