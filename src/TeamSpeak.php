<?php

namespace mskarbek48\TeamspeakFramework;

use mskarbek48\TeamspeakFramework\Adapter\Response;
use mskarbek48\teamspeakframework\Transport\TCP;


final class TeamSpeak {

	private TCP $transport;

	/**
	 * @var int $clientId - Client ID of the current connection
	 */
	private int $clientId;

    public function __construct($host, $queryPort, $timeout = 2)
	{
		$this->transport = new TCP($host, $queryPort, $timeout);
		$line = $this->transport->readLine();
		if(!str_contains($line, "TS3"))
		{
			throw new \Exception("Host isn't a TS3 instance!");
		}
		$this->transport->readLine();
	}
	
	public function notifyRegister(string $event, int $channel = 0): Response
	{
		if($event != "channel")
		{
			return $this->request("servernotifyregister", ["event" => $event]);
		}
		return $this->request("servernotifyregister", ["event" => $event, "id" => $channel]);
	}

	private function request($command, $arguments = [], $params = [], $multi = false): Response
	{
		$command = new Command($this->transport, $command, $arguments, $params, $multi);
		$command->execute();
		return $command->getResponse();
	}

	public function login(string $username, #[\SensitiveParameter] string $password): Response
	{
		return $this->request("login", ["client_login_name" => $username, "client_login_password" => $password]);
	}

    public function selectServer($key = 'port', int $value = 9987, array $params = [], $name = null)
    {
        $select =  $this->request("use", [$key => $value, "client_nickname" => $name], $params);
        $this->clientId = $this->whoAmI()->response()['client_id'];
        return $select;
    }

    public function getMyClid()
    {
        return $this->clientId;
    }

    public function serverInfo()
    {
        return $this->request("serverinfo");
    }

    public function clientList($params = [])
    {
        return $this->request("clientlist", [], $params, true);
    }

    public function whoAmI()
    {
        return $this->request("whoami");
    }

    public function serverList(): Response
    {
        return $this->request("serverlist");
    }

    public function banAdd($value, $key="uid", $time = 0, $reason = null): Response
    {
        return $this->request("banadd", [$key => $value, "time" => $time, "banreason" => $reason]);
    }

    public function banClient(int $clid, $time = 0, $reason = null): Response
    {
        return $this->request("banclient", ["clid" => $clid, "time" => $time, "banreason" => $reason]);
    }

    public function banDelete(int $banid): Response
    {
        return $this->request("bandel", ["banid" => $banid]);
    }

    public function banDeleteAll(): Response
    {
        return $this->request("bandelall");
    }

    public function banList(): Response
    {
        return $this->request("banlist");
    }

    public function bindingList(int $subsystem = 0): Response
    {
        return $this->request("bindinglist", [], ["subsystem" => $subsystem]);
    }

    public function channelAddPerm(int $cid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
        }
        return $this->request("channeladdperm cid=$cid $permissions");
    }

