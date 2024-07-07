<?php

namespace mskarbek48\TeamspeakFramework\Adapter;

use mskarbek48\TeamspeakFramework\Exception\TransportException;
use mskarbek48\TeamspeakFramework\TeamSpeak;
use mskarbek48\TeamspeakFramework\Transport\Telnet;
use mskarbek48\TeamspeakFramework\Transport\TransportInterface;

abstract class AbstractTeamSpeakAdapter
{
	private TransportInterface $transport;

	/**
	 * @throws TransportException
	 */
	public function __construct(TeamSpeak $teamSpeak)
	{
		$this->transport = new Telnet($teamSpeak->getHost(), $teamSpeak->getPort());
	}

	/**
	 * @return TransportInterface
	 */
	public function getTransport(): TransportInterface
	{
		return $this->transport;
	}
}