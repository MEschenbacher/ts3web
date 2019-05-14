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
error_reporting(E_ALL);
header("Content-Type: text/html; charset=utf-8");
define("SECURECHECK", 1);
session_start();
$_SESSION['pubviewer']=true;

function create_tree($pid, $place, $alldata, $sid, $ip, $showicons, $sub)
	{
	global $lang;
	global $ts3;
	$gettree='';
	if(!empty($alldata['channel']))
		{
		foreach($alldata['channel'] AS $key=>$value)
			{
			if ($pid==$value['pid'])
				{			
				$chan_img='';
				if(preg_match("^\[(.*)spacer([\w\p{L}\d]+)?\]^u", $value['channel_name'], $treffer) AND $value['pid']==0 AND $value['channel_flag_permanent']==1)
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
						$gettree .= "<div class='channel'><div class='place'></div><div class='channame'>".$spacer."</div></div><div class='clear'></div>";
						}
						elseif($treffer[1]=="c")
						{
						$spacer=explode($treffer[0], $value['channel_name']);
						$gettree .= "<div class='channel'><div class='place'></div><div class='channame' style=\"width:90%;text-align:center\">".$spacer[1]."</div></div><div class='clear'></div>";
						}
						elseif($treffer[1]=="r")
						{
						$spacer=explode($treffer[0], $value['channel_name']);
						$gettree .= "<div class='channel'><div class='place'></div><div class='channame' style=\"float:right\">".$spacer[1]."</div></div><div class='clear'></div>";
						}
						else
						{
						$spacer=explode($treffer[0], $value['channel_name']);
						$gettree .= "<div class='channel'><div class='place'></div><div class='channame'>".$spacer[1]."</div></div><div class='clear'></div>";
						}
					}
					else
					{
					$chanmaxclient=($value['channel_maxclients']=="-1" ? $alldata['server']['virtualserver_maxclients']:$value['channel_maxclients']);

					if($value['channel_flag_password']==1)
						{
						$chan_img="<img style=\"height:16px;width:16px\" src=\"gfx/images/password.png\" alt=\"\" />";
						}
					if($value['channel_flag_default']==1)
						{
						$chan_img.="<img style=\"height:16px;width:16px\" src=\"gfx/images/default.png\" alt=\"\" />";
						}
					if($value['channel_codec']==3 OR $value['channel_codec']==5)
						{
						$chan_img.="<img style=\"height:13px;width:16px\" src=\"gfx/images/music.png\" alt=\"\" />";
						}
					if($value['channel_needed_talk_power']>0)
						{
						$chan_img.="<img style=\"height:14px;width:14px\" src=\"gfx/images/moderated.png\" alt=\"\" />";
						}
						
					if($value['channel_icon_id']!=0)
						{
						if($value['channel_icon_id']<0)
							{
							$value['channel_icon_id']=sprintf('%u', $value['channel_icon_id'] & 0xffffffff);
							}
						if($value['channel_icon_id']!=100 AND $value['channel_icon_id']!=200 AND $value['channel_icon_id']!=300 AND $value['channel_icon_id']!=500 AND $value['channel_icon_id']!=600)
							{
							if(file_exists('icons/'.$ip.'-'.$alldata['server']['virtualserver_port'].'/icon_'.$value['channel_icon_id']))
								{
								$chan_img.="<img style=\"height:16px;width:16px\" src=\"site/showfile.php?name=icon_".$value['channel_icon_id']."&amp;port=".$alldata['server']['virtualserver_port']."&amp;ip=".$ip."\" alt=\"\" />";
								}
							}
							else
							{
							$chan_img.="<img style=\"height:16px;width:16px\" src=\"site/showfile.php?name=icon_".$value['channel_icon_id']."\" alt=\"\" />";
							}
						}	
						
					if($chanmaxclient<=$value['total_clients'] AND $value['channel_flag_password']==1)
						{
						$gettree .= "<div class='channel'>".$place."<div class='fullimg'></div><div class='channame'><a href=\"ts3server://".$ip."?port=".$alldata['server']['virtualserver_port']."&channel=".secure((empty($sub) ? '':$sub.'/').$value['channel_name'])."\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						elseif($chanmaxclient<=$value['total_clients'])
						{
						$gettree .= "<div class='channel'>".$place."<div class='fullimg'></div><div class='channame'><a href=\"ts3server://".$ip."?port=".$alldata['server']['virtualserver_port']."&channel=".secure((empty($sub) ? '':$sub.'/').$value['channel_name'])."\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						elseif($value['channel_flag_password']==1)
						{
						$gettree .= "<div class='channel'>".$place."<div class='pwchanimg'></div><div class='channame'><a href=\"ts3server://".$ip."?port=".$alldata['server']['virtualserver_port']."&channel=".secure((empty($sub) ? '':$sub.'/').$value['channel_name'])."\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						else
						{
						$gettree .= "<div class='channel'>".$place."<div class='chanimg'></div><div class='channame'><a href=\"ts3server://".$ip."?port=".$alldata['server']['virtualserver_port']."&channel=".secure((empty($sub) ? '':$sub.'/').$value['channel_name'])."\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
					}
				if($value['total_clients']>=1)
					{
					if(!empty($alldata['clients']))
						{
						foreach($alldata['clients'] AS $u_key=>$u_value)
							{
							if($value['cid'] == $u_value['cid'] AND $u_value['client_type']!="1")
								{
								
								$u_away_msg="";
								if($u_value['client_away']=="1")
									{
									$u_status="away";
									if(!empty($u_value['client_away_message']))	
										{
										$u_away_msg="<div class='away_msg'>(".secure($u_value['client_away_message']).")</div>";
										}
									}
								elseif($u_value['client_output_hardware']=="0")
									{
									$u_status="hwhead";
									}
								elseif($u_value['client_input_hardware']=="0")
									{
									$u_status="hwmic";
									}
								elseif($u_value['client_output_muted']=="1")
									{
									$u_status="head";
									}
								elseif($u_value['client_input_muted']=="1")
									{
									$u_status="mic";
									}
								elseif($u_value['client_flag_talking']=="0" AND $u_value['client_is_channel_commander']=="1")
									{
									$u_status="player_command";
									}
								elseif($u_value['client_flag_talking']=="1" AND $u_value['client_is_channel_commander']=="1")
									{
									$u_status="player_command_on";
									}
								elseif($u_value['client_flag_talking']=="1")
									{
									$u_status="player_on";
									}
								else
									{
									$u_status="player";
									}
								$g_img='';
								if(!empty($alldata['cgroups']))
									{
									foreach($alldata['cgroups'] AS $key=>$cg_value)
										{
										if($cg_value['cgid']==$u_value['client_channel_group_id'])
											{
											$iconid=$cg_value['iconid'];
											if($iconid<0)
												{
												$iconid=sprintf('%u', $iconid & 0xffffffff);
												}
											if($iconid!=0)
												{
												if($iconid!=100 AND $iconid!=200 AND $iconid!=300 AND $iconid!=500 AND $iconid!=600)
													{
													if(file_exists('icons/'.$ip.'-'.$alldata['server']['virtualserver_port'].'/icon_'.$iconid))
														{
														$g_img.="<img title=\"".$cg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."&amp;ip=".$ip."&amp;port=".$alldata['server']['virtualserver_port']."\" />";
														}
													}
													else
													{
													$g_img.="<img title=\"".$cg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."\" />";
													}
												}
											}
										}
									}
							
								$getsgroups=explode(',', trim($u_value['client_servergroups']));
								if(!empty($alldata['sgroups']))
									{
									foreach($alldata['sgroups'] AS $key=>$sg_value)
										{
										if(in_array($sg_value['sgid'], $getsgroups))
											{
											$iconid=$sg_value['iconid'];
											if($iconid<0)
												{
												$iconid=sprintf('%u', $iconid & 0xffffffff);
												}
											if($iconid!=0)
												{
												if($iconid!=100 AND $iconid!=200 AND $iconid!=300 AND $iconid!=500 AND $iconid!=600)
													{
													if(file_exists('icons/'.$ip.'-'.$alldata['server']['virtualserver_port'].'/icon_'.$iconid))
														{
														$g_img.="<img title=\"".$sg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."&amp;ip=".$ip."&amp;port=".$alldata['server']['virtualserver_port']."\" />";
														}
													}
													else
													{
													$g_img.="<img title=\"".$sg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."\" />";
													}
												}
											}
										}
									}
								
								if($u_value['client_icon_id']!=0)
									{
									if($u_value['client_icon_id']<0)
										{
										$u_value['client_icon_id']=sprintf('%u', $u_value['client_icon_id'] & 0xffffffff);
										}
									if($u_value['client_icon_id']!=100 AND $u_value['client_icon_id']!=200 AND $u_value['client_icon_id']!=300 AND $u_value['client_icon_id']!=500 AND $u_value['client_icon_id']!=600)
										{
										if(file_exists('icons/'.$ip.'-'.$alldata['server']['virtualserver_port'].'/icon_'.$u_value['client_icon_id']))
											{
											$g_img.="<img title=\"Client Icon\" src=\"site/showfile.php?name=icon_".$u_value['client_icon_id']."&amp;ip=".$ip."&amp;port=".$alldata['server']['virtualserver_port']."\" />";
											}
										}
										else
										{
										$g_img.="<img title=\"Client Icon\" src=\"site/showfile.php?name=icon_".$u_value['client_icon_id']."\" />";
										}
									}
							
								if(!empty($u_value['client_country']))
									{
									$g_img.="<img src=\"gfx/images/countries/".strtolower($u_value['client_country']).".png\" alt=\"\" />";
									}
								
								$gettree.= "<div class='client'>\n".$place."\n<div class='place'>&nbsp;</div>\n<div class='".$u_status."_img'></div>\n<div class='clientnick'>".secure($u_value['client_nickname'])."&nbsp;</div>\n<div style=\"float:".$showicons."\">".$g_img."</div>".$u_away_msg."<div style='clear:both'></div>\n</div>\n";
								}
							}
						}
					}
					if(empty($sub))
						{
						$sub2=$value['channel_name'];
						}
						else
						{
						$sub2=$sub.'/'.$value['channel_name'];
						}
				$gettree.=create_tree($value['cid'], $place."<div class='place'></div>", $alldata, $sid, $ip, $showicons, $sub2);
				}
			}
		}
	return $gettree;
	}

require("functions.inc.php");
require("config.php");
require("site/lang.php");
require("ts3admin.class.php");

$showicons='left';

if(isset($_GET['showicons']))
	{
	switch($_GET['showicons']) {
		case 'left':
		$showicons="left";
		break;
		case  'right':
		$showicons="right";
		break;
	}
	}
$tree='';
$bgcolor=isset($_GET['bgcolor']) ? secure($_GET['bgcolor']):'000000';
$fontcolor=isset($_GET['fontcolor']) ? secure($_GET['fontcolor']):'ffffff';

$ts3=new ts3admin($server[$_GET['skey']]['ip'], $server[$_GET['skey']]['tport']);

$con=$ts3->connect();
if($con['success']!==true)
	{
	$tree.=$con['errors'][0];;
	}
	else
	{
	$select=$ts3->selectServer($_GET['sid'], 'serverId');
	$whoami=$ts3->getElement('data', $ts3->whoAmI());
	if($select['success']!==true)
		{
		$tree.=$select['errors'][0];
		}
		else
		{
		$geticons=1;
		include("site/filetransfer.php");

		$alldata=array();
		$serverinfo=$ts3->serverInfo();
		$alldata['server']=$serverinfo['data'];
		$channellist=$ts3->channelList("-topic -flags -voice -limits -icon");
		$alldata['channel']=$channellist['data'];
		$clientlist=$ts3->clientList("-uid -away -voice -times -groups -info -icon -country");
		$alldata['clients']=$clientlist['data'];
		$sgrouplist=$ts3->serverGroupList();
		$alldata['sgroups']=$sgrouplist['data'];
		$cgrouplist=$ts3->channelGroupList();
		$alldata['cgroups']=$cgrouplist['data'];

		if(!empty($alldata['server']) AND !empty($alldata['channel']) AND !empty($alldata['clients']))
			{
			if($alldata['server']['virtualserver_icon_id']<0)
				{
				$alldata['server']['virtualserver_icon_id']=sprintf('%u', $alldata['server']['virtualserver_icon_id'] & 0xffffffff);
				}
				
			if($alldata['server']['virtualserver_icon_id']!=100 AND $alldata['server']['virtualserver_icon_id']!=200 AND $alldata['server']['virtualserver_icon_id']!=300 AND $alldata['server']['virtualserver_icon_id']!=500 AND $alldata['server']['virtualserver_icon_id']!=600)
				{
				$servericon=true;
				if(!file_exists('icons/'.$server[$_GET['skey']]['ip'].'-'.$alldata['server']['virtualserver_port'].'/icon_'.$alldata['server']['virtualserver_icon_id']))
					{
					$servericon=false;
					}	
				}
			$tree.="<div class='server_img'></div><div class='servername'><a href=\"ts3server://".$server[$_GET['skey']]['ip']."?port=".$alldata['server']['virtualserver_port']."\">".secure($alldata['server']['virtualserver_name'])."</a>&nbsp;</div><div style=\"float:".$showicons.";width:16px\">".($alldata['server']['virtualserver_icon_id']!=0 ? "<img src=\"site/showfile.php?name=icon_".$alldata['server']['virtualserver_icon_id']."&amp;ip=".$server[$_GET['skey']]['ip']."&amp;port=".$alldata['server']['virtualserver_port']."\" />":'')."</div><div class='clear'></div>";

			$tree.= create_tree(0, "<div class='place'></div>", $alldata, $_GET['sid'], $server[$_GET['skey']]['ip'], $showicons, '');
			}
			else
			{
			$tree.=$serverinfo['errors'][0]."<br />";
			$tree.=$channellist['errors'][0]."<br />";
			$tree.=$clientlist['errors'][0]."<br />";
			$tree.=$sgrouplist['errors'][0]."<br />";
			$tree.=$cgrouplist['errors'][0]."<br />";
			}
		}
	}
?>
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" /> 
<link rel="stylesheet" href="gfx/tsviewpub.css" type="text/css" media="screen" />
<style type="text/css">
body
	{
	font-family:verdana, sans-serif;
	}
div.content
	{
	background-color:<?php echo $bgcolor; ?>;
	color:<?php echo $fontcolor; ?>
	}
a:hover, a:visited, a:active, a:link
	{
	color:<?php echo $fontcolor; ?>
	}
</style>
</head>
<body>
<div class='content'>
<?php echo $tree; ?>
<div class="copy">&copy; <a class="copy" href="http://ts3.cs-united.de">Psychokiller</a></div>
</div>
</body>
</html>