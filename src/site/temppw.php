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
if(isset($_POST['create']))
	{
	if($_POST['password']!='' AND $_POST['duration']!='')
		{
		if($ts3->getElement('success', $ts3->serverTemppasswordAdd($_POST['password'], $_POST['duration'], $_POST['tcid'], $_POST['description'])))
			{
			$noerror.=$lang['temppwcnoerr']."<br />";
			}
			else
			{
			$debug=$ts3->getDebugLog();
			foreach($debug AS $key=>$value)
				{
				$error.=$value."<br />";
				}
			}
		}
	}
	
if(isset($_POST['temppwdel']))
	{
	if($ts3->getElement('success', $ts3->serverTemppasswordDel($_POST['pw'])))
		{
		$noerror.=$lang['temppwdnoerr']."<br />";
		}
		else
		{
		$debug=$ts3->getDebugLog();
		foreach($debug AS $key=>$value)
			{
			$error.=$value."<br />";
			}
		}
	}

$channellist=$ts3->getElement('data', $ts3->channelList());
$temppwlist=$ts3->getElement('data', $ts3->serverTemppasswordList());
$smarty->assign("channellist", $channellist);
$smarty->assign("temppwlist", $temppwlist);
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
?>