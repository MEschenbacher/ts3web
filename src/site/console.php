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

$showOutput='';
$getOutput='';
if(isset($_POST['command']))
	{
	$data=strtr($_POST['command'], array("\n\n" => '\n', "\r\n" => '\n', "\r" => '\n', "\n" => '\n'));
	$commands=explode('\n', $data);
	$use_error=0;
	if($hoststatus===false)
		{
		foreach($commands AS $key=>$value)
			{
			if(substr($value, 0, 3)=='use')
				{
				$use_error++;
				}
			}
		}
	if(empty($use_error))
		{
		foreach($commands AS $key=>$value)
			{
			if(!empty($value))
				{
				$getOutput=$ts3->execOwnCommand(3, $value);
				
				if(!empty($getOutput['errors']))
					{
					$get_errorid=explode('ErrorID: ', $getOutput['errors'][0]);
					$get_errorid=explode(' | Message: ', $get_errorid[1]);
					$errormsg="error id=".$get_errorid[0]." msg=".$get_errorid[1]."\n";
					}
					else
					{
					$errormsg="error id=0 msg=ok\n";
					}
				$showOutput.=$getOutput['data'].$errormsg;
				}
			}
		}
		else
		{
		$showOutput .= $lang['nouse'];
		}
	}

$smarty->assign("showOutput", str_replace('<br>', "\n", $showOutput));
?>
