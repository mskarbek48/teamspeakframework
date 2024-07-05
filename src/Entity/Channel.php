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
	
	class Channel
	{
		
		private int $channel_id;
		
		private int $channel_parent_id;
		
		private string $channel_name;
		
		private string $channel_topic;
		
		private string $channel_description;
		
		private int $channel_codec;
		
		private int $channel_codec_quality;
		
		private int $channel_maxclients;
		
		private int $channel_maxfamilyclients;
		
		private int $channel_order;
		
		private bool $channel_flag_permanent;
		
		private bool $channel_flag_semi_permanent;
		
		private bool $channel_flag_default;
		
		private bool $channel_flag_password;
		
		private bool $channel_flag_maxclients_unlimited;
		
		private bool $channel_flag_maxfamilyclients_unlimited;
		
		private bool $channel_flag_maxfamilyclients_inherited;
		
		private string $channel_filepath;

		private int $channel_needed_talk_power;
		
		private bool $channel_forced_silence;
		
		private int $channel_icon_id;
		
		private string $channel_banner_gfx_url;
		
		private string $channel_banner_mode;

		
		
		public function __construct(private Ts3admin $ts, int $channel_id)
		{
			$channel_info = $ts->request("channelinfo", ["cid" => $channel_id])->response();
			$this->channel_id = $channel_id;
			$this->channel_parent_id = $channel_info["pid"];
			$this->channel_name = $channel_info["channel_name"];
			$this->channel_topic = $channel_info["channel_topic"];
			$this->channel_description = $channel_info["channel_description"];
			$this->channel_codec = $channel_info["channel_codec"];
			$this->channel_codec_quality = $channel_info["channel_codec_quality"];
			$this->channel_maxclients = $channel_info["channel_maxclients"];
			$this->channel_maxfamilyclients = $channel_info["channel_maxfamilyclients"];
			$this->channel_order = $channel_info["channel_order"];
			$this->channel_flag_permanent = $channel_info["channel_flag_permanent"];
			$this->channel_flag_semi_permanent = $channel_info["channel_flag_semi_permanent"];
			$this->channel_flag_default = $channel_info["channel_flag_default"];
			$this->channel_flag_password = $channel_info["channel_flag_password"];
			$this->channel_flag_maxclients_unlimited = $channel_info["channel_flag_maxclients_unlimited"];
			$this->channel_flag_maxfamilyclients_unlimited = $channel_info["channel_flag_maxfamilyclients_unlimited"];
			$this->channel_flag_maxfamilyclients_inherited = $channel_info["channel_flag_maxfamilyclients_inherited"];
			$this->channel_filepath = $channel_info["channel_filepath"];
			$this->channel_needed_talk_power = $channel_info["channel_needed_talk_power"];
			$this->channel_forced_silence = $channel_info["channel_forced_silence"];
			$this->channel_icon_id = $channel_info["channel_icon_id"];
			$this->channel_banner_gfx_url = $channel_info["channel_banner_gfx_url"];
			$this->channel_banner_mode = $channel_info["channel_banner_mode"];
		}
		
		public function getId(): int
		{
			return $this->channel_id;
		}
		
		public function getParentId(): int
		{
			return $this->channel_parent_id;
		}
		
		public function getName(): string
		{
			return $this->channel_name;
		}
		
		public function getTopic(): string
		{
			return $this->channel_topic;
		}
		
		public function getDescription(): string
		{
			return $this->channel_description;
		}
		
		public function getCodec(): int
		{
			return $this->channel_codec;
		}
		
		public function getCodecQuality(): int
		{
			return $this->channel_codec_quality;
		}
		
		public function getMaxClients(): int
		{
			return $this->channel_maxclients;
		}
		
		public function getMaxFamilyClients(): int
		{
			return $this->channel_maxfamilyclients;
		}
		
		public function getOrder(): int
		{
			return $this->channel_order;
		}
		
		public function isPermanent(): bool
		{
			return $this->channel_flag_permanent;
		}
		
		public function isSemiPermanent(): bool
		{
			return $this->channel_flag_semi_permanent;
		}
		
		public function isDefault(): bool
		{
			return $this->channel_flag_default;
		}
		
		public function isPasswordProtected(): bool
		{
			return $this->channel_flag_password;
		}
		
		public function isMaxClientsUnlimited(): bool
		{
			return $this->channel_flag_maxclients_unlimited;
		}
		
		public function isMaxFamilyClientsUnlimited(): bool
		{
			return $this->channel_flag_maxfamilyclients_unlimited;
		}
		
		public function isMaxFamilyClientsInherited(): bool
		{
			return $this->channel_flag_maxfamilyclients_inherited;
		}
		
		public function getFilepath(): string
		{
			return $this->channel_filepath;
		}
		
		public function getNeededTalkPower(): int
		{
			return $this->channel_needed_talk_power;
		}
		
		public function isForcedSilence(): bool
		{
			return $this->channel_forced_silence;
		}
		
		public function getIconId(): int
		{
			return $this->channel_icon_id;
		}
		
		public function getBannerGfxUrl(): string
		{
			return $this->channel_banner_gfx_url;
		}
		
		public function getBannerMode(): string
		{
			return $this->channel_banner_mode;
		}
		
		public function getBannerUrl(): string
		{
			return $this->channel_banner_url;
		}
		
		
	}