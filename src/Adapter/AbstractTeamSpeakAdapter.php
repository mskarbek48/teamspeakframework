<?php

namespace mskarbek48\TeamspeakFramework\Adapter;

use mskarbek48\TeamspeakFramework\TeamSpeak;
use mskarbek48\TeamspeakFramework\Transport\Telnet;
use mskarbek48\TeamspeakFramework\Transport\TransportInterface;

abstract class AbstractTeamSpeakAdapter
{
	private TransportInterface $transport;

	public function __construct(TeamSpeak $teamSpeak)
	{
		$this->transport = new Telnet($teamSpeak->getHost(), $teamSpeak->getPort());
	}

	public function getTransport(): TransportInterface
	{
		return $this->transport;
	}
}