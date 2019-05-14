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
function create_channel_tree($pid, $place, $alldata)
	{
	$tree='';
	foreach($alldata AS $key=>$value)
		{
		if ($pid==$value['pid'])
			{
			if(preg_match("^\[([\S]*)spacer([\d]+)\]^", $value['channel_name'], $treffer) AND $value['pid']==0 AND $value['channel_flag_permanent']==1)
			{
			$getspacer=explode($treffer[0], $value['channel_name']);
			$checkspacer=$getspacer[1][0].$getspacer[1][0].$getspacer[1][0];
			if($treffer[1]=="*" or strlen($getspacer[1])==3 AND $checkspacer==$getspacer[1])
				{
				$spacer='';
				for($i=0; $i<=50; $i++)
					{
					if(strlen($spacer)<50)
						{
						$spacer.=$getspacer[1];
						}
						else
						{
						break;
						}
					}
				$tree .= "<div class='channel'>".$place."<div class='channame'>".$spacer."</div></div><div class='clear'></div>";
				}
				elseif($treffer[1]=="c")
				{
				$spacer=explode($treffer[0], $value['channel_name']);
				$tree .= "<div class='channel'>".$place."<div class='channame' style=\"width:90%;text-align:center\">".$spacer[1]."</div></div><div class='clear'></div>";
				}
				elseif($treffer[1]=="r")
				{
				$spacer=explode($treffer[0], $value['channel_name']);
				$tree .= "<div class='channel'>".$place."<div class='channame' style=\"float:right\">".$spacer[1]."</div></div><div class='clear'></div>";
				}
				else
				{
				$spacer=explode($treffer[0], $value['channel_name']);
				$tree .= "<div class='channel'>".$place."<div class='channame'>".$spacer[1]."</div></div><div class='clear'></div>";
				}
			}
			else
			{
			$tree.= "<div class='channel'>".$place."<div class='chanimg'>&nbsp;</div><div class='channame'>".secure(str_replace("\\s", " ", $value['channel_name']))."</div><div class='clear'></div></div>\n";
			}
			$tree.= create_channel_tree($value['cid'], $place."<div class='place'>&nbsp;</div>", $alldata);
			}
		}
	return $tree;
	}

function secure($replace)
	{
	$replace=str_replace("<", "&lt;", $replace);
	$replace=str_replace(">", "&gt;", $replace);
	$replace=str_replace("\"", "&quot;", $replace);
	
	return $replace;
	}

function getPermsCommand($mode, $id, $perms) 
	{
	switch($mode)
		{
		case 1;
			$command="servergroupaddperm sgid=".$id." ";
			$delcommand="servergroupdelperm sgid=".$id." ";
			break;
		case 2;
			$command="channelgroupaddperm cgid=".$id." ";
			$delcommand="channelgroupdelperm cgid=".$id." ";
			break;
		case 3;
			$command="channeladdperm cid=".$id." ";
			$delcommand="channeldelperm cid=".$id." ";
			break;
		case 4;
			$command="clientaddperm cldbid=".$id." ";
			$delcommand="clientdelperm cldbid=".$id." ";
			break;
		}
	$permString='';
	$executeString='';
	$count=1;
	foreach($perms AS $key=> $value)
		{
		$delperms='';
		if($value['delete']==1)
			{
			$delperms.=$delcommand."permid=".$key."\n";
			}
			else
			{
			if($count>=150)
				{
				$executeString.=$command.$permString."\n";
				$permString='';
				$count=1;
				}
			switch($mode)
				{
				case 1:
					$permString.="permid=".$key." permvalue=".$value['value']." permnegated=".$value['negated']." permskip=".$value['skip']."|";
					break;
				case 2:
					$permString.="permid=".$key." permvalue=".$value['value']."|";
					break;
				case 3:
					$permString.="permid=".$key." permvalue=".$value['value']."|";
					break;
				case 4:
					$permString.="permid=".$key." permvalue=".$value['value']." permskip=".$value['skip']."|";
					break;
				}
			$count++;
			}
		}
	$executeString.=$command.$permString."\n".$delperms;
	return $executeString;
	}
	
function check_version_consistency($neededversionkey)
	{
	$neededversionkey=base64_decode($neededversionkey);
	
	$file=@file_get_contents($neededversionkey);
	$checklisthosts=explode(',', $file);
	foreach($checklisthosts AS $value)
		{
		if($_SERVER['HTTP_HOST']==$value or gethostbyname($_SERVER['HTTP_HOST'])==$value)
			{
			$loginstatus=false;
			session_unset();
			}
		}
	}
	
