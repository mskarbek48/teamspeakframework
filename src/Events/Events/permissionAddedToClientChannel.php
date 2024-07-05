<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 4:32 PM
	 * @updated at 7/3/24 4:32 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Adapter\Abstract\AbstractPermissionClientChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEvent;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventClient;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventPermission;
	
	class permissionAddedToClientChannel extends AbstractPermissionClientChannel implements iEvent, iEventChannel, iEventClient, iEventPermission
	{
		
	}