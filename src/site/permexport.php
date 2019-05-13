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
$permexport='';
if(isset($_POST['sourcemode']) AND $_POST['sourcemode']==1)
	{
	$permissions=$ts3->getElement('data', $ts3->serverGroupPermList($_POST['sourceid']));
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==2)
	{
	$permissions=$ts3->getElement('data', $ts3->channelGroupPermList($_POST['sourceid']));
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==3)
	{
	$permissions=$ts3->getElement('data', $ts3->channelPermList($_POST['sourceid']));
	}
	elseif(isset($_POST['sourcemode']) AND $_POST['sourcemode']==4)
	{
	$permissions=$ts3->getElement('data', $ts3->clientPermList($_POST['sourceid']));
	}
if(isset($permissions) AND $permissions===false)
	{
	$error .= 'Source target nicht gefunden';
	}
	else
	{
	if(isset($_POST['showcommands']))
		{
		$editperms='';
		if(!empty($permissionlist))
			{
			foreach($permissionlist AS $key=>$value)
				{
				foreach($permissions AS $key2=>$value2)
					{
					if($value['permid']==$value2['permid'])
						{
						$editperms[$value['permid']]['value']=$value2['permvalue'];
						$editperms[$value['permid']]['skip']=$value2['permskip'];
						$editperms[$value['permid']]['negated']=$value2['permnegated'];
						$editperms[$value['permid']]['delete']=0;
						}
					}
				if(!isset($editperms[$value['permid']]))
					{
					$editperms[$value['permid']]['delete']=1;
					}
				}
			}
		if(!empty($editperms)) 
			{	
			$permexport=getPermsCommand($_POST['targetmode'], $_POST['targetid'], $editperms);
			} 
			else 
			{
			$permexport=$lang['nopermsfound'];
			}
		}
	}

$smarty->assign("error", $error);
$smarty->assign("permexport", $permexport);