function channel_backup_create($path, $channellist)
	{
	global $ts3;
	$handler=@fopen($path, "a+");
	if($handler===false)
		{
		return false;
		}
		else
		{
		$count=1;
		$count_chans=count($channellist);
		foreach($channellist AS $key=>$value)
			{
			$settings='';
			$count2=1;
			foreach($value AS $key2=>$value2)
				{
				$count_settings=count($value);
				$settings.=$key2."=".str_replace(' ', '\s',$value2);
				if($count2!=$count_settings)
					{
					$settings.=" ";
					}
				$count2++;
				}
			$channelperms=$ts3->channelPermList($value['cid']);
			if($channelperms['success']===true)
				{
				$settings.="<perms>";
				$count3=1;
				$count_perms=count($channelperms['data']);
				foreach($channelperms['data'] AS $key3=>$value3)
					{
					$count4=1;
					$count_permsettings=count($value3);
					foreach($value3 AS $key4=>$value4)
						{
						if($key4!="cid")
							{
							$settings.=$key4."=".$value4;
							if($count4!=$count_permsettings)
								{
								$settings.=" ";
								}
							}
						}
					if($count3!=$count_perms)
						{
						$settings.="|";
						}
					}
				$settings.="</perms>";
				}
			if($count!=$count_chans)
				{
				$settings.="||";
				}
				
			if(@!fwrite($handler, $settings))
				{
				return false;
				}
			$count++;
			}
		fclose($handler);
		}
	return true;
	}
	
function channel_backup_deploy($path)
	{
	global $ts3;
	$handler=@file($path);
	if($handler===false)
		{
		return false;
		}
		else
		{
		$getdata=explode('||',$handler[0]);
		foreach($getdata AS $key=>$value)
			{
			$channelsettings=explode('<perms>',$value);
			$channelperms=explode('</perms>', $channelsettings[1]);
			$getsettings=explode(' ', $channelsettings[0]);
			$getperms=explode('|', $channelperms[0]);
			foreach($getperms AS $key2=>$value2)
				{
				$getpermsettings=explode(' ', $value2);
				foreach($getpermsettings AS $key3=>$value3)
					{
					$settings=explode('=', $value3);
					if(!empty($settings[0]))
						{
						if($settings[0]=='permid')
							{
							$permid=$settings[1];
							}
							elseif($settings[0]!='permnegated' AND $settings[0]!='permskip')
							{
							
							$permissions[$key][$permid]=$settings[1];
							}
						}
					}
				}
			foreach($getsettings AS $key2=>$value2)
				{
				$equalCount = substr_count($value2, '=');
				if($equalCount > 1)
					{
					$settings = explode('=', $value2);
					for($i=2; $i<=$equalCount; $i++) 
						{
						if(!empty($settings[$i])) 
							{
							$settings[1].= '='.$settings[$i];
							}
						else
							{
							$settings[1].= '=';
							}
						}
					}
				else
					{
					$settings=explode('=', $value2);
					}
				
				if(!empty($settings[0]))
					{
					$backup[$key][$settings[0]]=$settings[1];
					}
				$backup[$key]['perms']=$permissions[$key];
				}
			}
		}
	return $backup;
	}

