<?php
/*
*Copyright (C) 2012-2013  Psychokiller
*
*This program is free software; you can redistribute it and/or modify it under the terms of 
*the GNU General Public License as published by the Free Software Foundation; either 
*version 3 of the License, or any later version.
*
*This program is distributed in the hope that it will be useful, but WITHOUT ANY WARRANTY; 
*without even the implied warranty of MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. 
*See the GNU General Public License for more details.
*
*You should have received a copy of the GNU General Public License along with this program; if not, see <http://www.gnu.org/licenses/>. 
*/
error_reporting(E_ALL & ~E_NOTICE);
session_start();
define("SECURECHECK", 1);

require('../config.php');
require('lang.php');
require('../ts3admin.class.php');
require('../functions.inc.php');
require_once('../libs/Smarty/libs/Smarty.class.php');

if(!isset($_SESSION['logged']) OR isset($_SESSION['logged']) AND $_SESSION['logged']!=true OR empty($_GET['sid'])) {die($lang['error_file_alone']);}

$smarty=new Smarty();

$smarty->template_dir = '..'.DS.'templates/';
$smarty->compile_dir = '..'.DS.'templates_c/';
$smarty->config_dir = '..'.DS.'configs/';
$smarty->cache_dir = '..'.DS.'cache/'; 

if(!file_exists('..'.DS.'templates'.DS.$style))
	{
	$style="default";
	}

$smarty->assign("tmpl", $style);

$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
$ts3->connect();
$ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw'])));
$ts3->selectServer($_GET['sid'], 'serverId');

$channellist=$ts3->getElement('data', $ts3->channelList("-limits"));

$servergrouplist=$ts3->getElement('data', $ts3->serverGroupList());
$channelgrouplist=$ts3->getElement('data', $ts3->channelGroupList());



$smarty->assign("lang", $lang);

$smarty->assign("channellist", $channellist);
$smarty->assign("servergrouplist", $servergrouplist);
$smarty->assign("channelgrouplist", $channelgrouplist);
$smarty->display($style.DS.'interactive.tpl');
?>