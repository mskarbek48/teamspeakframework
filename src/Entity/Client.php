<?php
	/**
	 * This file is a part of teamspeakframework
	 *
	 * @author Maciej Skarbek <macieqskarbek@gmail.com>
	 * @copyright (c) 2024 Maciej Skarbek
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 *
	 * @created at 05.07.2024 16:31
	 * @updated at 05.07.2024 16:31
	 *
	 * @license https://opensource.org/licenses/gpl-license.php GNU Public License
	 **/
	
	namespace mskarbek48\TeamspeakFramework\Entity;
	
	use mskarbek48\TeamspeakFramework\Ts3admin;
	
	class Client
	{
		private int $channel_id;
		
		private int $client_idle_time;
		
		private string $client_uid;
		
		private string $client_nickname;
		
		private string $client_version;
		
		private string $client_platform;
		
		private bool $client_input_muted;
		
		private bool $client_output_muted;
		
		private bool $client_outputonly_muted;
		
		private bool $client_input_hardware;
		
		private bool $client_output_hardware;
		
		private string $client_meta_data;
		
		private bool $client_is_recording;
		
		private string $client_version_sign;
		
		private string $client_security_hash;
		
		private string $client_login_name;
		
		private int $client_database_id;
		
		private int $client_channel_group_id;
		
		private array $client_server_groups;
		
		private int $client_created;
		
		private int $client_lastconnected;
		
		private int $client_totalconnections;
		
		private bool $client_away;
		
		private string $client_away_message;
		
		private int $client_type;
		
		private bool $client_flag_avatar;
		
		private int $client_talk_power;
		
		private bool $client_talk_request;
		
		private bool $client_talk_request_msg;
		
		private string $client_description;
		
		private int $client_is_talker;
		
		private int $client_month_bytes_uploaded;
		
		private int $client_month_bytes_downloaded;
		
		private int $client_total_bytes_uploaded;
		
		private int $client_total_bytes_downloaded;
		
		private bool $client_is_priority_speaker;
		
		private int $client_icon_id;
		
		private bool $client_is_channel_commander;
		
		private string $client_country;
		
		private int $client_channel_group_inherited_channel_id;
		
		private string $client_badges;
		
		private string $client_myteamspeak_id;
		
		private bool $client_integrations;
		
		private string $client_myteamspeak_avatar;
		
		private string $client_signed_badges;
		
		private string $client_base64_hash_client_uid;
		
		private string $connection_client_ip;
		
		
		
		public function __construct(private Ts3admin $ts, int $client_id)
		{
			$client_info = $ts->request("clientinfo", ["clid" => $client_id])->response();
			
			$this->channel_id = $client_info['cid'];
			$this->client_idle_time = $client_info['client_idle_time'];
			$this->client_uid = $client_info['client_unique_identifier'];
			$this->client_nickname = $client_info['client_nickname'];
			$this->client_version = $client_info['client_version'];
			$this->client_platform = $client_info['client_platform'];
			$this->client_input_muted = $client_info['client_input_muted'];
			$this->client_output_muted = $client_info['client_output_muted'];
			$this->client_outputonly_muted = $client_info['client_outputonly_muted'];
			$this->client_input_hardware = $client_info['client_input_hardware'];
			$this->client_output_hardware = $client_info['client_output_hardware'];
			$this->client_meta_data = $client_info['client_meta_data'];
			$this->client_is_recording = $client_info['client_is_recording'];
			$this->client_version_sign = $client_info['client_version_sign'];
			$this->client_security_hash = $client_info['client_security_hash'];
			$this->client_login_name = $client_info['client_login_name'];
			$this->client_database_id = $client_info['client_database_id'];
			$this->client_channel_group_id = $client_info['client_channel_group_id'];
			$this->client_server_groups = explode(",", $client_info['client_servergroups']);
			$this->client_created = $client_info['client_created'];
			$this->client_lastconnected = $client_info['client_lastconnected'];
			$this->client_totalconnections = $client_info['client_totalconnections'];
			$this->client_away = $client_info['client_away'];
			$this->client_away_message = $client_info['client_away_message'];
			$this->client_type = $client_info['client_type'];
			$this->client_flag_avatar = $client_info['client_flag_avatar'];
			$this->client_talk_power = $client_info['client_talk_power'];
			$this->client_talk_request = $client_info['client_talk_request'];
			$this->client_talk_request_msg = $client_info['client_talk_request_msg'];
			$this->client_description = $client_info['client_description'];
			$this->client_is_talker = $client_info['client_is_talker'];
			$this->client_month_bytes_uploaded = $client_info['client_month_bytes_uploaded'];
			$this->client_month_bytes_downloaded = $client_info['client_month_bytes_downloaded'];
			$this->client_total_bytes_uploaded = $client_info['client_total_bytes_uploaded'];
			$this->client_total_bytes_downloaded = $client_info['client_total_bytes_downloaded'];
			$this->client_is_priority_speaker = $client_info['client_is_priority_speaker'];
			$this->client_icon_id = $client_info['client_icon_id'];
			$this->client_is_channel_commander = $client_info['client_is_channel_commander'];
			$this->client_country = $client_info['client_country'];
			$this->client_channel_group_inherited_channel_id = $client_info['client_channel_group_inherited_channel_id'];
			$this->client_badges = $client_info['client_badges'];
			$this->client_myteamspeak_id = $client_info['client_myteamspeak_id'];
			$this->client_integrations = $client_info['client_integrations'];
			$this->client_myteamspeak_avatar = $client_info['client_myteamspeak_avatar'];
			$this->client_signed_badges = $client_info['client_signed_badges'];
			$this->client_base64_hash_client_uid = $client_info['client_base64HashClientUID'];
			$this->connection_client_ip = $client_info['connection_client_ip'];
		}
		
		public function getChannelId(): int
		{
			return $this->channel_id;
		}
		
		public function getClientIdleTime(): int
		{
			return $this->client_idle_time;
		}
		
		public function getClientUid(): string
		{
			return $this->client_uid;
		}
		
		public function getClientNickname(): string
		{
			return $this->client_nickname;
		}
		
		public function getClientVersion(): string
		{
			return $this->client_version;
		}
		
		public function getClientPlatform(): string
		{
			return $this->client_platform;
		}
		
		public function isClientInputMuted(): bool
		{
			return $this->client_input_muted;
		}
		
		public function isClientOutputMuted(): bool
		{
			return $this->client_output_muted;
		}
		
		public function isClientOutputonlyMuted(): bool
		{
			return $this->client_outputonly_muted;
		}
		
		public function isClientInputHardware(): bool
		{
			return $this->client_input_hardware;
		}
		
		public function isClientOutputHardware(): bool
		{
			return $this->client_output_hardware;
		}
		
		public function getClientMetaData(): string
		{
			return $this->client_meta_data;
		}
		
		public function isClientIsRecording(): bool
		{
			return $this->client_is_recording;
		}
		
		public function getClientVersionSign(): string
		{
			return $this->client_version_sign;
		}
		
		public function getClientSecurityHash(): string
		{
			return $this->client_security_hash;
		}
		
		public function getClientLoginName(): string
		{
			return $this->client_login_name;
		}
		
		public function getClientDatabaseId(): int
		{
			return $this->client_database_id;
		}
		
		public function getClientChannelGroupId(): int
		{
			return $this->client_channel_group_id;
		}
		
		public function getClientServerGroups(): array
		{
			return $this->client_server_groups;
		}
		
		public function getClientCreated(): int
		{
			return $this->client_created;
		}
		
		public function getClientLastconnected(): int
		{
			return $this->client_lastconnected;
		}
		
		public function getClientTotalconnections(): int
		{
			return $this->client_totalconnections;
		}
		
		public function isClientAway(): bool
		{
			return $this->client_away;
		}
		
		public function getClientAwayMessage(): string
		{
			return $this->client_away_message;
		}
		
		public function getClientType(): int
		{
			return $this->client_type;
		}
		
		public function isClientFlagAvatar(): bool
		{
			return $this->client_flag_avatar;
		}
		
		public function getClientTalkPower(): int
		{
			return $this->client_talk_power;
		}
		
		public function isClientTalkRequest(): bool
		{
			return $this->client_talk_request;
		}
		
		public function isClientTalkRequestMsg(): bool
		{
			return $this->client_talk_request_msg;
		}
		
		public function getClientDescription(): string
		{
			return $this->client_description;
		}
		
		public function getClientIsTalker(): int
		{
			return $this->client_is_talker;
		}
		
		public function getClientMonthBytesUploaded(): int
		{
			return $this->client_month_bytes_uploaded;
		}
		
		public function getClientMonthBytesDownloaded(): int
		{
			return $this->client_month_bytes_downloaded;
		}
		
		public function getClientTotalBytesUploaded(): int
		{
			return $this->client_total_bytes_uploaded;
		}
		
		public function getClientTotalBytesDownloaded(): int
		{
			return $this->client_total_bytes_downloaded;
		}
		
		public function isClientIsPrioritySpeaker(): bool
		{
			return $this->client_is_priority_speaker;
		}
		
		public function getClientIconId(): int
		{
			return $this->client_icon_id;
		}
		
		public function isClientIsChannelCommander(): bool
		{
			return $this->client_is_channel_commander;
		}
		
		public function getClientCountry(): string
		{
			return $this->client_country;
		}
		
		public function getClientChannelGroupInheritedChannelId(): int
		{
			return $this->client_channel_group_inherited_channel_id;
		}
		
		public function getClientBadges(): string
		{
			return $this->client_badges;
		}
		
		public function getClientMyteamspeakId(): string
		{
			return $this->client_myteamspeak_id;
		}
		
		public function isClientIntegrations(): bool
		{
			return $this->client_integrations;
		}
		
		public function getClientMyteamspeakAvatar(): string
		{
			return $this->client_myteamspeak_avatar;
		}
		
		public function getClientSignedBadges(): string
		{
			return $this->client_signed_badges;
		}
		
		public function getClientBase64HashClientUid(): string
		{
			return $this->client_base64_hash_client_uid;
		}
		
		public function getConnectionClientIp(): string
		{
			return $this->connection_client_ip;
		}


	}