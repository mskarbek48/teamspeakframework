<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 * @link https://dbot.pl
	 *
	 * @created/updated at 7/5/24 11:39 AM
	 *
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Adapter;
	
	use dBot\Database\Database;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelCreated;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelDeleted;
	use mskarbek48\TeamspeakFramework\Adapter\Events\channelEdited;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientEnterView;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientLeftView;
	use mskarbek48\TeamspeakFramework\Adapter\Events\clientMoved;
	use mskarbek48\TeamspeakFramework\Ts3admin;
	
	class NotifyEvent
	{
		private array $clients;
		public function __construct(
			private Ts3admin $ts3admin,
			private Database $pdo
		){
			$clientList = $this->ts3admin->clientList()->response();
			foreach($clientList as $client)
			{
				$this->pushClient($client);
			}
		}
		
		public function pushClient(array $client)
		{
			if(!isset($this->clients[$client['clid']]))
			{
				$this->clients[$client['clid']] = ['type' => $client['client_type'], 'dbid' => $client['client_database_id'], 'cid' => $client['cid']];
			}
		}
		
		public function removeClient(int $clid)
		{
			if(isset($this->clients[$clid]))
			{
				unset($this->clients[$clid]);
			}
		}
		
		public function getClient(int $clid)
		{
			if(isset($this->clients[$clid]))
			{
				return $this->clients[$clid];
			}
		}
		
		public function isQuery(int $clid)
		{
			return $this->clients[$clid]['type'] == 1;
		}
		
		public function onEvent(
			array $event_raw
		)
		{
			
			switch(key($event_raw))
			{
				case "notifyclientmoved":
					if(!$this->isQuery($event_raw['clid']))
					{
						// reasonid
						// invokerid
						// clid
						// channelid
						// reasonmsg
						// reasonid
					}
					break;
				case "notifycliententerview":
				
				
			}
			
			
			if(isset($event_raw['invokerid']) && $event_raw['invokerid'] != $this->ts3admin->getMyClid())
			{
				
				$object = match(key($event_raw))
				{
					'notifyclientmoved' => new clientMoved($this->ts3admin, $event_raw),
					'notifycliententerview' => new clientEnterView($this->ts3admin, $event_raw),
					'notifyclientleftview' => new clientLeftView($this->ts3admin, $event_raw),
					'notifychannelcreated' => new channelCreated($this->ts3admin, $event_raw),
					'notifychanneldeleted' => new channelDeleted($this->ts3admin, $event_raw),
					'notifychanneledited' => new channelEdited($this->ts3admin, $event_raw),
					default => null
				};
				
				return $object;
			}
			

			
		}
		

		
		
		
	}