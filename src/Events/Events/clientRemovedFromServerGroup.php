<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 4:30 PM
	 * @updated at 7/3/24 4:30 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Adapter\Abstract\AbstractEventClientGroup;
	use dBot\TeamSpeak\Adapter\Interface\iEvent;
	use dBot\TeamSpeak\Adapter\Interface\iEventClient;
	use dBot\TeamSpeak\Adapter\Interface\iEventGroup;
	
	final class clientRemovedFromServerGroup extends AbstractEventClientGroup implements iEventGroup, iEventClient, iEvent {}