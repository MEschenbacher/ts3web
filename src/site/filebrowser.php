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

define('DS', DIRECTORY_SEPARATOR);
define('SMARTY_DIR', '..'.DS.'libs'.DS.'Smarty'.DS.'libs'.DS);

require('../config.php');
require('lang.php');
require('../ts3admin.class.php');
require('../functions.inc.php');
require_once('../libs/Smarty/libs/Smarty.class.php');

if(!isset($_SESSION['logged']) OR isset($_SESSION['logged']) AND $_SESSION['logged']!=true OR empty($_GET['sid']) OR empty($_GET['cid'])) {die($lang['error_file_alone']);}

$smarty=new Smarty();

$smarty->template_dir = '..'.DS.'templates/';
$smarty->compile_dir = '..'.DS.'templates_c/';
$smarty->config_dir = '..'.DS.'configs/';
$smarty->cache_dir = '..'.DS.'cache/'; 

$error='';
$noerror='';
$flist='';

if(!file_exists('..'.DS.'templates'.DS.$style))
	{
	$style="default";
	}

$smarty->assign("tmpl", $style);
	
$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
$ts3->connect();
$ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw'])));
$ts3->selectServer($_GET['sid'], 'serverId');
$chaninfo=$ts3->getElement('data', $ts3->channelInfo($_GET['cid']));

function cmp($a, $b)
{
    return strcmp($a["name"], $b["name"]);
}

if(isset($_GET['deletefile']))
	{
	$delfiles[]=$_GET['path']=="/" ? "/".$_GET['name']:$_GET['path']."/".$_GET['name'];
	$isdelete=$ts3->ftDeleteFile($_GET['cid'], isset($_GET['cpw']) ? $_GET['cpw']:'', $delfiles);
	if($isdelete['success']===false)
		{
		$error .= $isdelete['errors'][0];
		}
		else
		{
		$noerror .= $lang['fdelok'];
		}
	}
	
if(isset($_POST['createdir']))
	{
	$dirname=$_GET['path']=="/" ? "/".$_POST['fname']:$_GET['path']."/".$_POST['fname'];
	$iscreate=$ts3->ftCreateDir($_GET['cid'], isset($_GET['cpw']) ? $_GET['cpw']:'', $dirname);
	if($iscreate['success']===false)
		{
		$error .= $iscreate['errors'][0];
		}
		else
		{
		$noerror .= $lang['createdir'];
		}
	}
	
if(isset($_POST['upload']))
	{
	if($_FILES['thefile']['error']==0)
		{
		if(move_uploaded_file($_FILES['thefile']['tmp_name'],"../temp/".$_FILES['thefile']['name']))
			{
			$noerror .= $lang['fileadd']."<br />";
			}
		$path=$_GET['path']=="/" ? "/".$_FILES['thefile']['name']:$_GET['path']."/".$_FILES['thefile']['name'];
		$ft2=$ts3->getElement('data', $ts3->ftInitUpload($path, $_GET['cid'], $_FILES['thefile']['size'], $_GET['cpw']));
		$file=file_get_contents("../temp/".$_FILES['thefile']['name']);
		$con_ft=fsockopen($_SESSION['server_ip'], $ft2['port'], $errnum, $errstr, 10);
		fputs($con_ft, $ft2['ftkey']);
		fputs($con_ft, $file);
		unlink("../temp/".$_FILES['thefile']['name']);
		fclose($con_ft);
		}
		else
		{
		switch($_FILES['thefile']['error'])
			{
			case 1:
			$error .= $lang['UPLOAD_ERR_INI_SIZE'];
			break;
			case 2:
			$error .= $lang['UPLOAD_ERR_FORM_SIZE'];
			break;
			case 3:
			$error .= $lang['UPLOAD_ERR_PARTIAL'];
			break;
			case 4:
			$error .= $lang['UPLOAD_ERR_NO_FILE'];
			break;
			}
		}
	}

if(isset($_GET['cid']) AND isset($_GET['path']))
	{
	require('filetransfer.php');
	if(!empty($flist))
		{
		foreach($flist AS $key=>$value)
			{
			if($value['type']==0)
				{
				$folder[]=$flist[$key];
				}
				else
				{
				$files[]=$flist[$key];
				}
			}
		}
	if(!empty($folder))
		{
		usort($folder, "cmp");
		}
	if(!empty($files))
		{
		usort($files, "cmp");
		}
	if(!empty($folder) AND empty($files))
		{
		$flist=$folder;
		}
	elseif(empty($folder) AND !empty($files))
		{
		$flist=$files;
		}
	elseif(!empty($folder) AND !empty($files))
		{
		$flist=array_merge($folder, $files);
		}
	else
		{
		$flist='';
		}
	}
if(isset($_GET['path']) AND $_GET['path']!="/" AND !empty($_GET['path']))
	{ 
	$cid=$_GET['cid'];
	$splitpath=explode("/",$_GET['path']);
	unset($splitpath[count($splitpath)-1]);
	$newpath=implode("/", $splitpath);
	empty($newpath) ? $newpath="/":'';
	$newpath=="/" ? $cid='':'';
	$newpath=urlencode($newpath); 
	} 

if(!empty($flist))
	{
	foreach($flist AS $key=>$value)
		{
		$flist[$key]['size']=round($flist[$key]['size'] / 1048576, 2);
		$flist[$key]=secure($flist[$key]);
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("lang", $lang);
$smarty->assign("flist", $flist);
$smarty->assign("chaninfo", secure($chaninfo));
if(isset($newpath))
	{
	$smarty->assign("newpath", $newpath);
	}
	
if(isset($cid))
	{	
	$smarty->assign("cid", $cid);
	}
	
	
$smarty->display($style.DS.'filebrowser.tpl');
?>