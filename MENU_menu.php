<?
//************************************************************************
// Leonardo XC Server, http://www.leonardoxc.net
//
// Copyright (c) 2004-2010 by Andreadakis Manolis
//
// This program is free software. You can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation; either version 2 of the License.
//
// $Id: MENU_menu.php,v 1.18 2010/03/14 20:56:11 manolis Exp $                                                                 
//
//************************************************************************
?>

<script type="text/javascript" src="<?=$moduleRelPath?>/js/jquery.js"></script>
<script type="text/javascript" src="<?=$moduleRelPath ?>/js/jquery.livequery.js"></script>
<script type="text/javascript" src="<?=$moduleRelPath ?>/js/jqModal.js"></script>
<script type="text/javascript" src="<?=$moduleRelPath?>/js/DHTML_functions.js"></script>

<link rel="stylesheet" type="text/css" href="<?=$moduleRelPath?>/templates/<?=$PREFS->themeName?>/style_second_menu.css">
<link rel="stylesheet" type="text/css" href="<?=$moduleRelPath?>/templates/<?=$PREFS->themeName?>/style_top_menu.css">
<link rel="stylesheet" type="text/css" href="<?=$moduleRelPath?>/js/jqModal.css">

<!-- test for sprites-->
<link rel="stylesheet" type="text/css" href="<?=$moduleRelPath?>/templates/<?=$PREFS->themeName?>/sprites.css">
<style type="text/css">
<!--
img.brands { background: url(<?=$moduleRelPath?>/img/sprite_brands.png) no-repeat top left;}
img.fl {   background: url(<?=$moduleRelPath?>/img/sprite_flags.png) no-repeat top left;}
img.icons1 {   background: url(<?=$moduleRelPath?>/img/sprite_icons1.png) no-repeat top left;}
-->
</style>



	
<? require_once dirname(__FILE__)."/MENU_top_menu.php"; ?>

<div class="main_text" align="left" style="clear:both;padding:0;margin:0">
<a name="top_of_page" ></a>
<div id="dialogWindow" class="jqmWindow"></div>
