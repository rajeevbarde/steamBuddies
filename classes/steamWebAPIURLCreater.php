<?php
class steamWebAPIURLCreater
{
	private static $siteKey = 'xxxxxxxxxxxxxxxxxxxxx';
	public static function playersSummary($_steamid)
	{		 
		return "http://api.steampowered.com/ISteamUser/GetPlayerSummaries/v0002/?key=".self::$siteKey."&steamids=".$_steamid;
	}

	public static function playersFriendList($_steamid)
	{		 
		return "http://api.steampowered.com/ISteamUser/GetFriendList/v0001/?key=".self::$siteKey."&steamid=".$_steamid."&relationship=friend";
	}

	public static function playersGameList($_steamid)
	{		 
		return "http://api.steampowered.com/IPlayerService/GetOwnedGames/v0001/?key=".self::$siteKey."&include_played_free_games=1&include_appinfo=1&steamid=".$_steamid;
	}
	
	public static function schemaByGame($_appid)
	{		 
		return "http://api.steampowered.com/ISteamUserStats/GetSchemaForGame/v0002/?key=".self::$siteKey."&appid=".$_appid;
	}

	
	public static function globalPlayersCountByGame($_appid)
	{		 
		return "http://api.steampowered.com/ISteamUserStats/GetNumberOfCurrentPlayers/v0001/?appid=".$_appid;
	}

	public static function globalAchievementByGame($_gameid)
	{		 
		return "http://api.steampowered.com/ISteamUserStats/GetGlobalAchievementPercentagesForApp/v0002/?gameid=".$_gameid;
	}

	public static function statAchievementByUserGame($_steamid,$_appid)
	{		 
		return "http://api.steampowered.com/ISteamUserStats/GetUserStatsForGame/v0002/?appid=".$_appid."&steamid=".$_steamid."&key=".self::$siteKey;
	}

	public static function vacStatus($_steamids)
	{		 
		return "http://api.steampowered.com/ISteamUser/GetPlayerBans/v0001/?steamids=".$_steamids."&key=".self::$siteKey;

	}

	public static function vanityURL($_steamname)
	{		 
		return "http://api.steampowered.com/ISteamUser/ResolveVanityURL/v0001/?key=".self::$siteKey."&vanityurl=".$_steamname;		
	}


}//class

?>