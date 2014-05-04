<?php

	class pageEntities
	{
		private static $siteName='Steam Buddies';

		public static function getSiteName()
		{
			return self::$siteName;
		}

		public static function getSearchProfile()
		{
			//echo "<!--- <a href='#''><img src=include/sits_large_noborder.png></a>  -->";

            echo "<form action='".$_SERVER['PHP_SELF']."' method=get>";
            echo "<input id='steamval' name='steamval' value='steamid / urlname' type=text> &nbsp;<input id= 'submitbutton' type=submit value='go'>";
            echo "</form>";
		}

		public static function getPageMenu()
		{
			echo "<li><a href='index.php'>Home</a></li>";
			echo "<li><a href='revolve.php'>Friends</a></li>";
			echo "<li><a href='ftline.php'>Timeline</a></li>";
			echo "<li><a href='gamelist.php'>Game List</a></li>";
			echo "<li><a href='statsAchieve.php'>Stats & Achievements</a></li>";
			echo "<li><a href='vac.php'>VAC status</a></li>";
		}

		public static function getFooter()
		{
			echo "<div> <span class='logo'>&copy;</span> <a href='http://steamcommunity.com/profiles/76561197993960795' target=_blank'>raj</a> 2014.Powered by <a href='http://steampowered.com/' target='_blank'>Steam</a> </div>";
    		echo "<div>This work is a side project and not intent for large visitors. Please contact - rajeevv67@yahoo.com </div>";
		}

		public static function getStatusColor($state,$ingame)
		{
			if($state == 0) return "333333";
            if($state >= 1 AND $ingame != '') return "4BD02F";
            if($state >= 1) return "00A0F4"; 
		}

		public static function getStatus($state)
		{
			if($state == 0) return "offline";
			if($state == 1) return "online";
			if($state == 2) return "busy";
         	if($state == 3) return "away";
            if($state == 4) return "snooze";
            if($state == 5) return "looking to trade";
            if($state == 6) return "looking to play";    	
		}


	}

?>

