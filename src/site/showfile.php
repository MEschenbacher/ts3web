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
session_start();
$ip='';
if(isset($_SESSION['logged']) AND $_SESSION['logged']==true OR isset($_SESSION['pubviewer']) AND $_SESSION['pubviewer']==true)
	{
	if(isset($_GET['ip']))
		{
		$ip=$_GET['ip'];
		}
		elseif(isset($_SESSION['server_ip']))
		{
		$ip=$_SESSION['server_ip'];
		}
	$name=str_replace("\\","",$_REQUEST['name']);
	$name=str_replace("/","",$name);
	if(str_replace('icon_', '', $name)==100 OR str_replace('icon_', '', $name)==200 OR str_replace('icon_', '', $name)==300 OR str_replace('icon_', '', $name)==500 OR str_replace('icon_', '', $name)==600)
			{
			$path='../icons/';
			}
			else
			{
			$path='../icons/'.$ip.'-'.$_GET['port'].'/';
			}

	$mime=getimagesize($path.$name);

	if(strpos($mime['mime'], "image")===false)
		{
		die('error');
		}
		else
		{
		header('Content-type: '.$mime['mime']);
		
		echo file_get_contents($path.$name);
			
		}
	}
	else
	{
	echo "The file can not be executed alone.";
	}
?>