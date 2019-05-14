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
$ip='';
$error='';
$noerror='';
$count_del=0;
if(isset($_GET['cid']) AND isset($_GET['path']) AND !isset($_GET['getfile']))
	{
	$flist=$ts3->getElement('data', $ts3->ftGetFileList($_GET['cid'], '', $_GET['path']));
	}
if(isset($_GET['getfile']) AND isset($_GET['cid']) AND isset($_GET['path']) AND isset($_GET['name']) AND isset($_GET['sid']))
	{
	session_start();
	require_once('../ts3admin.class.php');
	$ts3=new ts3admin($_SESSION['server_ip'], $_SESSION['server_tport']);
	$ts3->connect();
	$ts3->login($_SESSION['loginuser'], unserialize(base64_decode($_SESSION['loginpw'])));
	$ts3->selectServer($_GET['sid'], 'serverId');
	
	$ft=$ts3->ftInitDownload($_GET['path']."/".$_GET['name'], $_GET['cid']);
	if($ft['success']===true or empty($ft['data']['port']))
		{
		$con_ft=@fsockopen($_SESSION['server_ip'], $ft['data']['port'], $errnum, $errstr, 10);
		if($con_ft)
			{
			fputs($con_ft, $ft['data']['ftkey']);
			$data='';
			while (!feof($con_ft)) 
				{
				$data.= fgets($con_ft, 4096);
				}
			header('Content-Disposition: attachment; filename="'.$_GET['name'].'"');
			header('Content-Type: x-type/subtype');
			echo $data;
			}
			else
			{
			$error .= $lang['ftconerr']."<br />";
			}
		}
		else
		{
		$error .= $lang['ftiniterr']."<br />";
		}
	}

// Automatischer Icon Download
if(isset($geticons) AND $geticons==1)
	{
	if(isset($_GET['ip']))
		{
		$ip=$_GET['ip'];
		}
		elseif(isset($_SESSION['server_ip']))
		{
		$ip=$_SESSION['server_ip'];
		}
	if(!isset($port))
		{
		$port=$whoami['virtualserver_port'];
		}
	$count=0;

	$ft=$ts3->ftGetFileList(0, '', '/icons');
	
	if(is_dir('icons/'.$ip.'-'.$port.'/'))
			{
			$handler=@opendir('icons/'.$ip.'-'.$port.'/');
			}
			else
			{
			if(@mkdir('icons/'.$ip.'-'.$port.'/', 0777))
				{
				$handler=@opendir('icons/'.$ip.'-'.$port.'/');
				}
				else
				{
				$error.=$lang['iconfoldererr']."<br />";
				}
			}
		
		while($datei=readdir($handler))
			{
			$icon_arr[]=$datei;
			}
			
		$noIcon=0;
		if(!empty($ft['data']))
			{
			foreach($ft['data'] AS $key2=>$value2)
				{
				$foundIcons[]=$value2['name'];
				}
			}
		foreach($icon_arr AS $key=>$value)
			{
			if(!empty($ft['data']))
				{
				if($value!="." AND $value!=".." AND in_array($value, $foundIcons))
					{
					$noIcon=1;
					break;
					}
				if($noIcon==0)
					{
					if(@unlink('icons/'.$ip.'-'.$port.'/'.$value))
							{
							$count_del++;
							}
					}
				}
			elseif(strpos($ft['errors'][0], 'ErrorID: 2568 | Message: insufficient client permissions failed_permid')===false)
				{
				if($value!="." AND $value!="..")
					{
					if(@unlink('icons/'.$ip.'-'.$port.'/'.$value))
						{
						$count_del++;
						}
					}
				}
			}
			
	if(!empty($ft['data']))
		{	
		foreach($ft['data'] AS $key=>$value)
			{
			if(substr($value['name'], 0, 5)=='icon_')
				{
				if(!in_array($value['name'], $icon_arr))
					{
					$count++;
					$ft2=$ts3->ftInitDownload("/".$value['name'], 0);
					if($ft2['success']!==false AND !empty($ft2['data']['port']))
						{
						$con_ft=@fsockopen($ip, $ft2['data']['port'], $errnum, $errstr, 10);
						if($con_ft)
							{
							fputs($con_ft, $ft2['data']['ftkey']);
							$data='';
							while (!feof($con_ft)) 
								{
								$data.= fgets($con_ft, 4096);
								}
							$handler2=@fopen('icons/'.$ip.'-'.$port.'/'.$value['name'], "w+");
							if($handler2!==false)
								{
								fwrite($handler2, $data);
								fclose($handler2);
								}
								else
								{
								$error.=sprintf($lang['iconerr'], $ip, $port, $value['name'])."<br />";
								break;
								}
							}
							else
							{
							$error.= $lang['ftconerr']."<br />";
							break;
							}
						}
						else
						{
						$error.=$ft2['errors'][0]."<br />";
						}
					}
				}
			}
		if($count!=0 AND empty($error))
			{
			$noerror .= sprintf($lang['countnewicon'], $count)."<br />";
			}
		}
	if($count_del!=0)
			{
			$noerror .= sprintf($lang['countdelicon'], $count_del)."<br />";
			}
	}
?>