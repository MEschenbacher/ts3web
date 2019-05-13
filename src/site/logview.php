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

if(isset($_POST['begin_pos']))
	{
	$begin_pos=' begin_pos='.$_POST['begin_pos'];
	}
	else
	{
	$begin_pos='';
	}
if(empty($sid))
	{
	$instance=' instance=1';
	}
	else
	{
	$instance=' instance=0';
	}
$getlog=$ts3->execOwnCommand('2', 'logview lines=100 reverse=1'.$instance.$begin_pos);

$begin_pos=$getlog['data'][0]['last_pos'];
if(!empty($getlog['data']))
	{
	foreach($getlog['data'] AS $key=>$value)
		{
		$log[]=explode('|', $value['l'], 5);
		}
	}
$smarty->assign("serverlog", $log);
$smarty->assign("begin_pos", $begin_pos);
?>
