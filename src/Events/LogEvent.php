<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created at 7/3/24 3:24 PM
	 * @updated at 7/3/24 3:24 PM
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter;
	
	use mskarbek48\TeamspeakFramework\Adapter\Events\banAdded;
	use mskarbek48\TeamspeakFramework\Adapter\Events\banDeleted;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelGroupCopied;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelGroupCreated;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelGroupDeleted;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelGroupRenamed;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientAddedToChannelGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientAddedToServerGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientRemovedFromServerGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionAddedToChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionAddedToChannelGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionAddedToClient;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionAddedToClientChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionAddedToServerGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionRemovedFromChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionRemovedFromChannelGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionRemovedFromClient;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionRemovedFromClientChannel;
	use mskarbek48\TeamspeakFramework\Adapter\Events\permissionRemovedFromServerGroup;
	use mskarbek48\TeamspeakFramework\Adapter\Events\serverGroupCopied;
	use mskarbek48\TeamspeakFramework\Adapter\Events\serverGroupCreated;
	use mskarbek48\TeamspeakFramework\Adapter\Events\serverGroupDeleted;
	use mskarbek48\TeamspeakFramework\Adapter\Events\serverGroupRenamed;
	use mskarbek48\TeamspeakFramework\Ts3admin;
	
	class LogEvent
	{
		const CLIENT_REMOVED_FROM_SERVERGROUP = "client '(.*)'\(id:(\d*)\) was removed from servergroup '(.*)'\(id:(\d*)\) by client '(.*)'\(id:(\d*)\)";
		const CLIENT_ADDED_TO_SERVERGROUP = "client '(.*)'\(id:(\d*)\) was added to servergroup '(.*)'\(id:(\d*)\) by client '(.*)'\(id:(\d*)\)";
		const CLIENT_ADDED_TO_CHANNELGROUP = "client '(.*)'\(id:(\d*)\) was added to channelgroup '(.*)'\(id:(\d*)\) by client '(.*)'\(id:(\d*)\) in channel '(.*)'\(id:(\d*)\)";
		const PERMISSION_ADDED_TO_SERVERGROUP = "permission '(.*)'\(id:(\d*)\) with values \(value:(\d*), negated:(\d*), skipchannel:(\d*)\) was added by '(.*)'\(id:(\d*)\) to servergroup '(.*)'\(id:(\d*)\)";
		const PERMISSION_REMOVED_FROM_SERVERGROUP ="permission '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\) from servergroup '(.*)'\(id:(\d*)\)";
		const PERMISSION_ADDED_TO_CHANNELGROUP = "permission '(.*)'\(id:(\d*)\) with values \(value:(\d*)\) was added by '(.*)'\(id:(\d*)\) to channelgroup '(.*)'\(id:(\d*)\)";
		const PERMISSION_REMOVED_FROM_CHANNELGROUP = "permission '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\) from channelgroup '(.*)'\(id:(\d*)\)";
		const PERMISSION_ADDED_TO_CHANNEL = "permission '(.*)'\(id:(\d*)\) with values \(value:(\d*)\) was added by '(.*)'\(id:(\d*)\) to channel '(.*)'\(id:(\d*)\)";
		const PERMISSION_REMOVED_FROM_CHANNEL = "permission '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\) from channel '(.*)'\(id:(\d*)\)";
		const PERMISSION_ADDED_TO_CLIENT = "permission '(.*)'\(id:(\d*)\) with values \(value:(\d*)\) was added by '(.*)'\(id:(\d*)\) to client \(id:(\d*)\)";
		const PERMISSION_REMOVED_FROM_CLIENT = "permission '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\) from client \(id:(\d*)\)";
		const PERMISSION_ADDED_TO_CLIENT_CHANNEL = "permission '(.*)'\(id:(\d*)\) with values \(value:(\d*)\) was added by '(.*)'\(id:(\d*)\) for client \(id:(\d*)\) and channel '(.*)'\(id:(\d*)\)";
		const PERMISSION_REMOVED_FROM_CLIENT_CHANNEL = "permission '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\) for client \(id:(\d*)\) and channel '(.*)'\(id:(\d*)\)";
		const SERVERGROUP_COPIED = "servergroup '(.*)'\(id:(\d*)\) was copied by '(.*)'\(id:(\d*)\) to '(.*)'\(id:(\d*)\)";
		CONST SERVERGROUP_DELETED = "servergroup '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\)";
		const SERVERGROUP_RENAMED = "servergroup '(.*)'\(id:(\d*)\) was renamed to '(.*)' by '(.*)'\(id:(\d*)\)";
		const SERVERGROUP_CREATED = "servergroup '(.*)'\(id:(\d*)\) was added by '(.*)'\(id:(\d*)\)";
		const CHANNELGROUP_COPIED = "Channelgroup '(.*)'\(id:(\d*)\) was copied by '(.*)'\(id:(\d*)\) to '(.*)'\(id:(\d*)\)";
		const CHANNELGROUP_DELETED = "channelgroup '(.*)'\(id:(\d*)\) was deleted by '(.*)'\(id:(\d*)\)";
		const CHANNELGROUP_RENAMED = "channelgroup '(.*)'\(id:(\d)\) was renamed to '(.*)' by '(.*)'\(id:(\d)\)";
		const CHANNELGROUP_CREATED = "channelgroup '(.*)'\(id:(\d*)\) was added by '(.*)'\(id:(\d*)\)";
		const BAN_ADDED = "ban added reason='(.*)' (.*)='(.*)' bantime=(\d*) by client '(.*)'\(id:(\d*)\)";
		const BAN_EXPIRED = "ban deleted \(expired\) reason='(.*)' (.*)='(.*)' bantime=(\d*) by client '(.*)'\(id:(\d*)\)";
		
		const BAN_DELETED = "ban deleted reason='(.*)' (.*)='(.*)' bantime=(\d*) by client '(.*)'\(id:(\d*)\)";
		
		
		private string $last_log;
		public function __construct(
			private Ts3admin $ts3admin,
		){}
		
		
		private function getLastLogs()
		{
			$logs = [];
			if(!isset($this->lastLog))
			{
				$l = Ts3admin::getInstance()->logView(1);
				if(isset($l->response()[0]['l']))
				{
					$this->lastLog = $l->response()[0]['l'];
				} else {
					throw new \Exception("Cannot fetch last log 1");
				}
				return array();
			} else {
				$l = Ts3admin::getInstance()->logView(100)->response();
				$success = false;
				foreach ($l as $log) {
					if ($log['l'] == $this->lastLog) {
						$success = true;
						continue;
					}
					if ($success) {
						$logs[] = $log['l'];
					}
				}
				if (!$success) {
					throw new \Exception("Cannot fetch last log 2");
				}
				$this->lastLog = $l[count($l) - 1]['l'];
			}
			return $logs;
		}
		
		public function getEvent(string $log)
		{
			$matches = [];
			foreach ([
				 self::CLIENT_REMOVED_FROM_SERVERGROUP, #!
		         self::CLIENT_ADDED_TO_SERVERGROUP, #!
		         self::CLIENT_ADDED_TO_CHANNELGROUP, #!
		         self::PERMISSION_ADDED_TO_SERVERGROUP,
		         self::PERMISSION_REMOVED_FROM_SERVERGROUP,
		         self::PERMISSION_ADDED_TO_CHANNELGROUP,
		         self::PERMISSION_REMOVED_FROM_CHANNELGROUP,
		         self::PERMISSION_ADDED_TO_CHANNEL, #!
		         self::PERMISSION_REMOVED_FROM_CHANNEL, #!
		         self::PERMISSION_ADDED_TO_CLIENT,
		         self::PERMISSION_REMOVED_FROM_CLIENT,
		         self::PERMISSION_ADDED_TO_CLIENT_CHANNEL,
		         self::PERMISSION_REMOVED_FROM_CLIENT_CHANNEL,
		         self::SERVERGROUP_COPIED,
		         self::SERVERGROUP_DELETED,
		         self::SERVERGROUP_RENAMED,
		         self::SERVERGROUP_CREATED,
		         self::CHANNELGROUP_COPIED,
		         self::CHANNELGROUP_DELETED,
		         self::CHANNELGROUP_RENAMED,
		         self::CHANNELGROUP_CREATED,
		         self::BAN_ADDED,
		         self::BAN_EXPIRED,
			         ] as $pattern) {
				preg_match_all("/" . $pattern . "/", $log, $matches);
				if (isset($matches[0][0])) {
					return $this->createEventObject($matches, $pattern);
					break;
				}
			}
		}
		
		
		public function createEventObject($matches, $pattern)
		{
			switch($pattern)
			{
				case self::CLIENT_REMOVED_FROM_SERVERGROUP:
					return new clientRemovedFromServerGroup($matches[2][0], $matches[1][0],$matches[4][0],$matches[3][0],$matches[6][0], $matches[5][0]);
				case self::CLIENT_ADDED_TO_SERVERGROUP:
					return new clientAddedToServerGroup($matches[2][0], $matches[1][0],$matches[4][0],$matches[3][0],$matches[6][0], $matches[5][0]);
				case self::CLIENT_ADDED_TO_CHANNELGROUP:
					return new clientAddedToChannelGroup($matches[2][0], $matches[1][0],$matches[4][0],$matches[3][0],$matches[6][0], $matches[5][0], $matches[8][0], $matches[7][0]);
				case self::PERMISSION_ADDED_TO_CHANNEL:
					return new permissionAddedToChannel($matches[2][0], $matches[1][0], $matches[3][0], $matches[7][0], $matches[6][0], $matches[5][0], $matches[4][0]);
				case self::PERMISSION_REMOVED_FROM_CHANNEL:
					return new permissionRemovedFromChannel($matches[2][0], $matches[1][0], 0, $matches[4][0], $matches[3][0], $matches[6][0], $matches[5][0]);
				case self::PERMISSION_ADDED_TO_SERVERGROUP:
					return new permissionAddedToServerGroup($matches[2][0], $matches[1][0], $matches[3][0], $matches[9][0], $matches[8][0], $matches[7][0], $matches[6][0]);
				case self::PERMISSION_REMOVED_FROM_SERVERGROUP:
					return new permissionRemovedFromServerGroup($matches[2][0], $matches[1][0], 0, $matches[6][0], $matches[5][0], $matches[4][0], $matches[3][0]);
				case self::PERMISSION_ADDED_TO_CHANNELGROUP:
					return new permissionAddedToChannelGroup($matches[2][0], $matches[1][0], $matches[3][0], $matches[7][0], $matches[6][0], $matches[5][0], $matches[4][0]);
				case self::PERMISSION_REMOVED_FROM_CHANNELGROUP:
					return new permissionRemovedFromChannelGroup($matches[2][0], $matches[1][0], 0, $matches[6][0], $matches[5][0], $matches[4][0], $matches[3][0]);
				case self::CHANNELGROUP_CREATED:
					return new channelGroupCreated($matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::CHANNELGROUP_DELETED:
					return new channelGroupDeleted($matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::CHANNELGROUP_RENAMED:
					return new channelGroupRenamed($matches[0][3], $matches[0][1], $matches[0][2], $matches[0][5], $matches[0][4]);
				case self::SERVERGROUP_CREATED:
					return new serverGroupCreated($matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::SERVERGROUP_DELETED:
					return new serverGroupDeleted($matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::SERVERGROUP_RENAMED:
					return new serverGroupRenamed($matches[0][3], $matches[0][1], $matches[0][2], $matches[0][5], $matches[0][4]);
				case self::SERVERGROUP_COPIED:
					return new serverGroupCopied($matches[0][6], $matches[0][5], $matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::CHANNELGROUP_COPIED:
					return new channelGroupCopied($matches[0][6], $matches[0][5], $matches[0][2], $matches[0][1], $matches[0][4], $matches[0][3]);
				case self::PERMISSION_ADDED_TO_CLIENT_CHANNEL:
					return new permissionAddedToClientChannel($matches[2][0], $matches[1][0], $matches[3][0], $matches[6][0], $matches[8][0], $matches[7][0], $matches[5][0], $matches[4][0]);
				case self::PERMISSION_REMOVED_FROM_CLIENT_CHANNEL:
					return new permissionRemovedFromClientChannel($matches[2][0], $matches[1][0], 0, $matches[5][0], $matches[7][0], $matches[6][0], $matches[5][0], $matches[4][0]);
				case self::PERMISSION_ADDED_TO_CLIENT:
					return new permissionAddedToClient($matches[2][0], $matches[1][0], $matches[3][0], $matches[6][0], $matches[5][0], $matches[4][0]);
				case self::PERMISSION_REMOVED_FROM_CLIENT:
					return new permissionRemovedFromClient($matches[2][0], $matches[1][0], 0, $matches[5][0], $matches[4][0], $matches[3][0]);
				case self::BAN_ADDED:
					return new banAdded($matches[1][0], $matches[2][0], $matches[3][0], $matches[4][0], $matches[6][0], $matches[5][0]);
				case self::BAN_EXPIRED:
				case self::BAN_DELETED:
					return new banDeleted($matches[1][0], $matches[2][0], $matches[3][0], $matches[4][0], $matches[6][0], $matches[5][0]);
			}
		}
		
		
		public function fetchEvents()
		{
			$logs = $this->getLastLogs();
			$events = [];
			foreach($logs as $log)
			{
				$event = $this->getEvent($log);
				if(!is_null($event))
				{
					$events[] = $event;
				}
			}
			return $events;
		}
	}