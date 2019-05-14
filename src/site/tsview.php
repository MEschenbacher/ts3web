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


function create_tree($pid, $place, $alldata, $sid, $showicons)
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
				$channelinfo  = "<table class=\'border\' style=\'width:300px\'>";
				$channelinfo .= "<tr><td style=\'width:300px\' class=\'thead\' colspan=\'2\'>".str_replace("'", "\'", secure($value['channel_name']))."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['channelid']."</td><td style=\'width:150px\' class=\'green1\'>".$value['cid']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['pid']."</td><td style=\'width:150px\' class=\'green2\'>".$value['pid']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['chanorder']."</td><td style=\'width:150px\' class=\'green1\'>".$value['channel_order']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['clients']."</td><td style=\'width:150px\' class=\'green2\'>".$value['total_clients']."/".($value['channel_maxclients']==-1 ? $alldata['server']['virtualserver_maxclients']:$value['channel_maxclients'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['familyclients']."</td><td style=\'width:150px\' class=\'green1\'>".$value['total_clients_family']."/".($value['channel_maxfamilyclients']==-1 ? $alldata['server']['virtualserver_maxclients']:$value['channel_maxfamilyclients'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['topic']."</td><td style=\'width:150px\' class=\'green2\'>".$value['channel_topic']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['permanent']."</td><td style=\'width:150px\' class=\'green1\'>".($value['channel_flag_permanent']==1 ? $lang['yes']:$lang['no'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['semipermanent']."</td><td style=\'width:150px\' class=\'green2\'>".($value['channel_flag_semi_permanent']==1 ? $lang['yes']:$lang['no'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['default']."</td><td style=\'width:150px\' class=\'green1\'>".($value['channel_flag_default']==1 ? $lang['yes']:$lang['no'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['password']."</td><td style=\'width:150px\' class=\'green2\'>".($value['channel_flag_password']==1 ? $lang['yes']:$lang['no'])."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['codec']."</td><td style=\'width:150px\' class=\'green1\'>".($value['channel_codec']==0 ? $lang['codec0']:($value['channel_codec']==1 ? $lang['codec1']:($value['channel_codec']==2 ? $lang['codec2']:($value['channel_codec']==3 ? $lang['codec3']:($value['channel_codec']==4 ? $lang['codec4']:($value['channel_codec']==5 ? $lang['codec5']:''))))))."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['codecquality']."</td><td style=\'width:150px\' class=\'green2\'>".$value['channel_codec_quality']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['neededtalkpower']."</td><td style=\'width:150px\' class=\'green1\'>".$value['channel_needed_talk_power']."</td></tr>";
				$channelinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['iconid']."</td><td style=\'width:150px\' class=\'green2\'>".$value['channel_icon_id']."</td></tr>";
				$channelinfo .= "</table>";
				
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
							if(file_exists('icons/'.$_SESSION['server_ip'].'-'.$alldata['server']['virtualserver_port'].'/icon_'.$value['channel_icon_id']))
								{
								$chan_img.="<img style=\"height:16px;width:16px\" src=\"site/showfile.php?name=icon_".$value['channel_icon_id']."&amp;port=".$alldata['server']['virtualserver_port']."\" alt=\"\" />";
								}
							}
							else
							{
							$chan_img.="<img style=\"height:16px;width:16px\" src=\"site/showfile.php?name=icon_".$value['channel_icon_id']."\" alt=\"\" />";
							}
						}	
						
					if($chanmaxclient<=$value['total_clients'] AND $value['channel_flag_password']==1)
						{
						$gettree .= "<div class='channel'>".$place."<div class='fullimg'></div><div class='channame' onmouseover=\"return escape('".$channelinfo."')\"><a href=\"javascript:oeffnefenster('site/filebrowser.php?sid=".$sid."&amp;cid=".$value['cid']."&amp;path=/');\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						elseif($chanmaxclient<=$value['total_clients'])
						{
						$gettree .= "<div class='channel'>".$place."<div class='fullimg'></div><div class='channame' onmouseover=\"return escape('".$channelinfo."')\"><a href=\"javascript:oeffnefenster('site/filebrowser.php?sid=".$sid."&amp;cid=".$value['cid']."&amp;path=/');\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						elseif($value['channel_flag_password']==1)
						{
						$gettree .= "<div class='channel'>".$place."<div class='pwchanimg'></div><div class='channame' onmouseover=\"return escape('".$channelinfo."')\"><a href=\"javascript:oeffnefenster('site/filebrowser.php?sid=".$sid."&amp;cid=".$value['cid']."&amp;path=/');\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
						}
						else
						{
						$gettree .= "<div class='channel'>".$place."<div class='chanimg'></div><div class='channame' onmouseover=\"return escape('".$channelinfo."')\"><a href=\"javascript:oeffnefenster('site/filebrowser.php?sid=".$sid."&amp;cid=".$value['cid']."&amp;path=/');\" >".secure($value['channel_name'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$chan_img."</div><div class='clear'></div></div>\n";
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
								
								$clientinfo  = "<table class=\'border\' style=\'width:300px\'>";
								$clientinfo .= "<tr><td style=\'width:300px\' class=\'thead\' colspan=\'2\'>".str_replace("'", "\'", secure($u_value['client_nickname']))."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['clid']."</td><td style=\'width:150px\' class=\'green1\'>".$u_value['clid']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['channelid']."</td><td style=\'width:150px\' class=\'green2\'>".$u_value['cid']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['cldbid']."</td><td style=\'width:150px\' class=\'green1\'>".$u_value['client_database_id']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['uniqueid']."</td><td style=\'width:150px\' class=\'green2\'>".$u_value['client_unique_identifier']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['away']."</td><td style=\'width:150px\' class=\'green1\'>".($u_value['client_away']==1 ? ($lang['yes']." ".$u_value['client_away_message']):$lang['no'])."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['version']."</td><td style=\'width:150px\' class=\'green1\'>".$u_value['client_version']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['platform']."</td><td style=\'width:150px\' class=\'green2\'>".$u_value['client_platform']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['talkpower']."</td><td style=\'width:150px\' class=\'green1\'>".$u_value['client_talk_power']."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['idle']."</td><td style=\'width:150px\' class=\'green2\'>".$ts3->convertSecondsToStrTime($u_value['client_idle_time']/1000)."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['lastonline']."</td><td style=\'width:150px\' class=\'green1\'>".date("d.m.Y", $u_value['client_lastconnected'])."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green2 tooltip\'>".$lang['created']."</td><td style=\'width:150px\' class=\'green2\'>".date("d.m.Y", $u_value['client_created'])."</td></tr>";
								$clientinfo .= "<tr><td style=\'width:150px\' class=\'green1 tooltip\'>".$lang['iconid']."</td><td style=\'width:150px\' class=\'green1\'>".$u_value['client_icon_id']."</td></tr>";
								$clientinfo .= "</table>";
								
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
													if(file_exists('icons/'.$_SESSION['server_ip'].'-'.$alldata['server']['virtualserver_sid'].'/icon_'.$iconid))
														{
														$g_img.="<img title=\"".$cg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."&amp;port=".$alldata['server']['virtualserver_port']."\" alt=\"\" />";
														}
													}
													else
													{
													$g_img.="<img title=\"".$cg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."\" alt=\"\" />";
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
													if(file_exists('icons/'.$_SESSION['server_ip'].'-'.$alldata['server']['virtualserver_port'].'/icon_'.$iconid))
														{
														$g_img.="<img title=\"".$sg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."&amp;port=".$alldata['server']['virtualserver_port']."\" alt=\"\" />";
														}
													}
													else
													{
													$g_img.="<img title=\"".$sg_value['name']."\" src=\"site/showfile.php?name=icon_".$iconid."\" alt=\"\" />";
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
										if(file_exists('icons/'.$_SESSION['server_ip'].'-'.$alldata['server']['virtualserver_port'].'/icon_'.$u_value['client_icon_id']))
											{
											$g_img.="<img title=\"Client Icon\" src=\"site/showfile.php?name=icon_".$u_value['client_icon_id']."&amp;port=".$alldata['server']['virtualserver_port']."\" alt=\"\" />";
											}
										}
										else
										{
										$g_img.="<img title=\"Client Icon\" src=\"site/showfile.php?name=icon_".$u_value['client_icon_id']."\" alt=\"\" />";
										}
									}
							
								if(!empty($u_value['client_country']))
									{
									$g_img.="<img src=\"gfx/images/countries/".strtolower($u_value['client_country']).".png\" alt=\"\" />";
									}
									
								$gettree .= "<div class='client'>".$place."<div class='place'>&nbsp;</div><div class='".$u_status."_img'></div><div class='clientnick'><a onmouseover=\"return escape('".$clientinfo."')\" href=\"javascript:oeffnefenster('site/interactive.php?sid=".$sid."&amp;clid=".$u_value['clid']."&amp;nick=".str_replace("'", "\'", secure($u_value['client_nickname']))."&amp;action=action');\">".secure($u_value['client_nickname'])."</a>&nbsp;</div><div style=\"float:".$showicons."\">".$g_img."</div>".$u_away_msg."<div style='clear:both'></div></div>\n";
								}
							}
						}
					}
				$gettree .= create_tree($value['cid'], $place."<div class='place'></div>", $alldata, $sid, $showicons);
				}
			}
		}
	return $gettree;
	}
