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

if(isset($_POST['delall']))
	{
	$complain_delete_all=$ts3->complainDeleteAll($_POST['tcldbid']);
	
	if($complain_delete_all['success']!==false)
		{
		$noerror .= $lang['complaindel']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($complain_delete_all['errors']); $i++)
			{
			$error .= $complain_delete_all['errors'][$i]."<br />";
			}
		}
	}
	
if(isset($_POST['delete']))
	{
	$complain_delete=$ts3->complainDelete($_POST['tcldbid'], $_POST['fcldbid']);
	
	if($complain_delete['success']!==false)
		{
		$noerror .= $lang['complainsdel']."<br />";
		}
		else
		{
		for($i=0; $i+1==count($complain_delete['errors']); $i++)
			{
			$error .= $complain_delete['errors'][$i]."<br />";
			}
		}
	}
$complainlist=$ts3->getElement('data', $ts3->complainList());
$newcomplainlist=array();
if(!empty($complainlist))
	{
	foreach($complainlist AS $key=>$value)
		{
		$value=secure($value);
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['fname']=$value['fname'];
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['message']=$value['message'];
		$newcomplainlist[$value['tcldbid']][$value['tname']][$value['fcldbid']]['timestamp']=$value['timestamp'];
		}
	}

$smarty->assign("error", $error);
$smarty->assign("noerror", $noerror);
$smarty->assign("newcomplainlist", $newcomplainlist);
?>