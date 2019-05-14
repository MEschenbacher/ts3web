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
$sgrouplist=$ts3->getElement('data', $ts3->serverGroupList());
$cgrouplist=$ts3->getElement('data', $ts3->channelGroupList());
$channellist=$ts3->getElement('data', $ts3->channelList());

if(isset($_POST['deltoken']))
	{
	foreach($_POST['token'] AS $key=>$value)	
		{
		$token_delete=$ts3->tokenDelete($value);
		if($token_delete['success']!==false)
			{
			$noerror .= $lang['tokendeleteok']."<br />";
			}
			else
			{
			for($i=0; $i+1==count($token_delete['errors']); $i++)
				{
				$error .= $token_delete['errors'][$i]."<br />";
				}
			}
		}
	}
	
if(isset($_POST['addtoken']))
	{
	if($_POST['tokentype']==0 AND $_POST['tokenid2']!=0)
		{
		$_POST['tokenid2']=0;
		}
	if($_POST['tokentype']==1 AND $_POST['tokenid2']==0)
		{
		$error .= $lang['nochannel']."<br />";
		}
		else
		{
		$_POST['tokentype']==0 ? $tokenid1=$_POST['tokenid1_1']:$tokenid1=$_POST['tokenid1_2'];
		$tokens='';
		for($i=1; $i<=$_POST['number']; $i++)
			{
			$token_add=$ts3->tokenAdd($_POST['tokentype'], $tokenid1, $_POST['tokenid2'], $_POST['description']);
			if($token_add['success']!==false)
				{
				$tokens .= $token_add['data']['token']."<br />";
				}
				else
				{
				for($i=0; $i+1==count($token_add['errors']); $i++)
					{
					$error .= $token_add['errors'][$i]."<br />";
					}
				if(!empty($error))
					{
					break;
					}
				}
			}
		if(!empty($tokens))
			{
			$noerror .= $lang['tokencreatedok'].":<br />".$tokens;
			}
		}
	}
$tokenlist=$ts3->getElement('data', $ts3->tokenList());

if(!empty($tokenlist))
	{
	foreach($tokenlist AS $key=>$value)
		{
		$tokenlist[$key]=secure($tokenlist[$key]);
		}
	}

if(!empty($channellist))
	{
	foreach($channellist AS $key=>$value)
		{
		$channellist[$key]=secure($channellist[$key]);
		}
	}
	
if(!empty($cgrouplist))
	{
	foreach($cgrouplist AS $key=>$value)
		{
		$cgrouplist[$key]=secure($cgrouplist[$key]);
		}
	}
	
if(!empty($sgrouplist))
	{
	foreach($sgrouplist AS $key=>$value)
		{
		$sgrouplist[$key]=secure($sgrouplist[$key]);
		}
	}
	
$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("sgrouplist", $sgrouplist);
$smarty->assign("cgrouplist", $cgrouplist);
$smarty->assign("channellist", $channellist);
$smarty->assign("tokenlist", $tokenlist);
}
?>