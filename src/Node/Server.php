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

		public function whoAmI(): Reply
		{
			return $this->getParent()->execute("whoami");
		}

		public function serverInfo(): Reply
		{
			return $this->getParent()->execute("serverinfo");
		}

		public function clientList($params = []): Reply
		{
			return $this->getParent()->execute("clientlist", [], $params, true);
		}

		public function banAdd(mixed $value, string $key="uid", int $time = 0, string $reason = ""): Reply
		{
			return $this->getParent()->execute("banadd", [$key => $value, "time" => $time, "banreason" => $reason]);
		}

		public function banClient(int $clid, int $time = 0, string $reason = ""): Reply
		{
			return $this->getParent()->execute("banclient", ["clid" => $clid, "time" => $time, "banreason" => $reason]);
		}

		public function banDelete(int $banid): Reply
		{
			return $this->getParent()->execute("bandel", ["banid" => $banid]);
		}

		public function banDeleteAll(): Reply
		{
			return $this->getParent()->execute("bandelall");
		}

		public function banList(): Reply
		{
			return $this->getParent()->execute("banlist");
		}

		public function bindingList(int $subsystem = 0): Reply
		{
			return $this->getParent()->execute("bindinglist", [], ["subsystem" => $subsystem]);
		}

		public function channelAddPerm(int $cid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms);
			return $this->getParent()->execute("channeladdperm cid=$cid " . $permissions);
		}

		public function channelClientAddPerm(int $cid, int $cldbid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms);
			return $this->getParent()->execute("channelclientaddperm cid=$cid cldbid=$cldbid " . $permissions);
		}

		public function clientDbList(int $start, int $duration, array $params = []): Reply
		{
			return $this->getParent()->execute("clientdblist", ["start" => $start, "duration" => $duration], $params);
		}

		public function clientDbInfo(int $dbid): Reply {
			return $this->getParent()->execute("clientdbinfo", ["cldbid" => $dbid]);
		}

		public function channelClientDelPerm(int $cid, int $cldbid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms, true);
			return $this->getParent()->execute("channelclientdelperm cid=$cid cldbid=$cldbid " . $permissions);
		}

		public function channelClientPermList(int $cid, int $cldbid, array $params = ["permsid"]): Reply
		{
			return $this->getParent()->execute("channelclientpermlist", ["cid" => $cid, "cldbid" => $cldbid], $params);
		}

		public function channelCreate(array $data): Reply
		{
			return $this->getParent()->execute("channelcreate", $data);
		}

		public function channelDelete(int $cid): Reply
		{
			return $this->getParent()->execute("channeldelete", ["cid" => $cid]);
		}

		public function channelDelPerm(int $cid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms, true);
			return $this->getParent()->execute("channeldelperm cid=$cid $permissions");
		}

		public function channelEdit(int $cid, array $data): Reply
		{
			$data['cid'] = $cid;
			return $this->getParent()->execute("channeledit", $data);
		}

		public function channelFind(string $pattern): Reply
		{
			return $this->getParent()->execute("channelfind", ["pattern" => $pattern]);
		}

		public function channelGetIconByChannelID(int $channelID): Reply
		{
			return $this->getParent()->execute("channelgeticon", ["cid" => $channelID]);
		}

		public function channelGroupAdd(string $name, int $type = 1): Reply
		{
			return $this->getParent()->execute("channelgroupadd", ["name" => $name, "type" => $type]);
		}

		public function channelGroupAddClient(int $cgid, int $cid, int $cldbid)
		{
			return $this->getParent()->execute("setclientchannelgroup ", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
		}

		public function channelGroupAddPerm(int $cgid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms);
			return $this->getParent()->execute("channelgroupaddperm cgid=$cgid $permissions");
		}

		public function channelGroupClientList(int $cid = null, int $cldbid = null, int $cgid = null): Reply
		{
			return $this->getParent()->execute("channelgroupclientlist", ["cid" => $cid, "cldbid" => $cldbid, "cgid" => $cgid], [], true);
		}

		public function channelGroupCopy(int $scgid, int $tcgid, string $name, int $type = 1): Reply
		{
			return $this->getParent()->execute("channelgroupcopy", ["scgid" => $scgid, "tcgid" => $tcgid, "name" => $name, "type" => $type]);
		}

		public function channelGroupDelete(int $cgid, int $force = 1): Reply
		{
			return $this->getParent()->execute("channelgroupdel", ["cgid" => $cgid, "force" => $force]);
		}

		public function channelGroupDelPerm(int $cgid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms, true);
			return $this->getParent()->execute("channelgroupdelperm cgid=$cgid $permissions");
		}

		public function channelGroupList(): Reply
		{
			return $this->getParent()->execute("channelgrouplist");
		}

		public function channelGroupPermList(int $cgid, array $params = ['permsid']): Reply
		{
			return $this->getParent()->execute("channelgrouppermlist", ["cgid" => $cgid], $params);
		}

		public function channelGroupRename(int $cgid, string $name): Reply
		{
			return $this->getParent()->execute("channelgrouprename", ["cgid" => $cgid, "name" => $name]);
		}

		public function channelInfo(int $cid): Reply
		{
			return $this->getParent()->execute("channelinfo", ["cid" => $cid]);
		}

		public function channelList(array $params = []): Reply
		{
			return $this->getParent()->execute("channellist", [], $params);
		}

		public function channelMove(int $cid, int $cpid, int $order = null): Reply
		{
			return $this->getParent()->execute("channelmove", ["cid" => $cid, "cpid" => $cpid, "order" => $order]);
		}

		public function channelPermList(int $cid, array $params = ['permsid']): Reply
		{
			return $this->getParent()->execute("channelpermlist", ["cid" => $cid], $params);
		}

		public function complainAdd(int $tcldbid, string $message): Reply
		{
			return $this->getParent()->execute("complainadd", ["tcldbid" => $tcldbid, "message" => $message]);
		}

		public function complainDel(int $tcldbid, int $fcldbid): Reply
		{
			return $this->getParent()->execute("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
		}

		public function complainList()
		{
			return $this->getParent()->execute("complainlist");
		}

		public function customInfo(string $ident, string $value): Reply
		{
			return $this->getParent()->execute("custominfo", ["ident" => $ident, "value" => $value]);
		}

		public function customSearch(string $ident, string $pattern): Reply
		{
			return $this->getParent()->execute("customsearch", ["ident" => $ident, "pattern" => $pattern]);
		}

		public function ftCreateDir(string $cid, string $dirname): Reply
		{
			return $this->getParent()->execute("ftcreatedir", ["cid" => $cid, "dirname" => $dirname]);
		}

		public function ftDeleteFile(string $cid, string $name): Reply
		{
			return $this->getParent()->execute("ftdeletefile", ["cid" => $cid, "cpw" => "", "name" => "/" . $name]);
		}

		public function ftGetFileList(string $cid, string $path, string $cpw = null): Reply
		{
			return $this->getParent()->execute("ftgetfilelist", ["cpw" => $cpw, "cid" => $cid, "path" => $path], [], true);
		}

		public function ftGetFileInfo(string $cid, string $name): Reply
		{
			return $this->getParent()->execute("ftgetfileinfo", ["cid" => $cid, "name" => $name]);
		}

		public function ftInitDownload(string $cid, string $name): Reply
		{
			return $this->getParent()->execute("ftinitdownload", ["cid" => $cid, "name" => $name]);
		}

		public function ftInitUpload(string $cid, string $name, string $cpw = null, int $size = 0, int $overwrite = 1, int $resume = 0): Reply
		{
			return $this->getParent()->execute("ftinitupload", ["cid" => $cid, "name" => $name, "cpw" => $cpw, "size" => $size, "overwrite" => $overwrite, "resume" => $resume]);
		}

		public function ftList(string $path): Reply
		{
			return $this->getParent()->execute("ftlist", ["path" => $path]);
		}

		public function ftRenameFile(string $cid, string $oldname, string $newname): Reply
		{
			return $this->getParent()->execute("ftrenamefile", ["cid" => $cid, "oldname" => $oldname, "newname" => $newname]);
		}

		public function ftStop(int $ftid, int $delete = 0): Reply
		{
			return $this->getParent()->execute("ftstop", ["ftid" => $ftid, "delete" => $delete]);
		}

		public function hostInfo(): Reply
		{
			return $this->getParent()->execute("hostinfo");
		}

		public function instanceEdit(array $data): Reply
		{
			return $this->getParent()->execute("instanceedit", $data);
		}

		public function instanceInfo(): Reply
		{
			return $this->getParent()->execute("instanceinfo");
		}

		public function logAdd(string $loglevel, string $logmsg): Reply
		{
			return $this->getParent()->execute("logadd", ["loglevel" => $loglevel, "logmsg" => $logmsg]);
		}

		public function logView(int $lines = 100, int $reverse = 0, int $instance = 0, int $begin_pos = 0): Reply
		{
			return $this->getParent()->execute("logview", ["lines" => $lines, "reverse" => $reverse, "instance" => $instance, "begin_pos" => $begin_pos],[],true);
		}

		public function messageAdd(string $msg, int $targetmode, int $target, string $targetname = null): Reply
		{
			return $this->getParent()->execute("messageadd", ["msg" => $msg, "targetmode" => $targetmode, "target" => $target, "targetname" => $targetname]);
		}

		public function messageDel(int $msgid): Reply
		{
			return $this->getParent()->execute("messagedel", ["msgid" => $msgid]);
		}

		public function messageGet(int $msgid): Reply
		{
			return $this->getParent()->execute("messageget", ["msgid" => $msgid]);
		}

		public function messageList(int $count = 10, int $offset = 0): Reply
		{
			return $this->getParent()->execute("messagelist", ["count" => $count, "offset" => $offset]);
		}

		public function messageUpdateFlag(int $msgid, int $flag): Reply
		{
			return $this->getParent()->execute("messageupdateflag", ["msgid" => $msgid, "flag" => $flag]);
		}

		public function permFind(string $permsid): Reply
		{
			return $this->getParent()->execute("permfind", ["permsid" => $permsid]);
		}

		public function permGet(int $permid): Reply
		{
			return $this->getParent()->execute("permget", ["permid" => $permid]);
		}

		public function permOverview(int $cid, int $cldbid, array $permissions): Reply
		{
			$permissions = $this->getParent()->convertPermissions($permissions);
			return $this->getParent()->execute("permoverview " . $permissions, ["cid" => $cid, "cldbid" => $cldbid]);
		}

		public function permReset(): Reply
		{
			return $this->getParent()->execute("permreset");
		}

		public function sendMessage(int $targetmode, int $target, string $msg): Reply
		{
			return $this->getParent()->execute("sendtextmessage", ["target" => $target, "targetmode" => $targetmode, "msg" => $msg]);
		}

		public function serverGroupAdd(string $name, int $type = 1): Reply
		{
			return $this->getParent()->execute("servergroupadd", ["name" => $name, "type" => $type]);
		}

		public function serverGroupAddClient(int $sgid, int $cldbid): Reply
		{
			return $this->getParent()->execute("servergroupaddclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
		}

		public function serverGroupAddPerm(int $sgid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms);
			return $this->getParent()->execute("servergroupaddperm " . $permissions, ["sgid" => $sgid]);
		}

		public function serverGroupClientList(int $sgid, array $params = ["names"]): Reply
		{
			return $this->getParent()->execute("servergroupclientlist", ["sgid" => $sgid], $params);
		}

		public function serverGroupCopy(int $ssgid, string $name, int $tsgid = 0, int $type = 1): Reply
		{
			return $this->getParent()->execute("servergroupcopy", ["ssgid" => $ssgid, "tsgid" => $tsgid, "name" => $name, "type" => $type]);
		}

		public function serverGroupDeleteClient(int $sgid, int $cldbid): Reply
		{
			return $this->getParent()->execute("servergroupdelclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
		}

		public function serverGroupDelPerm(int $sgid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms, true);
			return $this->getParent()->execute("servergroupdelperm " .$permissions, ["sgid" => $sgid]);
		}

		public function serverGroupList(): Reply
		{
			return $this->getParent()->execute("servergrouplist");
		}

		public function serverGroupPermList(int $sgid, array $params = ["permsid"]): Reply
		{
			return $this->getParent()->execute("servergrouppermlist", ["sgid" => $sgid], $params );
		}

		public function serverGroupRename(int $sgid, string $name): Reply
		{
			return $this->getParent()->execute("servergrouprename", ["sgid" => $sgid, "name" => $name]);
		}

		public function serverGroupsByClientID(int $cldbid): Reply
		{
			return $this->getParent()->execute("servergroupsbyclientid", ["cldbid" => $cldbid]);
		}

		public function clientAddPerm(int $cldbid, array $permissions): Reply
		{
			$perms = $this->getParent()->convertPermissions($permissions);
			return $this->getParent()->execute("clientaddperm cldbid=$cldbid " . $perms);
		}

		public function clientDelPerm(int $cldbid, array $permissions): Reply
		{
			$perms = $this->getParent()->convertPermissions($permissions, true);
			return $this->getParent()->execute("clientdelperm cldbid=$cldbid " . $perms);
		}

		public function clientFind(string $pattern): Reply
		{
			return $this->getParent()->execute("clientfind", ["pattern" => $pattern]);
		}

		public function clientGetDBIDFromUID(string $cluid): Reply
		{
			return $this->getParent()->execute("clientgetdbidfromuid", ["cluid" => $cluid]);
		}

		public function clientGetNameFromDBID(int $cldbid): Reply
		{
			return $this->getParent()->execute("clientgetnamefromdbid", ["cldbid" => $cldbid]);
		}

		public function clientGetNameFromUID(string $cluid): Reply
		{
			return $this->getParent()->execute("clientgetnamefromuid", ["cluid" => $cluid]);
		}

		public function clientGetUidFromClid(int $clid): Reply
		{
			return $this->getParent()->execute("clientgetuidfromclid", ["clid" => $clid]);
		}

		public function clientInfo(int $clid): Reply
		{
			return $this->getParent()->execute("clientinfo", ["clid" => $clid]);
		}

		public function clientKick(int $clid, int $reasonid, string $reasonmsg = null): Reply
		{
			return $this->getParent()->execute("clientkick", ["clid" => $clid, "reasonid" => $reasonid, "reasonmsg" => $reasonmsg]);
		}

		public function clientMove(int $clid, int $cid, string $cpw = null): Reply
		{
			return $this->getParent()->execute("clientmove", ["clid" => $clid, "cid" => $cid, "cpw" => $cpw]);
		}

		public function clientPoke(int $clid, string $msg): Reply
		{
			return $this->getParent()->execute("clientpoke", ["clid" => $clid, "msg" => $msg]);
		}

		public function clientSetServerQueryLogin(string $client_login_name): Reply
		{
			return $this->getParent()->execute("clientsetserverquerylogin", ["client_login_name" => $client_login_name]);
		}

		public function clientUpdate(array $data): Reply
		{
			return $this->getParent()->execute("clientupdate", $data);
		}

		public function complainDelete(int $tcldbid, int $fcldbid): Reply
		{
			return $this->getParent()->execute("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
		}

		public function complainDeleteAll(int $tcldbid): Reply
		{
			return $this->getParent()->execute("complaindelall", ["tcldbid" => $tcldbid]);
		}


		public function customDelete(int $cldbid, string $ident): Reply
		{
			return $this->getParent()->execute("customdelete", ["cldbid" => $cldbid, "ident" => $ident]);
		}

		public function customSet(int $cldbid, string $ident, string $value): Reply
		{
			return $this->getParent()->execute("customset", ["cldbid" => $cldbid, "ident" => $ident, "value" => $value]);
		}


		public function logout(): Reply
		{
			return $this->getParent()->execute("logout");
		}

		public function serverEdit($data): Reply
		{
			return $this->getParent()->execute("serveredit", $data);
		}

		public function serverGroupDelete(int $sgid, int $force = 1): Reply
		{
			return $this->getParent()->execute("servergroupdel", ["sgid" => $sgid, "force" => $force]);
		}

		public function serverNotifyUnregister(): Reply
		{
			return $this->getParent()->execute("servernotifyunregister");
		}

		public function serverNotifyRegister(string $event, int $id = 0): Reply
		{
			if($event != 'channel')
			{
				return $this->getParent()->execute("servernotifyregister", ["event" => $event]);
			}
			return $this->getParent()->execute("servernotifyregister", ["event" => $event, "id" => $id]);

		}

		public function serverGroupDeletePerm(int $sgid, array $perms): Reply
		{
			$permissions = $this->getParent()->convertPermissions($perms, true);
			return $this->getParent()->execute("servergroupdelperm " . $permissions, ["sgid" => $sgid]);
		}

		public function serverRequestConnectionInfo(): Reply
		{
			return $this->getParent()->execute("serverrequestconnectioninfo");
		}

		public function serverSnapshotCreate(): Reply
		{
			return $this->getParent()->execute("serversnapshotcreate");
		}

		public function serverSnapshotDeploy(string $snapshot, int $mapping = 0): Reply
		{
			return $this->getParent()->execute("serversnapshotdeploy", ["snapshot" => $snapshot, "mapping" => $mapping]);
		}

		public function setClientChannelGroup(int $cgid, int $cid, int $cldbid): Reply
		{
			return $this->getParent()->execute("setclientchannelgroup", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
		}

		public function apiKeyAdd(string $scope, int $time, int $cldbid): Reply
		{
			return $this->getParent()->execute("apikeyadd", ["scope" => $scope, "lifetime" => $time, "cldbid" => $cldbid]);
		}

		public function apiKeyDel(int $id): Reply
		{
			return $this->getParent()->execute("apikeydel", ["id" => $id]);
		}

		public function apiKeyList(): Reply
		{
			return $this->getParent()->execute("apikeylist");
		}

		public function queryLoginAdd(string $login_name, int $cldbid): Reply
		{
			return $this->getParent()->execute("queryloginadd", ["login_name" => $login_name, "cldbid" => $cldbid]);
		}

		public function queryLoginDel(int $cldbid): Reply
		{
			return $this->getParent()->execute("querylogindel", ["cldbid" => $cldbid]);
		}

		public function queryLoginList(): Reply
		{
			return $this->getParent()->execute("queryloginlist");
		}


	}