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
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
       "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="de">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Webinterface - All Icons</title>
</head>
<body>
<table>
<?php
$ip=$_GET['ip'];
$port=$_GET['port'];
$handler=opendir("../icons/");
$handler2=opendir('../icons/'.$ip.'-'.$port.'/');

$count=0;
if($handler)
	{
	while($datei=readdir($handler))
		{
		
		if($datei!='.' AND $datei!='..' AND preg_match('/icon_/', $datei))
			{

			$count++;
			$getid=str_replace("icon_", "", $datei);
		if($count==1)
			{
			echo "<tr><td>";
			}
			else
			{
			echo "<td>";
			}
		
		echo "<a href=\"#\" onclick=\"javascript:opener.document.getElementById('iconid').value = $getid;\"><img style=\"border:0\"src=\"showfile.php?name=icon_".$getid."\" alt=\"\" /></a><br />";
		
		if($count==5)
			{
			$count=0;
			echo "</td></tr>";
			}
			else
			{
			echo "</td>";
			}
		
			}
		}
	if($count<5 AND $count>0)	
		{
		echo $count;
		echo "</tr>";
		}
	}
	
if($handler2)
	{
	while($datei=readdir($handler2))
		{
		
		if($datei!='.' AND $datei!='..')
			{
			$count++;
			$getid=str_replace("icon_", "", $datei);
		if($count==1)
			{
			echo "<tr><td>";
			}
			else
			{
			echo "<td>";
			}
		
		echo "<a href=\"#\" onclick=\"javascript:opener.document.getElementById('iconid').value = $getid;\"><img style=\"border:0\"src=\"showfile.php?name=icon_".$getid."&amp;port=".$port."\" alt=\"\" /></a><br />";
		
		if($count==5)
			{
			$count=0;
			echo "</td></tr>";
			}
			else
			{
			echo "</td>";
			}
		
			}
		}
	if($count<5 AND $count>0 )	
		{
		echo "</tr>";
		}
	}
?>
</table>
</body>
</html>