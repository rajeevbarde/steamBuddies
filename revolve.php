<?php
// First, define your auto-load function.
function MyAutoload($className){
    include_once('classes/'.$className . '.php');
}
 
// Next, register it with PHP.
spl_autoload_register('MyAutoload');

    $psteamid = steamAuthValidate::validateValue(htmlspecialchars($_GET["steamval"]));

    if($psteamid != 0)
    {
        $sp1 = new steamPlayer($psteamid);
        if($sp1->getSteamid() != '')
        	$playerFriendsDetailObj = $sp1->getFriendDetailsBulk();
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
			<div id="informationWindow" class="hideThis">
			<div id="closeWindow"><span><a class="close-button" href="#">close</a></span></div>
			
		<?php	

		if($psteamid != 0)
		{			
			foreach($playerFriendsDetailObj as $valArray)
			{
				echo "<div sid='".$valArray['steamid']."'>";
				echo "<span class='avatarfull'><img src='".$valArray['avatarfull']."' style='background:#".pageEntities::getStatusColor($valArray['personastate'],$valArray['gameextrainfo'])."' ></span><br>";							
				echo "<span class='profileurl'><a href='".$valArray['profileurl']."' target='_blank'>".$valArray['personaname']."</a></span><br>";
				echo "<span class='communityvisibilitystate'>".(($valArray['communityvisibilitystate'] == 1)?"Private":"Public")."</span><br>";

				$realname = (($valArray['realname'] == '')?"N/A":$valArray['realname']);
				echo "<span class='realname'>Name : ".$realname."</span><br>";

				echo "<span class='timecreated'>Created : ".gmdate("Y-m-d", $valArray['timecreated'])."</span><br>";

				$location = (($valArray['locstatecode'] == '' AND $valArray['loccountrycode'] == '')?"N/A":$valArray['locstatecode'].", ".$valArray['loccountrycode']);	
				echo "<span class='location'>From : ".$location."</span><br>";							

				$gameplay = (($valArray['gameextrainfo'] == '')?"N/A":$valArray['gameextrainfo']);	
				echo "<span class='gameextrainfo'>Game Playing : ".$gameplay."</span><br>";

				echo "<span class='personastate'>Status : ".pageEntities::getStatus($valArray['personastate'])."</span><br>";														
				echo "</div>";							
			}	
		}		
				?>
			</div>
		</div>

		<div class="middle-right pure-u-5-5">											
				<div id="galaxy">  					
  					<span id= "me" data-steamid='<?= $sp1->getSteamid() ?>'><a href=#><img src='<?= $sp1->getAvatar() ?>' style='background:#FF0051'></a></span>
						<?php
						if($psteamid != 0)
						{
							$ctr = 1;
							foreach($playerFriendsDetailObj as $val)
							{
								if($val['steamid'] == $psteamid)continue;
								echo "<span id='friend".$ctr++."' data-steamid='".$val['steamid']."' class='revolve'><a href=#><img src='".$val['avatar']."' style='background:#".pageEntities::getStatusColor($val['personastate'],$val['gameextrainfo'])."'></a></span>";	
							}
						}
						else
							echo "NOT FOUND !";
						?>
				</div>			
		</div>	
	</div>

<div class="bottom-section">
<div class="copyright">
   <?= pageEntities::getFooter() ?>              
</div>  
</div> 


</body>


<script type="text/javascript" src="include/steamOrbit.js"></script>
<script type="text/javascript" src="include/misc.js"></script>
<script type="text/javascript">

/* When clicked on Profile Image*/
$("#galaxy span").on("click", function(e){     
          
  $(".middle-left.pure-u-0-5").toggleClass('pure-u-0-5 pure-u-1-5');
  $(".middle-right.pure-u-5-5").toggleClass('pure-u-5-5 pure-u-4-5');
  
  $(".middle-left #informationWindow").removeClass('hideThis');
  $('.middle-left #informationWindow div').addClass('hideThis');
  $('#informationWindow #closeWindow').removeClass('hideThis');

  var sid = $(this).attr("data-steamid"); 
  $("[sid="+sid+"]").removeClass("hideThis");
        
});

/* CLOSE button click*/
$(".middle-left div .close-button").on("click", function(e){ 
      $(".middle-left div").addClass('hideThis');
      $(".middle-left.pure-u-1-5").toggleClass('pure-u-1-5 pure-u-0-5');
      $(".middle-right.pure-u-4-5").toggleClass('pure-u-4-5 pure-u-5-5');
});

</script>
<style>
#sid
{border: 8px solid #000;}
</style>
</html>
