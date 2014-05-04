<?php

	class steamStatsAchievement
	{
		private $steamid;
		private $appid;
		private $userStats;
		private $userAchievements;
		private $userOtherAchievementsList;

		private $Scout;
		private $Sniper;
		private $Pyro;
		private $Soldier;
		private $Engineer;
		private $Medic;
		private $Heavy;
		private $Demoman;
		private $Spy;
		private $Map;
		private $TF2classArr;

		public function __Construct($_steamid,$_appid)
		{
			$this->steamid = $_steamid;
			$this->appid = $_appid;
			$this->TF2classArr = array("scout", "sniper", "pyro", "soldier","engineer","medic","heavy","demoman","spy");

			$_statsAchieveObj = curlExecute::getJsonOject(steamWebAPIURLCreater::statAchievementByUserGame($_steamid,$_appid));
			$this->setUserStats($_statsAchieveObj["playerstats"]["stats"]);
			$this->setUserAchievements($_statsAchieveObj["playerstats"]["achievements"]);
			$this->splitStats();
			$this->splitAchievements();
		}				

		public function getUserStats()
		{
			return $this->userStats;
		}

		public function setUserStats($_data)
		{
			$this->userStats = $_data;
		}

		public function getUserAchievements()
		{
			return $this->userAchievements;
		}

		public function setUserAchievements($_data)
		{
			$this->userAchievements = $_data;
		}

		public function getGlobalAchievmentByPer()
		{
			return curlExecute::getJsonOject(steamWebAPIURLCreater::globalAchievementByGame($this->appid));
		}

		public function getGlobalSchemaStats()
		{
			return curlExecute::getJsonOject(steamWebAPIURLCreater::schemaByGame($this->appid))["game"]["availableGameStats"]["stats"];			 
		}

		public function getGlobalSchemaAchievements()
		{
			return curlExecute::getJsonOject(steamWebAPIURLCreater::schemaByGame($this->appid))["game"]["availableGameStats"]["achievements"];			 
		}

		public function splitStats()
		{
			$_userStats = $this->userStats;			
			
			foreach($_userStats as $stat)				
			{	
				$statname = $stat["name"];
				$statvalue = $stat["value"];

				if(stristr($statname,"TF_") !== false) continue;
										
				if(in_array($this->splitData($statname,'.')[0], array_map('ucfirst', $this->TF2classArr)))
				{
					$this->addTF2ClassStats($statname,$statvalue);
				}
				else
				{
					$statNameArr = $this->splitData($statname,'.');
					$mapname = $statNameArr[0];					
					$tf2statname = $statNameArr[2];
					$this->Map[$tf2statname][$mapname] = $statvalue;
				} 

			}  //foreach					
		}//splitStats

		public function addTF2ClassStats($_statName,$_statVal)
		{
			$statNameArr = $this->splitData($_statName,'.');
			$tf2class = ucfirst($statNameArr[0]);
			$tf2stattype = $statNameArr[1];
			

			if($tf2stattype == "mvm")
			{
				$tf2stattype = $statNameArr[2];
				$tf2statname = $statNameArr[3];
				if(stristr($_statName,$tf2class.".mvm") !== false)
				{					
					$this->{$tf2class}["stats"]["mvm"][$tf2stattype][substr($tf2statname, 1)] = $_statVal;
				}
			}

			elseif(stristr($_statName,$tf2class.".".$tf2stattype) !== false)
			{			
				$tf2statname = $statNameArr[2];
				$this->{$tf2class}["stats"][$tf2stattype][substr($tf2statname, 1)] = $_statVal;
			}		
		}

		public function splitAchievements()
		{
			$_userAchievements = $this->userAchievements;			
			$ctr = 0;
			foreach($_userAchievements as $achievement)
			{

				$achievementName = $achievement['name'];
				$achieved = $achievement['achieved'];
				$tf2class = $this->splitData($achievementName,'_')[1];
				
				if(in_array($tf2class, array_map('strtoupper',$this->TF2classArr) ))
				{					
					$tf2class = ucfirst(strtolower($tf2class));
					$this->{$tf2class}["achievements"][$achievementName] = $achieved;
				}
				else
				{
					$this->{$tf2class}["achievements"][$achievementName] = $achieved;

					if(in_array($tf2class,$this->userOtherAchievementsList)) continue;
					else $this->userOtherAchievementsList[$ctr++] = $tf2class;
				}

			}//foreach 
		}//splitAchievements

		public function getAchievementName($_achievementArr)
		{
			$AchName = null;
			$ctr = 0;
			foreach($_achievementArr as $piece)
			{
				if($ctr++ < 2) continue;
				$AchName = $AchName."_".$piece;
			}

			//$AchName = substr($AchName, 0, strlen($AchName) - 1);
			return $AchName;
		}

		public function getScoutStats()
		{
			return $this->Scout["stats"];
		}

		public function getScoutAchievements()
		{
			return $this->Scout["achievements"];
		}		

		public function getSniperStats()
		{
			return $this->Sniper["stats"];
		}

		public function getSniperAchievements()
		{
			return $this->Sniper["achievements"];
		}

		public function getPyroStats()
		{
			return $this->Pyro["stats"];
		}

		public function getPyroAchievements()
		{
			return $this->Pyro["achievements"];
		}

		public function getSoldierStats()
		{
			return $this->Soldier["stats"];
		}

		public function getSoldierAchievements()
		{
			return $this->Soldier["achievements"];
		}

		public function getEngineerStats()
		{
			return $this->Engineer["stats"];
		}

		public function getEngineerAchievements()
		{
			return $this->Engineer["achievements"];
		}

		public function getMedicStats()
		{
			return $this->Medic["stats"];
		}

		public function getMedicAchievements()
		{
			return $this->Medic["achievements"];
		}

		public function getHeavyStats()
		{
			return $this->Heavy["stats"];
		}

		public function getHeavyAchievements()
		{
			return $this->Heavy["achievements"];
		}

		public function getDemomanStats()
		{
			return $this->Demoman["stats"];
		}

		public function getDemomanAchievements()
		{
			return $this->Demoman["achievements"];
		}

		public function getSpyStats()
		{
			return $this->Spy["stats"];
		}

		public function getSpyAchievements()
		{
			return $this->Spy["achievements"];
		}

		public function getMapStats()
		{
			return $this->Map;
		}

		private function splitData($_data,$sep)
		{
			$data = explode($sep,$_data);
			return $data;
		}

		public function getTF2classArr()
		{
			return $this->TF2classArr;
		}

		public function getUserOtherAchievementsList()
		{
			return $this->userOtherAchievementsList;
		}



	}//class

?>