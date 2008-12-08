<?
/************************************************************************/
/* Leonardo: Gliding XC Server					                        */
/* ============================================                         */
/*                                                                      */
/* Copyright (c) 2004-5 by Andreadakis Manolis                          */
/* http://leonardo.thenet.gr                                            */
/* http://sourceforge.net/projects/leonardoserver                       */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/

// Specific settigns for standalone operation ($opMode=3)

// Path settings
$CONF['path']['direct_call']=0;

function moduleRelPath($forUtilityFiles=0){
	global $module_name;
	if ($forUtilityFiles) // for EXT_ files
		return "./";
	else 
		return "components/$module_name";
}

$moduleRelPath=moduleRelPath($isExternalFile);

// bridge to the users table of different forum/portal/cms systems
$CONF['userdb']['users_table']='jos_users';
$CONF['userdb']['user_id_field']='id';
$CONF['userdb']['username_field']='username';
$CONF['userdb']['password_field']='password';

$CONF['userdb']['use_leonardo_real_names']=1;

// if  $CONF['userdb']['use_leonardo_real_names']=0;
// then the following will be used to extract real names from the 'aplication' DB
$CONF['userdb']['has_realnames']=1;
$CONF['userdb']['user_real_name_field']='name';

$CONF['userdb']['has_seperate_last_first_name']=0;
$CONF['userdb']['user_last_name_field']='';
$CONF['userdb']['user_first_name_field']='';


// bridge to the login system of different forum/portal/cms systems
$CONF['bridge']['login_url']="/index.php?option=com_frontpage";
$CONF['bridge']['logout_url']="/index.php?option=com_frontpage";
$CONF['bridge']['register_url']="/index.php?option=com_registration&task=register";
// $CONF['bridge']['register_url']="profile.php?mode=register";
$CONF['bridge']['forgot_password_url']='';
$CONF['bridge']['edit_profile_url']='';



// various settings that depend on $opMode !
$CONF_mainfile="index.php";
$CONF_arg_name="option";

function setModuleArg() {
	global $CONF_arg_name,$module_name;
	define('CONF_MODULE_ARG',"?$CONF_arg_name=$module_name");
}


// other settings that are needed

$prefix = 'phpbb';
define('USERS_TABLE','phpbb_users');
define('SESSIONS_TABLE','phpbb_sessions');
define('ANONYMOUS',-1);

$board_config['sitename']=$_SERVER['SERVER_NAME'];
$board_config['cookie_name']='phpbb';
$board_config['cookie_path']='/';
$board_config['cookie_domain']=$_SERVER['SERVER_NAME'];
$board_config['cookie_secure']=0;
$board_config['session_length']=3600;

function append_sid($a,$b="") {
	return $a.$b;
}

// we need to get the db login information 
// require_once Leonardo_Joomla_main_dir."/configuration.php";
require_once $CONF_abs_path."/site/config_db.php";

// also load the required functions
require_once dirname(__FILE__)."/mainfile.php";

?>