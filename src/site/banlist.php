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

if (isset($_POST['unban']))
	{
	$ban_delete=$ts3->banDelete($_POST['banid']);
	
	if($ban_delete['success']!==false)
		{
		$noerror .= $lang['bandelok']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($ban_delete['errors']); $i++)
			{
			$error .= $ban_delete['errors'][$i]."<br />";
			}
		}
	}

$banlist=$ts3->getElement('data', $ts3->banList());
}

if(!empty($banlist))
	{
	foreach($banlist AS $key=>$value)
		{
		$banlist[$key]=secure($banlist[$key]);
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("banlist", $banlist);
?>