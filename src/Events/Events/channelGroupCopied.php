<?php
	/**
	 * This file is a part of Query
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024, dBot.pl
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/4/24 8:46 AM
	 * @updated at 7/4/24 8:46 AM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace dBot\TeamSpeak\Adapter\Events;
	
	use dBot\TeamSpeak\Adapter\Abstract\AbstractGroupCopied;
	use dBot\TeamSpeak\Adapter\Interface\iEvent;
	use dBot\TeamSpeak\Adapter\Interface\iEventGroup;
	
	class channelGroupCopied extends AbstractGroupCopied implements iEvent, iEventGroup
	{
		
	}