    public function channelClientAddPerm(int $cid, int $cldbid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
        }
        return $this->request("channelclientaddperm cid=$cid cldbid=$cldbid $permissions");
    }

    public function clientDbList($start = 0, $duration, $params = []): Response
    {

        return $this->request("clientdblist", ["start" => $start, "duration" => $duration], $params);
    }
	
	public function clientDbInfo(int $dbid): Response {
		return $this->request("clientdbinfo", ["cldbid" => $dbid]);
	}
	
    public function channelClientDelPerm(int $cid, int $cldbid, array $perms): Response
    {
        $permissions = [];
        foreach($perms as $key)
        {
            $permissions[]= (is_numeric($key)?'permid':'permsid') . "=" . $key;
        }
        return $this->request("channelclientdelperm cid=$cid cldbid=$cldbid " . implode("|", $permissions));
    }

    public function channelClientPermList(int $cid, int $cldbid, bool $permsid = false): Response
    {
        $params = $permsid ? "permsid" : "";
        return $this->request("channelclientpermlist", ["cid" => $cid, "cldbid" => $cldbid], [$params]);
    }

    public function channelCreate(array $data): Response
    {
        return $this->request("channelcreate", $data);
    }

    public function channelDelete(int $cid): Response
    {
        return $this->request("channeldelete", ["cid" => $cid]);
    }

    public function channelDelPerm(int $cid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
        }
        return $this->request("channeldelperm cid=$cid $permissions");
    }

    public function channelEdit(int $cid, array $data): Response
    {
        $ndata['cid'] = $cid;
		$data = array_merge($ndata, $data);
        return $this->request("channeledit", $data);
    }

    public function channelFind(string $pattern): Response
    {
        return $this->request("channelfind", ["pattern" => $pattern]);
    }

    public function channelGetIconByChannelID(int $channelID): Response
    {
        return $this->request("channelgeticon", ["cid" => $channelID]);
    }

    public function channelGroupAdd(string $name, int $type = 1): Response
    {
        return $this->request("channelgroupadd", ["name" => $name, "type" => $type]);
    }

    public function channelGroupAddClient(int $cgid, int $cid, int $cldbid)
    {
        return $this->request("channelgroupaddclient", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
    }

    public function channelGroupAddPerm(int $cgid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
        }
        return $this->request("channelgroupaddperm cgid=$cgid $permissions");
    }

    public function channelGroupClientList(int $cid = null, int $cldbid = null, int $cgid = null): Response
    {
        return $this->request("channelgroupclientlist", ["cid" => $cid, "cldbid" => $cldbid, "cgid" => $cgid], [], true);
    }

    public function channelGroupCopy(int $scgid, int $tcgid, string $name, int $type = 1): Response
    {
        return $this->request("channelgroupcopy", ["scgid" => $scgid, "tcgid" => $tcgid, "name" => $name, "type" => $type]);
    }

    public function channelGroupDelete(int $cgid, int $force = 1): Response
    {
        return $this->request("channelgroupdel", ["cgid" => $cgid, "force" => $force]);
    }

    public function channelGroupDelPerm(int $cgid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
        }
        return $this->request("channelgroupdelperm cgid=$cgid $permissions");
    }

    public function channelGroupList(): Response
    {
        return $this->request("channelgrouplist");
    }

    public function channelGroupPermList(int $cgid, bool $permsid = false): Response
    {
        $params = $permsid ? "permsid" : "";
        return $this->request("channelgrouppermlist", ["cgid" => $cgid], [$params]);
    }

    public function channelGroupRename(int $cgid, string $name): Response
    {
        return $this->request("channelgrouprename", ["cgid" => $cgid, "name" => $name]);
    }

    public function channelInfo(int $cid): Response
    {
        return $this->request("channelinfo", ["cid" => $cid]);
    }

    public function channelList(array $params = []): Response
    {
        return $this->request("channellist", [], $params);
    }

    public function channelMove(int $cid, int $cpid, int $order = null): Response
    {
        return $this->request("channelmove", ["cid" => $cid, "cpid" => $cpid, "order" => $order]);
    }

    public function channelPermList(int $cid, bool $permsid = false): Response
    {
        $params = $permsid ? "permsid" : "";
        return $this->request("channelpermlist", ["cid" => $cid], [$params]);
    }

    public function channelSetPerm(int $cid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
        }
        return $this->request("channelsetperm cid=$cid $permissions");
    }

    public function complainAdd(int $tcldbid, string $message): Response
    {
        return $this->request("complainadd", ["tcldbid" => $tcldbid, "message" => $message]);
    }

    public function complainDel(int $tcldbid, int $fcldbid): Response
    {
        return $this->request("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
    }

    public function complainList()
    {
        return $this->request("complainlist");
    }

    public function customInfo(string $ident, string $value): Response
    {
        return $this->request("custominfo", ["ident" => $ident, "value" => $value]);
    }

    public function customSearch(string $ident, string $pattern): Response
    {
        return $this->request("customsearch", ["ident" => $ident, "pattern" => $pattern]);
    }

    public function ftCreateDir(string $cid, string $dirname): Response
    {
        return $this->request("ftcreatedir", ["cid" => $cid, "dirname" => $dirname]);
    }

    public function ftDeleteFile(string $cid, string $name): Response
    {
        return $this->request("ftdeletefile", ["cid" => $cid, "cpw" => "", "name" => "/" . $name]);
    }
	
	public function ftGetFileList(string $cid, string $path): Response
	{
		return $this->request("ftgetfilelist", ["cpw" => "", "cid" => $cid, "path" => $path], [], true);
	}

    public function ftGetFileInfo(string $cid, string $name): Response
    {
        return $this->request("ftgetfileinfo", ["cid" => $cid, "name" => $name]);
    }

    public function ftInitDownload(string $cid, string $name): Response
    {
        return $this->request("ftinitdownload", ["cid" => $cid, "name" => $name]);
    }

    public function ftInitUpload(string $cid, string $name, string $cpw = null, int $size = 0, int $overwrite = 1, int $resume = 0): Response
    {
        return $this->request("ftinitupload", ["cid" => $cid, "name" => $name, "cpw" => $cpw, "size" => $size, "overwrite" => $overwrite, "resume" => $resume]);
    }

    public function ftList(string $path): Response
    {
        return $this->request("ftlist", ["path" => $path]);
    }

    public function ftRenameFile(string $cid, string $oldname, string $newname): Response
    {
        return $this->request("ftrenamefile", ["cid" => $cid, "oldname" => $oldname, "newname" => $newname]);
    }

    public function ftStop(int $ftid, int $delete = 0): Response
    {
        return $this->request("ftstop", ["ftid" => $ftid, "delete" => $delete]);
    }

    public function gm(int $cgid, string $msg): Response
    {
        return $this->request("gm", ["cgid" => $cgid, "msg" => $msg]);
    }

    public function hostInfo(): Response
    {
        return $this->request("hostinfo");
    }

    public function instanceEdit(array $data): Response
    {
        return $this->request("instanceedit", $data);
    }

    public function instanceInfo(): Response
    {
        return $this->request("instanceinfo");
    }

    public function logAdd(string $loglevel, string $logmsg): Response
    {
        return $this->request("logadd", ["loglevel" => $loglevel, "logmsg" => $logmsg]);
    }

    public function logView(int $lines = 100, int $reverse = 0, int $instance = 0, int $begin_pos = 0): Response
    {
        return $this->request("logview", ["lines" => $lines, "reverse" => $reverse, "instance" => $instance, "begin_pos" => $begin_pos],[],true);
    }

    public function messageAdd(string $msg, int $targetmode, int $target, string $targetname = null): Response
    {
        return $this->request("messageadd", ["msg" => $msg, "targetmode" => $targetmode, "target" => $target, "targetname" => $targetname]);
    }

    public function messageDel(int $msgid): Response
    {
        return $this->request("messagedel", ["msgid" => $msgid]);
    }

    public function messageGet(int $msgid): Response
    {
        return $this->request("messageget", ["msgid" => $msgid]);
    }

    public function messageList(int $count = 10, int $offset = 0): Response
    {
        return $this->request("messagelist", ["count" => $count, "offset" => $offset]);
    }

    public function messageUpdateFlag(int $msgid, int $flag): Response
    {
        return $this->request("messageupdateflag", ["msgid" => $msgid, "flag" => $flag]);
    }

    public function permFind(string $permsid): Response
    {
        return $this->request("permfind", ["permsid" => $permsid]);
    }

    public function permGet(int $permid): Response
    {
        return $this->request("permget", ["permid" => $permid]);
    }

    public function permList(): Response
    {
        return $this->request("permlist");
    }

    public function permOverview(int $permid): Response
    {
        return $this->request("permoverview", ["permid" => $permid]);
    }

    public function permReset(): Response
    {
        return $this->request("permreset");
    }

    public function sendMessage($targetmode, $target, $msg): Response
    {
        return $this->request("sendtextmessage", ["target" => $target, "targetmode" => $targetmode, "msg" => $msg]);
    }

    public function serverGroupAdd(string $name, int $type = 1): Response
    {
        return $this->request("servergroupadd", ["name" => $name, "type" => $type]);
    }

    public function serverGroupAddClient(int $sgid, int $cldbid): Response
    {
        return $this->request("servergroupaddclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
    }

    public function serverGroupAddPerm(int $sgid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . " permvalue=" . $perm . "|";
        }
        return $this->request("servergroupaddperm", ["sgid" => $sgid, $permissions]);
    }

    public function serverGroupClientList(int $sgid, bool $names = false): Response
    {
        $params = [];
        if($names)
        {
            $params[] = "names";
        }
        return $this->request("servergroupclientlist", ["sgid" => $sgid], $params, true);
    }

    public function serverGroupCopy(int $ssgid, string $name, int $type = 1): Response
    {
        return $this->request("servergroupcopy", ["ssgid" => $ssgid, "tsgid" => 0, "name" => $name, "type" => $type]);
    }

    public function serverGroupDeleteClient(int $sgid, int $cldbid): Response
    {
        return $this->request("servergroupdelclient", ["sgid" => $sgid, "cldbid" => $cldbid]);
    }

    public function serverGroupDelPerm(int $sgid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
        }
        return $this->request("servergroupdelperm", ["sgid" => $sgid, $permissions]);
    }

    public function serverGroupList(): Response
    {
        return $this->request("servergrouplist");
    }

    public function serverGroupPermList(int $sgid, bool $permsid = false): Response
    {
        $params = $permsid ? "permsid" : "";
        return $this->request("servergrouppermlist", ["sgid" => $sgid], [$params]);
    }

    public function serverGroupRename(int $sgid, string $name): Response
    {
        return $this->request("servergrouprename", ["sgid" => $sgid, "name" => $name]);
    }

    public function serverGroupsByClientID(int $cldbid): Response
    {
        return $this->request("servergroupsbyclientid", ["cldbid" => $cldbid]);
    }

    public function clientAddPerm(int $cldbid, array $permissions): Response
    {
        $perms = [];
        foreach ($permissions as $key => $perm) {
            $perms[] = (is_numeric($key) ? 'permid=' : 'permsid=') . $key . " permvalue=" . $perm[0] . " permskip=" . $perm[1];
        }
        return $this->request("clientaddperm cldbid=$cldbid " . implode("|", $perms));
    }

    public function clientDelPerm(int $cldbid, array $permissions): Response
    {
        $perms = [];
        foreach ($permissions as $perm) {
            $perms[] = (is_numeric($perm) ? 'permid=' : 'permsid=') . $perm;
        }
        return $this->request("clientdelperm cldbid=$cldbid " . implode("|", $perms));
    }

    public function clientFind(string $pattern): Response
    {
        return $this->request("clientfind", ["pattern" => $pattern]);
    }

    public function clientGetDBIDFromUID(string $cluid): Response
    {
        return $this->request("clientgetdbidfromuid", ["cluid" => $cluid]);
    }

    public function clientGetNameFromDBID(int $cldbid): Response
    {
        return $this->request("clientgetnamefromdbid", ["cldbid" => $cldbid]);
    }

    public function clientGetNameFromUID(string $cluid): Response
    {
        return $this->request("clientgetnamefromuid", ["cluid" => $cluid]);
    }

    public function clientInfo(int $clid): Response
    {
        return $this->request("clientinfo", ["clid" => $clid]);
    }

    public function clientKick(int $clid, int $reasonid, string $reasonmsg = null): Response
    {
        return $this->request("clientkick", ["clid" => $clid, "reasonid" => $reasonid, "reasonmsg" => $reasonmsg]);
    }


    public function clientMove(int $clid, int $cid, string $cpw = null): Response
    {
        return $this->request("clientmove", ["clid" => $clid, "cid" => $cid, "cpw" => $cpw]);
    }

    public function clientPoke(int $clid, string $msg): Response
    {
        return $this->request("clientpoke", ["clid" => $clid, "msg" => $msg]);
    }

    public function clientSetServerQueryLogin(string $client_login_name): Response
    {
        return $this->request("clientsetserverquerylogin", ["client_login_name" => $client_login_name]);
    }

    public function clientUpdate(array $data): Response
    {
        return $this->request("clientupdate", $data);
    }

    public function complainDelete(int $tcldbid, int $fcldbid): Response
    {
        return $this->request("complaindel", ["tcldbid" => $tcldbid, "fcldbid" => $fcldbid]);
    }

    public function complainDeleteAll(int $tcldbid): Response
    {
        return $this->request("complaindelall", ["tcldbid" => $tcldbid]);
    }


    public function customDelete(int $cldbid, string $ident): Response
    {
        return $this->request("customdelete", ["cldbid" => $cldbid, "ident" => $ident]);
    }

    public function customSet(int $cldbid, string $ident, string $value): Response
    {
        return $this->request("customset", ["cldbid" => $cldbid, "ident" => $ident, "value" => $value]);
    }


    public function logout(): Response
    {
        return $this->request("logout");
    }

    public function serverEdit($data): Response
    {
        return $this->request("serveredit", $data);
    }

    public function serverGroupDelete(int $sgid, int $force = 1): Response
    {
        return $this->request("servergroupdel", ["sgid" => $sgid, "force" => $force]);
    }

    public function serverNotifyUnregister(): Response
    {
        return $this->request("servernotifyunregister");
    }

    public function serverGroupDeletePerm(int $sgid, array $perms): Response
    {
        $permissions = "";
        foreach($perms as $key => $perm)
        {
            $permissions .= is_numeric($key)?'permid':'permsid' . "=" . $key . "|";
        }
        return $this->request("servergroupdelperm", ["sgid" => $sgid, $permissions]);
    }

    public function serverRequestConnectionInfo(): Response
    {
        return $this->request("serverrequestconnectioninfo");
    }

    public function serverSnapshotCreate(): Response
    {
        return $this->request("serversnapshotcreate");
    }

    public function serverSnapshotDeploy(string $snapshot, int $mapping = 0): Response
    {
        return $this->request("serversnapshotdeploy", ["snapshot" => $snapshot, "mapping" => $mapping]);
    }

    public function setClientChannelGroup(int $cgid, int $cid, int $cldbid): Response
    {
        return $this->request("setclientchannelgroup", ["cgid" => $cgid, "cid" => $cid, "cldbid" => $cldbid]);
    }

    public function quit(): void
    {
        $this->request("quit");
        $this->transport->close();
    }
    function __destruct() {
        $this->quit();
    }
}