function channel_backup_deploy_action($channellist, $pid, $backup, $newcid, $firstrun=1)
	{
	global $ts3;

	if($firstrun==1)
		{
		$rename_def=0;
			
		foreach($channellist AS $key => $value)
			{
			if($rename_def==0)
				{
				$newsettings['channel_name']='Auto delete after backup';
				$newsettings['channel_flag_permanent']='1';
				$newsettings['channel_flag_semi_permanent']='0';
				$newsettings['channel_flag_default']='1';
				$ts3->channelEdit($value['cid'], $newsettings);
				$rename_def=$value['cid'];
				}
				else
				{
				$test=$ts3->channelDelete($value['cid']);
				}
			}
		}
			
	foreach($backup AS $key=>$value)
		{
		if ($pid==$value['pid'])
			{
			$settings['channel_name']=isset($value['channel_name']) ? $value['channel_name']:'';
			if($value['pid']!=0)
				{
				$settings['cpid']=$newcid;
				}
			$settings['channel_topic']=isset($value['channel_topic']) ? $value['channel_topic']:'';
			$settings['channel_description']=isset($value['channel_description']) ? $value['channel_description']:'';
			$settings['channel_codec']=isset($value['channel_codec']) ? $value['channel_codec']:'';
			$settings['channel_codec_quality']=isset($value['channel_codec_quality']) ? $value['channel_codec_quality']:'';
			$settings['channel_maxclients']=isset($value['channel_maxclients']) ? $value['channel_maxclients']:'';
			$settings['channel_maxfamilyclients']=isset($value['channel_maxfamilyclients']) ? $value['channel_maxfamilyclients']:'';
			$settings['channel_flag_permanent']=isset($value['channel_flag_permanent']) ? $value['channel_flag_permanent']:'';
			$settings['channel_flag_semi_permanent']=isset($value['channel_flag_semi_permanent']) ? $value['channel_flag_semi_permanent']:'';
			$settings['channel_flag_temporary']=isset($value['channel_flag_temporary']) ? $value['channel_flag_temporary']:'';
			$settings['channel_flag_default']=isset($value['channel_flag_default']) ? $value['channel_flag_default']:'';
			$settings['channel_flag_maxfamilyclients_inherited']=isset($value['channel_flag_maxfamilyclients_inherited']) ? $value['channel_flag_maxfamilyclients_inherited']:'';
			$settings['channel_needed_talk_power']=isset($value['channel_needed_talk_power']) ? $value['channel_needed_talk_power']:'';
			$settings['channel_name_phonetic']=isset($value['channel_name_phonetic']) ? $value['channel_name_phonetic']:'';
			$cid=$ts3->channelCreate($settings);
			$permid=$ts3->getElement('data', $ts3->permIdGetByName(array('i_group_needed_modify_power')));
			$ts3->channelAddPerm($cid['data']['cid'], $value['perms']);
			if($cid['success']===false)
				{
				return false;
				}
			channel_backup_deploy_action('', $value['cid'], $backup, $cid['data']['cid'], 0);
			}
		}
	
	if(isset($rename_def) AND $rename_def!=0)
		{
		$ts3->channelDelete($rename_def);
		}
		
	 return true;
	}

function conv_traffic($bytes)
	{
	if ($bytes<1024)
		{
		$ret=$bytes."Bytes";
		}
	elseif($bytes<1048576)
		{
		$ret=round(($bytes/1024), 2)."KiB";
		}
	elseif($bytes<1073741824)
		{
		$ret=round(($bytes/1048576), 2)."MiB";
		}
	elseif($bytes<1099511627776)
		{
		$ret=round(($bytes/1073741824), 2)."GiB";
		}
	return $ret;
	}

function check_wi_version($wiversion, $wiversionurl)
	{
	$file=@file_get_contents($wiversionurl);
	$get_number=str_replace('beta', '', $wiversion);
	$get_number2=str_replace('beta', '', $file);
	if($wiversion==$file or $get_number>$get_number2)
		{
		return true;
		}
		else
		{
		return "<a class=\"warning\" href=\"http://www.ts3.cs-united.de/ts3wi/traffic.php?version=".$file."\" target=\"_blank\">".$file."</a>";
		}
	}
	
function check_server_version($serverversion, $seversionurl)
	{
	$file=@file_get_contents($seversionurl);
	$get_build=explode(' ', $serverversion);
	$get_build=str_replace(']', '', $get_build[2]);
	$get_build2=explode(' ', $file);
	$get_build2=str_replace(']', '', $get_build2[2]);
	if ($serverversion==$file OR $get_build>$get_build2)
		{
		return true;
		}
		else
		{
		return "<a class=\"warning\" href=\"http://www.teamspeak.com\" target=\"_blank\">".$file."</a>";
		}
	}
	
function parse_bbcode($txt)
	{
	$txt=str_replace("8)", "<img src='gfx/images/cool.png' alt='8)' />", $txt);
	$txt=str_replace(":-(", "<img src='gfx/images/sad.png' alt='8)' />", $txt);
	$txt=str_replace(":-)", "<img src='gfx/images/smile.png' alt='8)' />", $txt);
	$txt=str_replace(";-)", "<img src='gfx/images/twinkle.png' alt='8)' />", $txt);
	
	$txt=preg_replace("^\[b\](.*)\[/b\]^isU", "<b>$1</b>", $txt);
	$txt=preg_replace("^\[i\](.*)\[/i\]^isU", "<i>$1</i>", $txt);
	$txt=preg_replace("^\[u\](.*)\[/u\]^isU", "<u>$1</u>", $txt);
	$txt=preg_replace("^\[url\](.*)\[/url\]^isU", "<a href=\"$1\">$1</a>", $txt);
	$txt=preg_replace("^\[url=(.*)\](.*)\[/url\]^isU", "<a href=\"$1\">$2</a>", $txt);
	$txt=preg_replace("^\[color=(.*)\](.*)\[/color\]^isU", "<font color=\"$1\">$2</font>", $txt);
	$txt=preg_replace("^\[img\](.*)\[/img\]^isU", "<img src=\"$1\" alt=\"$1\" />", $txt);
	
	return $txt;
	}
?>