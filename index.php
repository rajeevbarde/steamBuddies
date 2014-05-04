<?php
function MyAutoload($className){
    include_once('classes/'.$className . '.php');
}
spl_autoload_register('MyAutoload');

/* $cookie_flag = (ctype_digit($_COOKIE["steamid"])?true:false);
if($cookie_flag) echo "he yo";
*/

    $psteamid = steamAuthValidate::validateValue(htmlspecialchars($_GET["steamval"]));

    if($psteamid != 0)
    {
        $sp1 = new steamPlayer($psteamid);
        $psteamid = ($sp1->getSteamid() != '')?$psteamid:0;
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
        <div class="middle-left pure-u-1-4">
            <div class="hideThis">                
            </div>
        </div>

        <div class="middle-right pure-u-3-4">
            <div>
                <span>
                	   <?php
                        if($psteamid != 0)
                        {
                        echo "<div sid='".$sp1->getSteamid()."'>";
                        echo "<span class='avatarfull'><img src='".$sp1->getAvatarfull()."' style='background:#".pageEntities::getStatusColor($sp1->getPersonastate(),$sp1->getGameextrainfo())."' ></span><br>";
                        echo "<span class='profileurl'><a href='".$sp1->getProfileurl()."' target='_blank'>".$sp1->getPersonaname()."</a></span><br>";
                        echo "<span class='communityvisibilitystate'>".(($sp1->getCommunityvisibilitystate() == 1)?"Private":"Public")."</span><br>";

                        $realname = (($sp1->getRealname() == '')?"N/A":$sp1->getRealname());
                        echo "<span class='realname'>Name : ".$realname."</span><br>";

                        echo "<span class='timecreated'>Created : ".gmdate("Y-m-d", $sp1->getTimecreated())."</span><br>";

                        $location = (($sp1->getLocstatecode() == '' AND $sp1->getLoccountrycode() == '')?"N/A":$sp1->getLocstatecode().", ".$sp1->getLoccountrycode()); 
                        echo "<span class='location'>From : ".$location."</span><br>";                          

                        $gameplay = (($sp1->getGameextrainfo() == '')?"N/A":$sp1->getGameextrainfo());  
                        echo "<span class='gameextrainfo'>Game Playing : ".$gameplay."</span><br>";

                        echo "<span class='personastate'>Status : ".pageEntities::getStatus($sp1->getPersonastate())."</span><br>";
                        echo "</div>";   
    
                        echo "<br><span class='friendcount'>Friends : ".count($sp1->getFriendIDs())."</span><br>";
                        echo "<span class='friendcount'>Games owned : ".count($sp1->getOwnedGameDetails())."</span><br>";                       
                        }
                        else
                            echo "NOT FOUND";
                       ?>
                </span>
            </div>
        </div>
    </div>  

    
<div class="bottom-section">
<div class="copyright">
            <?= pageEntities::getFooter() ?>    
</div>  
</div> 
</body>
<script type="text/javascript" src="include/misc.js"></script>
</html>
