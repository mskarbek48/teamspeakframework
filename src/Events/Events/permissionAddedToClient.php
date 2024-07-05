<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 4:32 PM
	 * @updated at 7/3/24 4:32 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Adapter\Abstract\AbstractPermissionClient;
	use dBot\TeamSpeak\Adapter\Interface\iEvent;
	use dBot\TeamSpeak\Adapter\Interface\iEventClient;
	use dBot\TeamSpeak\Adapter\Interface\iEventPermission;
	
	class permissionAddedToClient extends AbstractPermissionClient implements iEvent, iEventPermission, iEventClient
	{
		
	}