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
error_reporting(E_ALL ^ E_NOTICE);
header("Content-Type: text/html; charset=utf-8");
if(version_compare(PHP_VERSION, '5.0.0', '<')) {die("Require PHP 5 or higher");}

define("SECURECHECK", 1);
define('DS', DIRECTORY_SEPARATOR);
define('TS3WI_DIR', dirname(__FILE__));
define('TS3WI_LIB_DIR', TS3WI_DIR.DS.'libs'.DS);
define('TS3WI_TMPL_DIR', TS3WI_DIR.DS.'templates'.DS);
define('SMARTY_DIR', TS3WI_LIB_DIR.'Smarty'.DS.'libs'.DS);

require_once("ts3admin.class.php");
require_once('config.php');
require_once('functions.inc.php');
require_once('updatecheck.php');
require_once('site/lang.php');
require_once(SMARTY_DIR.'Smarty.class.php');

$smarty=new Smarty();



$smarty->template_dir = TS3WI_DIR.DS.'templates/';
$smarty->compile_dir = TS3WI_DIR.DS.'templates_c/';

$serverstatus='';
$geticons=0;
$site='';
if(isset($_GET['site']))
	{
	$site=$_GET['site'];
	}
require("header.php");
if(isset($_GET['sid']) and isset($ts3))
	{
	if(isset($_SESSION['loginsid']))
		{
		$sid=$_SESSION['loginsid'];
		}
		else
		{
		$sid=$_GET['sid'];
		}
	if($ts3->getElement('success', $ts3->selectServer($sid, 'serverId'))===false)
		{
		if($ts3->getElement('success', $ts3->selectServer($sid, 'serverId', true))===false)
			{
			$sid=false;
			}
			else
			{
			$ts3->setName($msgsend_name);
			$permissionlist=$ts3->getElement('data', $ts3->permissionList());
		
			$getpermoverview=$ts3->getElement('data', $ts3->permOverview($whoami['client_channel_id'],$whoami['client_database_id']));
			if(!empty($permissionlist) AND !empty($getpermoverview))
				{
				foreach($permissionlist AS $value)
					{
					foreach($getpermoverview AS $key2=>$value2)
						{
						if($value['permid']==$value2['p'])
							{
							$permoverview[$value['permname']]=$value2['v'];
							}
						}
					if(!isset($permoverview[$value['permname']]))
						{
						$permoverview[$value['permname']]='';
						}
					}
				}
			}
		}
		else
		{
		$ts3->setName($msgsend_name);
		$permissionlist=$ts3->getElement('data', $ts3->permissionList());
	
		$whoami=$ts3->getElement('data', $ts3->whoAmI());
		$getpermoverview=$ts3->getElement('data', $ts3->permOverview($whoami['client_channel_id'],$whoami['client_database_id']));
		if(!empty($permissionlist) AND !empty($getpermoverview))
			{
			foreach($permissionlist AS $value)
				{
				foreach($getpermoverview AS $key2=>$value2)
					{
					if($value['permid']==$value2['p'])
						{
						$permoverview[$value['permname']]=$value2['v'];
						}
					}
				if(!isset($permoverview[$value['permname']]))
					{
					$permoverview[$value['permname']]='';
					}
				}
			}
		}
	}

if(isset($_GET['sgid']))
	{
	$sgid=$_GET['sgid'];
	$smarty->assign("sgid", $sgid);
	}
if(isset($_GET['cgid']))
	{
	$cgid=$_GET['cgid'];
	$smarty->assign("cgid", $cgid);
	}
if(isset($_GET['cid']))
	{
	$cid=$_GET['cid'];
	$smarty->assign("cid", $cid);
	}
if(isset($_GET['clid']))
	{
	$clid=$_GET['clid'];
	$smarty->assign("clid", $clid);
	}
if(isset($_GET['cldbid']))
	{
	$cldbid=$_GET['cldbid'];
	$smarty->assign("cldbid", $cldbid);
	}


if($serverstatus===false)
	{
	$site="login";
	}
elseif($loginstatus===false AND $site!="hostlogin")
	{
	$site='login';
	}
elseif(empty($site))
	{
	$site='server';
	}
$page="site/".$site.".php";

$forbidden_signs=array(".", "/", "\\");
$forbidden_signs2=array(";", "'");

foreach($forbidden_signs AS $value)
	{
	if(strpos($site, $value)!==false)
		{
		$site='error';
		$page='site/error.php';
		break;
		}
	}
foreach($forbidden_signs2 AS $value)
	{
	if(strpos($_SERVER['REQUEST_URI'], $value)!==false)
		{
		$site='error';
		$page='site/error.php';
		break;
		}
	}

if($page!='site/error.php' AND !file_exists($page))
	{
	$site='error';
	$page='site/error.php';
	}


if(!file_exists(TS3WI_TMPL_DIR.$style))
	{
	$style="default";
	}

require_once($page);
require_once('site/fastswitch.php');
require_once('site/showupdate.php');
require_once('site/footer.php');


$footer=implode("", file('templates/'.$style.DS.'index.tpl'));
if(md5($footer2.$footer3)!='3065534252aa6d5e72504589c7910335' OR strpos($footer, '{$footer}')===false)
	{
	die();
	}

$smarty->assign("tmpl", $style);
$smarty->assign("site", $site);
$smarty->assign("lang", $lang);
$smarty->assign("hoststatus", $hoststatus);
$smarty->assign("loginstatus", $loginstatus);
$smarty->assign("instances", $server);
if(isset($permoverview)) $smarty->assign("permoverview", $permoverview);

if(isset($sid))
	{
	$smarty->assign("sid", $sid);
	}

$smarty->display($style.DS.'index.tpl');
?>