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
$error='';
$noerror='';
if(isset($_POST['upload']))
	{
	$icon=@getimagesize($_FILES['thefile']['tmp_name']);
	if($icon!=false)
		{
		if($icon[0]<=16 or $icon[1]<=16)
			{
			$filename="icon_".mt_rand(1000000000, 2147483647);
			if(move_uploaded_file($_FILES['thefile']['tmp_name'],"temp/".$filename))
				{
				$noerror .= $lang['iconadd']."<br />";
				}
			$ft2=$ts3->getElement('data', $ts3->ftInitUpload("/".$filename, 0, $_FILES['thefile']['size']));
			$file=file_get_contents("temp/".$filename);
			$con_ft=fsockopen($_SESSION['server_ip'], $ft2['port'], $errnum, $errstr, 10);
			fputs($con_ft, $ft2['ftkey']);
			fputs($con_ft, $file);
			unlink("temp/".$filename);
			fclose($con_ft);
			}
			else
			{
			$error .= $lang['iconmaxsize']."<br />";
			}
		}
		else
		{
		$error .= $lang['notapic']."<br />";
		}
	}
	
if(isset($_POST['delicons']) AND !empty($_POST['delicons']))
	{
	$ts3->ftDeleteFile(0, '', $_POST['delicons']);
	foreach($_POST['delicons'] AS $key=>$value)
		{
		@unlink('icons/'.$_SESSION['server_ip'].'-'.$whoami['virtualserver_port'].'/'.$value);
		}
	}
	
$handler2=@opendir('icons/'.$_SESSION['server_ip'].'-'.$whoami['virtualserver_port'].'/');
if($handler2)
	{
	while($datei=readdir($handler2))
		{
		if($datei!='.' AND $datei!='..')
			{
			$icon_id=str_replace("icon_", "", $datei);
			$allicons[$datei]['name']=$icon_id;
			$allicons[$datei]['id']=sprintf('%u', $icon_id & 0xffffffff);
			$allicons[$datei]['info']=getimagesize('icons/'.$_SESSION['server_ip'].'-'.$whoami['virtualserver_port'].'/'.$datei);
			}
		}
	}
	
$smarty->assign("port", $whoami['virtualserver_port']);
$smarty->assign("allicons", $allicons);
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
?>
