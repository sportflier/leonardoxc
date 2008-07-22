<? 
/************************************************************************/
/* Leonardo: Gliding XC Server					                        */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2004-5 by Andreadakis Manolis                          */
/* http://sourceforge.net/projects/leonardoserver                       */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

 	require_once dirname(__FILE__)."/EXT_config_pre.php";
	require_once "config.php";
 	require_once "EXT_config.php";

	require_once "CL_flightData.php";
	require_once "FN_functions.php";	
	require_once "FN_UTM.php";
	require_once "FN_waypoint.php";	
	require_once "FN_output.php";
	require_once "FN_pilot.php";
	require_once "FN_flight.php";
	require_once $moduleRelPath."/templates/".$PREFS->themeName."/theme.php";
	setDEBUGfromGET();

	
	if ( !auth::isAdmin($userID) ) { echo "go away"; return; }

	$op=makeSane($_GET['op']);	

	if ($op=='deleteTakeoffs'){	
		 $toDeleteStr=$_GET['takeoffs'];
		 $toDeleteList=split('_',$toDeleteStr);

		 //echo "list is :";
		 //print_r($toDeleteList); 
		 
		 foreach($toDeleteList as $waypointIDdelete) {
			$waypt=new waypoint($waypointIDdelete);
			$waypt->getFromDB();
			if ( $waypt->delete() ) {
				echo "Takeoff #$waypointIDdelete deleted<BR>";
			} else {
				echo "Takeoff #$waypointIDdelete PROBLEM<BR>";
			}
			
		}
		
	}  if ($op=='getTakeoffInfo'){	
	
	}
	

?>