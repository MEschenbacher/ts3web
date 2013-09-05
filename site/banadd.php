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

if (isset($_POST['addban']))
	{
	if(isset($_POST['banip']) AND !empty($_POST['banip']))
		{
		$ban_add=$ts3->BanAddByIp($_POST['banip'], $_POST['bantime'], $_POST['reason']);
		}
	if(isset($_POST['banuid']) AND !empty($_POST['banuid']))
		{
		$ban_add=$ts3->BanAddByUid($_POST['banuid'], $_POST['bantime'], $_POST['reason']);
		}
	if(isset($_POST['banname']) AND !empty($_POST['banname']))
		{
		$ban_add=$ts3->BanAddByName($_POST['banname'], $_POST['bantime'], $_POST['reason']);
		}
	if(isset($ban_add))
		{
		if($ban_add['success']!==false)
			{
			$noerror .= $lang['banaddok']."<br />";
			}
			else
			{
			for($i=0; $i+1==count($ban_add['errors']); $i++)
				{
				$error .= $ban_add['errors'][$i]."<br />";
				}
			}
		}
	}
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
}
?>