<?php

class steamAuthValidate
{
	public static function validateValue($urlSteamVal)
	{
		if($urlSteamVal != '')
		{
			if(ctype_digit($urlSteamVal)) $steamid = $urlSteamVal; 
			else
    		{
        		$vanityObj = curlExecute::getJsonOject(steamWebAPIURLCreater::vanityURL($urlSteamVal))['response'];        		
        		if($vanityObj['success'] == 1) $steamid = $vanityObj['steamid'];
        		elseif($vanityObj['success'] == 42) $steamid = 0;            	
    		}    
		}
		else $steamid = '76561197993960795';

		return $steamid;
	}//validateValue	
}//class



?>