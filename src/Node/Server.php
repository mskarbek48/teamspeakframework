<?php
	/**
	 * This file is a part of mskarbek48${PROJECT_NAME}
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 06.07.2024 14:01
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/

	namespace mskarbek48\TeamspeakFramework\Node;

	use mskarbek48\TeamspeakFramework\Adapter\ServerQuery\Reply;

	class Server extends AbstractNode
	{

		public function serverInfo(): Reply
		{
			return $this->serverQuery->execute("serverinfo");
		}

		public function clientList($params = []): Reply
		{
			return $this->serverQuery->execute("clientlist", [], $params, true);
		}

		public function banAdd($value, $key="uid", $time = 0, $reason = null): Reply
		{
			return $this->serverQuery->execute("banadd", [$key => $value, "time" => $time, "banreason" => $reason]);
		}

		public function banClient(int $clid, $time = 0, $reason = null): Reply
		{
			return $this->serverQuery->execute("banclient", ["clid" => $clid, "time" => $time, "banreason" => $reason]);
		}

		public function banDelete(int $banid): Reply
		{
			return $this->serverQuery->execute("bandel", ["banid" => $banid]);
		}

		public function banDeleteAll(): Reply
		{
			return $this->serverQuery->execute("bandelall");
		}

		public function banList(): Reply
		{
			return $this->serverQuery->execute("banlist");
		}

		public function bindingList(int $subsystem = 0): Reply
		{
			return $this->serverQuery->execute("bindinglist", [], ["subsystem" => $subsystem]);
		}

		public function channelAddPerm(int $cid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
			}
			return $this->serverQuery->execute("channeladdperm cid=$cid $permissions");
		}

		public function channelClientAddPerm(int $cid, int $cldbid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
			}
			return $this->serverQuery->execute("channelclientaddperm cid=$cid cldbid=$cldbid $permissions");
		}

		public function clientDbList($start = 0, $duration, $params = []): Reply
		{

			return $this->serverQuery->execute("clientdblist", ["start" => $start, "duration" => $duration], $params);
		}

		public function clientDbInfo(int $dbid): Reply {
			return $this->serverQuery->execute("clientdbinfo", ["cldbid" => $dbid]);
		}

		public function channelClientDelPerm(int $cid, int $cldbid, array $perms): Reply
		{
			$permissions = [];
			foreach($perms as $key)
			{
				$permissions[]= (is_numeric($key)?'permid':'permsid') . "=" . $key;
			}
			return $this->serverQuery->execute("channelclientdelperm cid=$cid cldbid=$cldbid " . implode("|", $permissions));
		}

		public function channelClientPermList(int $cid, int $cldbid, bool $permsid = false): Reply
		{
			$params = $permsid ? "permsid" : "";
			return $this->serverQuery->execute("channelclientpermlist", ["cid" => $cid, "cldbid" => $cldbid], [$params]);
		}

		public function channelCreate(array $data): Reply
		{
			return $this->serverQuery->execute("channelcreate", $data);
		}

		public function channelDelete(int $cid): Reply
		{
			return $this->serverQuery->execute("channeldelete", ["cid" => $cid]);
		}

		public function channelDelPerm(int $cid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
			}
			return $this->serverQuery->execute("channeldelperm cid=$cid $permissions");
		}

		public function channelEdit(int $cid, array $data): Reply
		{
			$ndata['cid'] = $cid;
			$data = array_merge($ndata, $data);
			return $this->serverQuery->execute("channeledit", $data);
		}

		public function channelFind(string $pattern): Reply
		{
			return $this->serverQuery->execute("channelfind", ["pattern" => $pattern]);
		}

		public function channelGetIconByChannelID(int $channelID): Reply
		{
			return $this->serverQuery->execute("channelgeticon", ["cid" => $channelID]);
		}

		public function channelGroupAdd(string $name, int $type = 1): Reply
		{
			return $this->serverQuery->execute("channelgroupadd", ["name" => $name, "type" => $type]);
		}

		public function channelGroupAddClient(int $cgid, int $cid, int $cldbid)
		{
			return $this->serverQuery->execute("channelgroupaddclient", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
		}

		public function channelGroupAddPerm(int $cgid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
			}
			return $this->serverQuery->execute("channelgroupaddperm cgid=$cgid $permissions");
		}

		public function channelGroupClientList(int $cid = null, int $cldbid = null, int $cgid = null): Reply
		{
			return $this->serverQuery->execute("channelgroupclientlist", ["cid" => $cid, "cldbid" => $cldbid, "cgid" => $cgid], [], true);
		}

		public function channelGroupCopy(int $scgid, int $tcgid, string $name, int $type = 1): Reply
		{
			return $this->serverQuery->execute("channelgroupcopy", ["scgid" => $scgid, "tcgid" => $tcgid, "name" => $name, "type" => $type]);
		}

		public function channelGroupDelete(int $cgid, int $force = 1): Reply
		{
			return $this->serverQuery->execute("channelgroupdel", ["cgid" => $cgid, "force" => $force]);
		}

		public function channelGroupDelPerm(int $cgid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
			}
			return $this->serverQuery->execute("channelgroupdelperm cgid=$cgid $permissions");
		}

		public function channelGroupList(): Reply
		{
			return $this->serverQuery->execute("channelgrouplist");
		}

		public function channelGroupPermList(int $cgid, bool $permsid = false): Reply
		{
			$params = $permsid ? "permsid" : "";
			return $this->serverQuery->execute("channelgrouppermlist", ["cgid" => $cgid], [$params]);
		}

		public function channelGroupRename(int $cgid, string $name): Reply
		{
			return $this->serverQuery->execute("channelgrouprename", ["cgid" => $cgid, "name" => $name]);
		}

		public function channelInfo(int $cid): Reply
		{
			return $this->serverQuery->execute("channelinfo", ["cid" => $cid]);
		}

		public function channelList(array $params = []): Reply
		{
			return $this->serverQuery->execute("channellist", [], $params);
		}

		public function channelMove(int $cid, int $cpid, int $order = null): Reply
		{
			return $this->serverQuery->execute("channelmove", ["cid" => $cid, "cpid" => $cpid, "order" => $order]);
		}

		public function channelPermList(int $cid, bool $permsid = false): Reply
		{
			$params = $permsid ? "permsid" : "";
			return $this->serverQuery->execute("channelpermlist", ["cid" => $cid], [$params]);
		}

		public function channelSetPerm(int $cid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
			}
			return $this->serverQuery->execute("channelsetperm cid=$cid $permissions");
		}

		public function complainAdd(int $tcldbid, string $message): Reply
		{
			return $this->serverQuery->execute("complainadd", ["tcldbid" => $tcldbid, "message" => $message]);
		}

		public function complainDel(int $tcldbid, int $fcldbid): Reply
		{
			return $this->serverQuery->execute("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
		}

		public function complainList()
		{
			return $this->serverQuery->execute("complainlist");
		}

		public function customInfo(string $ident, string $value): Reply
		{
			return $this->serverQuery->execute("custominfo", ["ident" => $ident, "value" => $value]);
		}

		public function customSearch(string $ident, string $pattern): Reply
		{
			return $this->serverQuery->execute("customsearch", ["ident" => $ident, "pattern" => $pattern]);
		}

		public function ftCreateDir(string $cid, string $dirname): Reply
		{
			return $this->serverQuery->execute("ftcreatedir", ["cid" => $cid, "dirname" => $dirname]);
		}

		public function ftDeleteFile(string $cid, string $name): Reply
		{
			return $this->serverQuery->execute("ftdeletefile", ["cid" => $cid, "cpw" => "", "name" => "/" . $name]);
		}

		public function ftGetFileList(string $cid, string $path): Reply
		{
			return $this->serverQuery->execute("ftgetfilelist", ["cpw" => "", "cid" => $cid, "path" => $path], [], true);
		}

		public function ftGetFileInfo(string $cid, string $name): Reply
		{
			return $this->serverQuery->execute("ftgetfileinfo", ["cid" => $cid, "name" => $name]);
		}

		public function ftInitDownload(string $cid, string $name): Reply
		{
			return $this->serverQuery->execute("ftinitdownload", ["cid" => $cid, "name" => $name]);
		}

		public function ftInitUpload(string $cid, string $name, string $cpw = null, int $size = 0, int $overwrite = 1, int $resume = 0): Reply
		{
			return $this->serverQuery->execute("ftinitupload", ["cid" => $cid, "name" => $name, "cpw" => $cpw, "size" => $size, "overwrite" => $overwrite, "resume" => $resume]);
		}

		public function ftList(string $path): Reply
		{
			return $this->serverQuery->execute("ftlist", ["path" => $path]);
		}

		public function ftRenameFile(string $cid, string $oldname, string $newname): Reply
		{
			return $this->serverQuery->execute("ftrenamefile", ["cid" => $cid, "oldname" => $oldname, "newname" => $newname]);
		}

		public function ftStop(int $ftid, int $delete = 0): Reply
		{
			return $this->serverQuery->execute("ftstop", ["ftid" => $ftid, "delete" => $delete]);
		}

		public function hostInfo(): Reply
		{
			return $this->serverQuery->execute("hostinfo");
		}

		public function instanceEdit(array $data): Reply
		{
			return $this->serverQuery->execute("instanceedit", $data);
		}

		public function instanceInfo(): Reply
		{
			return $this->serverQuery->execute("instanceinfo");
		}

		public function logAdd(string $loglevel, string $logmsg): Reply
		{
			return $this->serverQuery->execute("logadd", ["loglevel" => $loglevel, "logmsg" => $logmsg]);
		}

		public function logView(int $lines = 100, int $reverse = 0, int $instance = 0, int $begin_pos = 0): Reply
		{
			return $this->serverQuery->execute("logview", ["lines" => $lines, "reverse" => $reverse, "instance" => $instance, "begin_pos" => $begin_pos],[],true);
		}

		public function messageAdd(string $msg, int $targetmode, int $target, string $targetname = null): Reply
		{
			return $this->serverQuery->execute("messageadd", ["msg" => $msg, "targetmode" => $targetmode, "target" => $target, "targetname" => $targetname]);
		}

		public function messageDel(int $msgid): Reply
		{
			return $this->serverQuery->execute("messagedel", ["msgid" => $msgid]);
		}

		public function messageGet(int $msgid): Reply
		{
			return $this->serverQuery->execute("messageget", ["msgid" => $msgid]);
		}

		public function messageList(int $count = 10, int $offset = 0): Reply
		{
			return $this->serverQuery->execute("messagelist", ["count" => $count, "offset" => $offset]);
		}

		public function messageUpdateFlag(int $msgid, int $flag): Reply
		{
			return $this->serverQuery->execute("messageupdateflag", ["msgid" => $msgid, "flag" => $flag]);
		}

		public function permFind(string $permsid): Reply
		{
			return $this->serverQuery->execute("permfind", ["permsid" => $permsid]);
		}

		public function permGet(int $permid): Reply
		{
			return $this->serverQuery->execute("permget", ["permid" => $permid]);
		}

		public function permList(): Reply
		{
			return $this->serverQuery->execute("permlist");
		}

		public function permOverview(int $permid): Reply
		{
			return $this->serverQuery->execute("permoverview", ["permid" => $permid]);
		}

		public function permReset(): Reply
		{
			return $this->serverQuery->execute("permreset");
		}

		public function sendMessage($targetmode, $target, $msg): Reply
		{
			return $this->serverQuery->execute("sendtextmessage", ["target" => $target, "targetmode" => $targetmode, "msg" => $msg]);
		}

		public function serverGroupAdd(string $name, int $type = 1): Reply
		{
			return $this->serverQuery->execute("servergroupadd", ["name" => $name, "type" => $type]);
		}

		public function serverGroupAddClient(int $sgid, int $cldbid): Reply
		{
			return $this->serverQuery->execute("servergroupaddclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
		}

		public function serverGroupAddPerm(int $sgid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
			}
			return $this->serverQuery->execute("servergroupaddperm", ["sgid" => $sgid, $permissions]);
		}

		public function serverGroupClientList(int $sgid, bool $names = false): Reply
		{
			$params = [];
			if($names)
			{
				$params[] = "names";
			}
			return $this->serverQuery->execute("servergroupclientlist", ["sgid" => $sgid], $params, true);
		}

		public function serverGroupCopy(int $ssgid, string $name, int $type = 1): Reply
		{
			return $this->serverQuery->execute("servergroupcopy", ["ssgid" => $ssgid, "tsgid" => 0, "name" => $name, "type" => $type]);
		}

		public function serverGroupDeleteClient(int $sgid, int $cldbid): Reply
		{
			return $this->serverQuery->execute("servergroupdelclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
		}

		public function serverGroupDelPerm(int $sgid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
			}
			return $this->serverQuery->execute("servergroupdelperm", ["sgid" => $sgid, $permissions]);
		}

		public function serverGroupList(): Reply
		{
			return $this->serverQuery->execute("servergrouplist");
		}

		public function serverGroupPermList(int $sgid, bool $permsid = false): Reply
		{
			$params = $permsid ? "permsid" : "";
			return $this->serverQuery->execute("servergrouppermlist", ["sgid" => $sgid], [$params]);
		}

		public function serverGroupRename(int $sgid, string $name): Reply
		{
			return $this->serverQuery->execute("servergrouprename", ["sgid" => $sgid, "name" => $name]);
		}

		public function serverGroupsByClientID(int $cldbid): Reply
		{
			return $this->serverQuery->execute("servergroupsbyclientid", ["cldbid" => $cldbid]);
		}

		public function clientAddPerm(int $cldbid, array $permissions): Reply
		{
			$perms = [];
			foreach ($permissions as $key => $perm) {
				$perms[] = (is_numeric($key) ? 'permid=' : 'permsid=') . $key . " permvalue=" . $perm[0] . " permskip=" . $perm[1];
			}
			return $this->serverQuery->execute("clientaddperm cldbid=$cldbid " . implode("|", $perms));
		}

		public function clientDelPerm(int $cldbid, array $permissions): Reply
		{
			$perms = [];
			foreach ($permissions as $perm) {
				$perms[] = (is_numeric($perm) ? 'permid=' : 'permsid=') . $perm;
			}
			return $this->serverQuery->execute("clientdelperm cldbid=$cldbid " . implode("|", $perms));
		}

		public function clientFind(string $pattern): Reply
		{
			return $this->serverQuery->execute("clientfind", ["pattern" => $pattern]);
		}

		public function clientGetDBIDFromUID(string $cluid): Reply
		{
			return $this->serverQuery->execute("clientgetdbidfromuid", ["cluid" => $cluid]);
		}

		public function clientGetNameFromDBID(int $cldbid): Reply
		{
			return $this->serverQuery->execute("clientgetnamefromdbid", ["cldbid" => $cldbid]);
		}

		public function clientGetNameFromUID(string $cluid): Reply
		{
			return $this->serverQuery->execute("clientgetnamefromuid", ["cluid" => $cluid]);
		}

		public function clientInfo(int $clid): Reply
		{
			return $this->serverQuery->execute("clientinfo", ["clid" => $clid]);
		}

		public function clientKick(int $clid, int $reasonid, string $reasonmsg = null): Reply
		{
			return $this->serverQuery->execute("clientkick", ["clid" => $clid, "reasonid" => $reasonid, "reasonmsg" => $reasonmsg]);
		}


		public function clientMove(int $clid, int $cid, string $cpw = null): Reply
		{
			return $this->serverQuery->execute("clientmove", ["clid" => $clid, "cid" => $cid, "cpw" => $cpw]);
		}

		public function clientPoke(int $clid, string $msg): Reply
		{
			return $this->serverQuery->execute("clientpoke", ["clid" => $clid, "msg" => $msg]);
		}

		public function clientSetServerQueryLogin(string $client_login_name): Reply
		{
			return $this->serverQuery->execute("clientsetserverquerylogin", ["client_login_name" => $client_login_name]);
		}

		public function clientUpdate(array $data): Reply
		{
			return $this->serverQuery->execute("clientupdate", $data);
		}

		public function complainDelete(int $tcldbid, int $fcldbid): Reply
		{
			return $this->serverQuery->execute("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
		}

		public function complainDeleteAll(int $tcldbid): Reply
		{
			return $this->serverQuery->execute("complaindelall", ["tcldbid" => $tcldbid]);
		}


		public function customDelete(int $cldbid, string $ident): Reply
		{
			return $this->serverQuery->execute("customdelete", ["cldbid" => $cldbid, "ident" => $ident]);
		}

		public function customSet(int $cldbid, string $ident, string $value): Reply
		{
			return $this->serverQuery->execute("customset", ["cldbid" => $cldbid, "ident" => $ident, "value" => $value]);
		}


		public function logout(): Reply
		{
			return $this->serverQuery->execute("logout");
		}

		public function serverEdit($data): Reply
		{
			return $this->serverQuery->execute("serveredit", $data);
		}

		public function serverGroupDelete(int $sgid, int $force = 1): Reply
		{
			return $this->serverQuery->execute("servergroupdel", ["sgid" => $sgid, "force" => $force]);
		}

		public function serverNotifyUnregister(): Reply
		{
			return $this->serverQuery->execute("servernotifyunregister");
		}

		public function serverGroupDeletePerm(int $sgid, array $perms): Reply
		{
			$permissions = "";
			foreach($perms as $key => $perm)
			{
				$permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
			}
			return $this->serverQuery->execute("servergroupdelperm", ["sgid" => $sgid, $permissions]);
		}

		public function serverRequestConnectionInfo(): Reply
		{
			return $this->serverQuery->execute("serverrequestconnectioninfo");
		}

		public function serverSnapshotCreate(): Reply
		{
			return $this->serverQuery->execute("serversnapshotcreate");
		}

		public function serverSnapshotDeploy(string $snapshot, int $mapping = 0): Reply
		{
			return $this->serverQuery->execute("serversnapshotdeploy", ["snapshot" => $snapshot, "mapping" => $mapping]);
		}

		public function setClientChannelGroup(int $cgid, int $cid, int $cldbid): Reply
		{
			return $this->serverQuery->execute("setclientchannelgroup", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
		}

	}