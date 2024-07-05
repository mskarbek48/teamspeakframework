<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 8:46 AM
	 * @updated at 7/4/24 8:46 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter\Events;
	
	use mskarbek48\TeamspeakFramework\Adapter\Abstract\AbstractGroupCopied;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEvent;
	use mskarbek48\TeamspeakFramework\Adapter\Interface\iEventGroup;
	
	class channelGroupCopied extends AbstractGroupCopied implements iEvent, iEventGroup
	{
		
	}