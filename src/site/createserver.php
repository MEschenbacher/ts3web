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
if($hoststatus===false) { echo $lang['nohoster']; } else {

include('screate_config.php');

$error = '';
$noerror = '';

if(isset($_POST['createserver']))
	{
	$token=$ts3->serverCreate($_POST['newsettings']);
	if($token['success']===false)
		{
		for($i=0; $i+1==count($token['errors']); $i++)
			{
			$error .= $token['errors'][$i]."<br />";
			}
		}
		else
		{
		$noerror = $lang['serverid'].": ".$token['data']['sid']."<br />".$lang['port'].": ".$token['data']['virtualserver_port']."<br />".$lang['token'].": ".$token['data']['token'];
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("screate_tmp", $screate_tmp);
} ?>