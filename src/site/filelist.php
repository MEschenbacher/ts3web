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
if(!defined("SECURECHECK")) {die($lang['error_file_alone']);} 
if($sid===false OR empty($sid)) { echo "<meta http-equiv=\"refresh\" content=\"0; URL=index.php?site=server\">";} else {

$error='';
$noerror='';
$channellist=$ts3->channelList();
$getallfiles=array();

if(isset($_GET['deletefile']))
	{
	$delfiles[]=$_GET['path']=="/" ? "/".$_GET['name']:$_GET['path']."/".$_GET['name'];
	if(!isset($_GET['cpw'])) {$_GET['cpw']='';}
	$isdelete=$ts3->ftDeleteFile($_GET['cid'], $_GET['cpw'], $delfiles);
	$_GET['path']=="/" ? $_GET['cid']='':'';
	if($isdelete['success']===false)
		{
		for($i=0; $i+1==count($isdelete['errors']); $i++)
			{
			$error .= $isdelete['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['fdelok']."<br />";
		}
	}

if(isset($_POST['createdir']))
	{
	$dirname=$_GET['path']=="/" ? "/".$_POST['fname']:$_GET['path']."/".$_POST['fname'];
	$iscreate=$ts3->ftCreateDir($_REQUEST['cid'], $_GET['cpw'], $dirname);
	if($iscreate['success']===false)
		{
		for($i=0; $i+1==count($iscreate['errors']); $i++)
			{
			$error .= $iscreate['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror .= $lang['createdir']."<br />";
		}
	}
	
if(isset($_POST['upload']))
	{
	if($_FILES['thefile']['error']==0)
		{
		if(move_uploaded_file($_FILES['thefile']['tmp_name'],"temp/".$_FILES['thefile']['name']))
			{
			$noerror .= $lang['fileadd']."<br />";
			}
		$path=$_GET['path']=="/" ? "/".$_FILES['thefile']['name']:$_GET['path']."/".$_FILES['thefile']['name'];
		$ft2=$ts3->getElement('data', $ts3->ftInitUpload($path, $_REQUEST['cid'], $_FILES['thefile']['size'], $_GET['cpw']));
		$file=file_get_contents("temp/".$_FILES['thefile']['name']);
		$con_ft=fsockopen($_SESSION['server_ip'], $ft2['port'], $errnum, $errstr, 10);
		fputs($con_ft, $ft2['ftkey']);
		fputs($con_ft, $file);
		unlink("temp/".$_FILES['thefile']['name']);
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

if(!isset($_GET['cid']) or empty($_GET['cid']))
	{
	if(!empty($channellist['data']))
		{
		foreach($channellist['data'] AS $key => $value)
			{
			$flist=$ts3->ftGetFileList($value['cid'], '', '/');
			
			if(!empty($flist['data']))
				{
				foreach($flist['data'] AS $key2=>$value2)
					{
					$flist['data'][$key2]['cname']=$value['channel_name'];
					if(!isset($value2['cid']))
						{
						$flist['data'][$key2]['cid']=$value['cid'];
						}
					}
				$getallfiles=array_merge($getallfiles, $flist['data']);
				}
			}
		}
	}
	else
	{
	$_GET['path']=str_replace('%2', '+', $_GET['path']);
	$getallfiles=$ts3->getElement('data', $ts3->ftGetFileList($_GET['cid'], '', $_GET['path']));
	}
	
if(!empty($getallfiles))
	{
	foreach($getallfiles AS $key=>$value)
		{
		$sort[]=$value['type'];
		$sort2[]=$value['name'];
		}
	array_multisort($sort, SORT_ASC, $sort2, SORT_ASC, $getallfiles);
	}

if(isset($_GET['cid']))
	{
	$chaninfo=$ts3->getElement('data', $ts3->channelInfo($_GET['cid']));
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
	
if(!empty($channellist))
	{
	foreach($channellist['data'] AS $key=>$value)
		{
		$channellist['data'][$key]=secure($channellist['data'][$key]);
		}
	}
	
if(!empty($getallfiles))
	{
	$getallfiles['totalsize']=0;
	foreach($getallfiles AS $key=>$value)
		{
		if($key!=='totalsize')
			{	
			$getallfiles[$key]['size']=round($getallfiles[$key]['size'] / 1048576, 2);
			$getallfiles[$key]=secure($getallfiles[$key]);
			}
		$getallfiles['totalsize']=$getallfiles['totalsize']+$getallfiles[$key]['size'];
		}
	}
	
if(isset($chaninfo) AND !empty($chaninfo))
	{
	$chaninfo=secure($chaninfo);
	}
	
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("channellist", $channellist['data']);
$smarty->assign("getallfiles", $getallfiles);
if(isset($chaninfo))
	{
	$smarty->assign("chaninfo", $chaninfo);
	}
if(isset($newpath))
	{
	$smarty->assign("newpath", $newpath);
	}
if(isset($cid))
	{	
	$smarty->assign("cid", $cid);
	}
}
?>