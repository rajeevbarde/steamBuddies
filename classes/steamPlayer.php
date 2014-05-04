<?php

	class steamPlayer
	{
		private $steamid;
		private $communityvisibilitystate;
		private $profilestate;
		private $personaname;
		private $lastlogoff;
		private $commentpermission;
		private $profileurl;
		private $avatar;
		private $avatarmedium;
		private $avatarfull;
		private $personastate;
		private $primaryclanid;
		private $timecreated;
		private $personastateflags;
		private $loccountrycode;
		private $locstatecode;
		private $loccityid;
		private $gameextrainfo;
		private $friendIDs;
		private $friendRelationObject;
		private $realname;

		public function __Construct($_steamid)
		{			
			$_playersInformation = curlExecute::getJsonOject(steamWebAPIURLCreater::playersSummary($_steamid))["response"]["players"][0];					
			$this->setSteamid($_playersInformation["steamid"]);
			$this->setCommunityvisibilitystate($_playersInformation["communityvisibilitystate"]);
			$this->setProfilestate($_playersInformation["profilestate"]);
			$this->setPersonaname($_playersInformation["personaname"]);
			$this->setLastlogoff($_playersInformation["lastlogoff"]);
			$this->setCommentpermission($_playersInformation["commentpermission"]);
			$this->setProfileurl($_playersInformation["profileurl"]);
			$this->setAvatar($_playersInformation["avatar"]);
			$this->setAvatarmedium($_playersInformation["avatarmedium"]);
			$this->setAvatarfull($_playersInformation["avatarfull"]);
			$this->setPersonastate($_playersInformation["personastate"]);
			$this->setPrimaryclanid($_playersInformation["primaryclanid"]);
			$this->setTimecreated($_playersInformation["timecreated"]);
			$this->setPersonastateflags($_playersInformation["personastateflags"]);
			$this->setLoccountrycode($_playersInformation["loccountrycode"]);
			$this->setLocstatecode($_playersInformation["locstatecode"]);
			$this->setLoccityid($_playersInformation["loccityid"]);
			$this->setGameextrainfo($_playersInformation["gameextrainfo"]);
			$this->setRealname($_playersInformation["realname"]);

			$this->setFriendRelationObject(curlExecute::getJsonOject(steamWebAPIURLCreater::playersFriendList($_steamid))["friendslist"]["friends"]);
			$this->setFriendIDs($this->getFriendRelationObject());
		}

		public function extractFriendList($jsonOject)
		{
			$_friendslist = array();
			$cntr = 0;
			foreach($jsonOject as $item)
			{					
				$_friendslist[$cntr] = $item["steamid"];
				$cntr++;
			}
			return $_friendslist;
		}

		public function getOwnedGameDetails()
		{
			return curlExecute::getJsonOject(steamWebAPIURLCreater::playersGameList($this->steamid))["response"]["games"];
		}

		public function getFriendDetailsBulk()
		{
			$playerFriendIDsCSV = implode(",",$this->getFriendIDs());
			$playerFriendIDsCSV = $playerFriendIDsCSV.",".$this->getSteamid();
			return curlExecute::getJsonOject(steamWebAPIURLCreater::playersSummary($playerFriendIDsCSV))["response"]["players"];			
		}
		
		public function getSteamid()
		{			
			return $this->steamid;
		}

		public function setSteamid($_data)
		{			
			$this->steamid = $_data;
		}	

		public function getCommunityvisibilitystate()
		{			
			return $this->communityvisibilitystate;
		}

		public function setCommunityvisibilitystate($_data)
		{			
			$this->communityvisibilitystate = $_data;
		}

		public function getProfilestate()
		{			
			return $this->profilestate;
		}

		public function setProfilestate($_data)
		{			
			$this->profilestate = $_data;
		}

		public function getPersonaname()
		{			
			return $this->personaname;
		}

		public function setPersonaname($_data)
		{			
			$this->personaname = $_data;
		}

		public function getLastlogoff()
		{			
			return $this->lastlogoff;
		}

		public function setLastlogoff($_data)
		{			
			$this->lastlogoff = $_data;
		}

		public function getCommentpermission()
		{			
			return $this->commentpermission;
		}

		public function setCommentpermission($_data)
		{			
			$this->commentpermission = $_data;
		}

		public function getProfileurl()
		{			
			return $this->profileurl;
		}

		public function setProfileurl($_data)
		{			
			$this->profileurl = $_data;
		}

		public function getAvatar()
		{			
			return $this->avatar;
		}

		public function setAvatar($_data)
		{			
			$this->avatar = $_data;
		}

		public function getAvatarmedium()
		{			
			return $this->avatarmedium;
		}

		public function setAvatarmedium($_data)
		{			
			$this->avatarmedium = $_data;
		}

		public function getAvatarfull()
		{			
			return $this->avatarfull;
		}

		public function setAvatarfull($_data)
		{			
			$this->avatarfull = $_data;
		}

		public function getPersonastate()
		{			
			return $this->personastate;
		}

		public function setPersonastate($_data)
		{			
			$this->personastate = $_data;
		}

		public function getPrimaryclanid()
		{			
			return $this->primaryclanid;
		}

		public function setPrimaryclanid($_data)
		{			
			$this->primaryclanid = $_data;
		}

		public function getTimecreated()
		{			
			return $this->timecreated;
		}

		public function setTimecreated($_data)
		{			
			$this->timecreated = $_data;
		}

		public function getPersonastateflags()
		{			
			return $this->personastateflags;
		}

		public function setPersonastateflags($_data)
		{			
			$this->personastateflags = $_data;
		}

		public function getLoccountrycode()
		{			
			return $this->loccountrycode;
		}

		public function setLoccountrycode($_data)
		{			
			$this->loccountrycode = $_data;
		}

		public function getLocstatecode()
		{			
			return $this->locstatecode;
		}

		public function setLocstatecode($_data)
		{			
			$this->locstatecode = $_data;
		}

		public function getLoccityid()
		{			
			return $this->loccityid;
		}

		public function setLoccityid($_data)
		{			
			$this->loccityid = $_data;
		}

		public function getFriendIDs()
		{			
			return $this->friendIDs;
		}

		public function setFriendIDs($_data)
		{						
			$this->friendIDs = $this->extractFriendList($_data);
		}		

		public function getFriendRelationObject()
		{			
			return $this->friendRelationObject;
		}

		public function setFriendRelationObject($_data)
		{			
			$this->friendRelationObject = $_data;
		}

		public function getGameextrainfo()
		{			
			return $this->gameextrainfo;
		}

		public function setGameextrainfo($_data)
		{			
			$this->gameextrainfo = $_data;
		}

		public function getRealname()
		{			
			return $this->realname;
		}

		public function setRealname($_data)
		{			
			$this->realname = $_data;
		}


	
	}//class
?>