$tree='';
$geticons=1;
include("site/filetransfer.php");

$alldata=array();
$alldata['server']=$ts3->getElement('data', $ts3->serverInfo());
$alldata['channel']=$ts3->getElement('data', $ts3->channelList("-topic -flags -voice -limits -icon"));
$alldata['clients']=$ts3->getElement('data', $ts3->clientList("-uid -away -voice -times -groups -info -icon -country"));
$alldata['sgroups']=$ts3->getElement('data', $ts3->serverGroupList());
$alldata['cgroups']=$ts3->getElement('data', $ts3->channelGroupList());

if(empty($alldata['server']) or empty($alldata['channel']) or empty($alldata['clients']))
	{
	$tree="<div>Server Offline</div>";
	}
	else
	{
	if($alldata['server']['virtualserver_icon_id']<0)
		{
		$alldata['server']['virtualserver_icon_id']=sprintf('%u', $alldata['server']['virtualserver_icon_id'] & 0xffffffff);
		}
		
	if($alldata['server']['virtualserver_icon_id']!=100 AND $alldata['server']['virtualserver_icon_id']!=200 AND $alldata['server']['virtualserver_icon_id']!=300 AND $alldata['server']['virtualserver_icon_id']!=500 AND $alldata['server']['virtualserver_icon_id']!=600)
		{
		$servericon=true;
		if(!file_exists('icons/'.$ip.'-'.$alldata['server']['virtualserver_port'].'/icon_'.$alldata['server']['virtualserver_icon_id']))
			{
			$servericon=false;
			}	
		}
		
	$tree.="<div class='server_img'></div><div class='servername'><a href=\"javascript:oeffnefenster('site/interactive.php?sid=".$sid."&amp;action=action');\">".secure($alldata['server']['virtualserver_name'])."</a>&nbsp;</div><div style='float:".$showicons.";width:16px'>".(($alldata['server']['virtualserver_icon_id']!=0) ? "<img src='site/showfile.php?name=icon_".$alldata['server']['virtualserver_icon_id']."&amp;port=".$alldata['server']['virtualserver_port']."' alt=\"\" />":'')."</div><div class='clear'></div>";
	$tree.=create_tree(0, "<div class='place'></div>", $alldata, $sid, $showicons); 
	}
$smarty->assign("tree", $tree);
?>