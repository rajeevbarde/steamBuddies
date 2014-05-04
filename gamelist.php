<?php
function MyAutoload($className){
    include_once('classes/'.$className . '.php');
}

spl_autoload_register('MyAutoload'); 

    $psteamid = steamAuthValidate::validateValue(htmlspecialchars($_GET["steamval"]));

    if($psteamid != 0)
    {
        $sp1 = new steamPlayer($psteamid);
        if($sp1->getSteamid() != '')
        	$playerGameObj = $sp1->getOwnedGameDetails();
        else
			$psteamid=0; 
    }
?>

<!DOCTYPE html>
<head>
  <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
  <link rel="stylesheet" href="http://yui.yahooapis.com/pure/0.4.2/pure-min.css">
  <link rel="stylesheet" href="include/style.css">

</head>

<body>

	<div class="top-section">
		<div class="logo">
			<span><?= pageEntities::getSiteName() ?></span> 
		</div>

		<div class="login-section">
            <?= pageEntities::getSearchProfile() ?>
        </div>  				

		<div class="home-menu pure-menu-open pure-menu pure-menu-open pure-menu-horizontal">
			<ul>
				<?= pageEntities::getPageMenu() ?>
			</ul>
		</div>
	</div>	

<div class="middle-section pure-g-r">
		<div class="middle-left pure-u-0-5">
			
			</div>		

		<div class="middle-right pure-u-5-5">
			
				
				
				<?php	
				if($psteamid != 0)
    			{				    		
    				
    				echo "<div class='gamecount'><span>".Count($playerGameObj)." games</span></div>";
					usort($playerGameObj, 'sortByOrder');
					function sortByOrder($a, $b) {
    					return strcmp($a['name'],$b['name']);
					}

					$ctr = 0;
					$colsize = ceil(sqrt(count($playerGameObj)));
					echo "<table style='width:100%'>";
				foreach($playerGameObj as $val)
					{	
						$timeplayed =$val['playtime_forever'];
						$hours = (int)($timeplayed / 60);
						$min = $timeplayed - ($hours * 60);

						if($ctr == 0) echo "<tr>";
						echo "<td>";						
						//$playerCount = curlExecute::getJsonOject(steamWebAPIURLCreater::getGlobalPlayersCountByGame($val['appid']));
						//echo $playerCount["response"]["player_count"];
						
					 	echo "<div class='gamebox'>";
						echo "<span class='gameimage'><img src='http://media.steampowered.com/steamcommunity/public/images/apps/".$val['appid']."/".$val['img_logo_url'].".jpg'></span>";
						echo "<span class='tooltip gamedata'><img src='http://media.steampowered.com/steamcommunity/public/images/apps/".$val['appid']."/".$val['img_icon_url'].".jpg'><br>";
						echo $val['name']."<br>";						
						echo "time - ".$hours."H ".$min."M</span>";
					 	echo "</div>";	

					/*	echo $val['appid'];								
						echo "hours".$hr."$min".$min;						
						echo "<img src='http://media.steampowered.com/steamcommunity/public/images/apps/".$val['appid']."/".$val['img_icon_url'].".jpg'>";
						echo "<br>";*/

						$ctr = $ctr + 1;
						if($ctr == $colsize) $ctr=0;
					}	
					echo "</table>";
				}
				else
					echo "NOT FOUND !";
				?>
			
		</div>	
	</div>

<div class="bottom-section">
<div class="copyright">
<?= pageEntities::getFooter() ?>     
</div>  
</div> 

</body>
<style>
.gameimage img{
border-radius:10px;	
}

.tooltip {
    position:absolute;
    display:none;
    z-index:1000;
    background-color:#3D3D3D;
    color:white;    
    border-radius: 10px;
    padding: 5px 5px;
}

</style>
<script type="text/javascript" src="include/misc.js"></script>
<script type="text/javascript">

$(".gamebox").bind("mousemove", function(event) {
    $(this).find("span.tooltip").css({
        top: event.pageY + 5 + "px",
        left: event.pageX + 5 + "px"
    }).show();
}).bind("mouseout", function() {
    $("span.tooltip").hide();
});

$(".gameimage").hover(function() {
        $(this).animate({opacity: 0.3}, 33);
    }, function() {
        $(this).animate({opacity: 1}, 33);
    });
</script>
</html>
