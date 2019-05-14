{if !empty($error) OR !empty($noerror)}
<table>
	{if !empty($error)}
	<tr>
		<td class="error">{$error}</td>
	</tr>
	{/if}
	{if !empty($noerror)}
	<tr>
		<td class="noerror">{$noerror}</td>
	</tr>
	{/if}
</table>
{/if}
<table style="width:100%" cellpadding="1" cellspacing="0">
{if $newserverversion !== true AND !empty($serverinfo['virtualserver_version'])}
	<tr>
		<td class="green1 warning center" colspan="2">{$lang['serverupdateav']}{$newserverversion}</td>
	</tr>
{/if}
<tr valign="top">

{if isset($permoverview['b_virtualserver_info_view']) AND empty($permoverview['b_virtualserver_info_view'])}
	<td style="width:50%">
	<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
	</td>
{else}
	<td style="width:50%">
	<form method="post" action="index.php?site=serverview&amp;sid={$sid}">
	<table class="border" style="width:100%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead" colspan="7">{$lang['msgtoserver']}</td>
		</tr>
		<tr>
			<td class="green1"><textarea style="width:375px" type="text" name="msgtoserver" size="100"></textarea></td>
			<td class="green1">
			<input type="hidden" name="sid" value="{$serverinfo['virtualserver_id']}" />
			<input style="width:60px" class="button" type="submit" name="sendmsg" value="{$lang['send']}" />
			</td>
		</tr>
	</table>
	</form>
	<br />
	<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
		<tr>
			<td class="center">
			<form method="post" action="index.php?site=serverview&amp;sid={$sid}">
			<input type="hidden" name="sid" value="{$serverinfo['virtualserver_id']}" />
			<input class="start" type="submit" name="start" value="" title="{$lang['start']}" />
			</form>
			</td>
			<td class="center">
			<form method="post" action="index.php?site=serverview&amp;sid={$sid}">
			<input type="hidden" name="sid" value="{$serverinfo['virtualserver_id']}" />
			<input class="stop" type="submit" name="stop" value="" title="{$lang['stop']}" onclick="return confirm('{$lang['stopservermsg']}')" />
			</form>
			</td>
		</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['virtualserver']} #{$serverinfo['virtualserver_id']}</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['basics']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['autostart']}:</td>
				<td class="green1">
				{if $serverinfo['virtualserver_autostart'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['serveraddress']}:</td>
				<td class="green2">{$smarty.session.server_ip}:{$serverinfo['virtualserver_port']}</td>
			</tr>
			<tr>
				<td class="green1" style="width:50%">{$lang['minclientversion']}:</td>
				<td class="green1" style="width:50%">{$serverinfo['virtualserver_min_client_version']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['uniqueid']}:</td>
				<td class="green2">{$serverinfo['virtualserver_unique_identifier']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['name']}:</td>
				<td class="green1">{$serverinfo['virtualserver_name']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['welcomemsg']}:</td>
				<td class="green2">{$serverinfo['virtualserver_welcomemessage']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['version']}:</td>
				<td class="green1">{$serverinfo['virtualserver_version']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['platform']}:</td>
				<td class="green2">{$serverinfo['virtualserver_platform']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['created']}:</td>
				<td class="green1">{$serverinfo['virtualserver_created']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['status']}:</td>
				<td class="green2">{$serverinfo['virtualserver_status']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['runtime']}:</td>
				<td class="green1">{$serverinfo['virtualserver_uptime']}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['clients']}:</td>
				<td class="green2">{$serverinfo['virtualserver_clientsonline']-$serverinfo['virtualserver_queryclientsonline']} / {$serverinfo['virtualserver_maxclients']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['queryclients']}:</td>
				<td class="green1">{$serverinfo['virtualserver_queryclientsonline']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxreservedslots']}:</td>
				<td class="green2">{$serverinfo['virtualserver_reserved_slots']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['showonweblist']}:</td>
				<td class="green1">
				{if $serverinfo['virtualserver_weblist_enabled'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}				
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['codecencryptionmode']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_codec_encryption_mode']==0}
				{$lang['codecencryptionmodeindi']}
				{elseif $serverinfo['virtualserver_codec_encryption_mode']==1}
				{$lang['codecencryptionmodegoff']}
				{elseif $serverinfo['virtualserver_codec_encryption_mode']==2}
				{$lang['codecencryptionmodegon']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['channel']}:</td>
				<td class="green1">{$serverinfo['virtualserver_channelsonline']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['minclientschan']}:</td>
				<td class="green2">{$serverinfo['virtualserver_min_clients_in_channel_before_forced_silence']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['clientsdimm']}:</td>
				<td class="green1">{$serverinfo['virtualserver_priority_speaker_dimm_modificator']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['passwordset']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_flag_password'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['securitylevel']}:</td>
				<td class="green1">{$serverinfo['virtualserver_needed_identity_security_level']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['iconid']}:</td>
				<td class="green2">{$serverinfo['virtualserver_icon_id']}</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['standardgroups']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['servergroup']}:</td>
				<td class="green1">
				{if !empty($servergroups)}
					{foreach key=key item=value from=$servergroups}
						{if $value['sgid'] == $serverinfo['virtualserver_default_server_group']}
							({$value['sgid']}){$value['name']}
						{/if}
					{/foreach}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['channelgroup']}:</td>
				<td class="green2">
				{if !empty($channelgroups)}
					{foreach key=key item=value from=$channelgroups}
						{if $value['cgid'] == $serverinfo['virtualserver_default_channel_group']}
							({$value['cgid']}){$value['name']}
						{/if}
					{/foreach}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['chanadmingroup']}:</td>
				<td class="green1">
				{if !empty($channelgroups)}
					{foreach key=key item=value from=$channelgroups}
						{if $value['cgid'] == $serverinfo['virtualserver_default_channel_admin_group']}
							({$value['cgid']}){$value['name']}
						{/if}
					{/foreach}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['host']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostmessage']}:</td>
				<td class="green1">{$serverinfo['virtualserver_hostmessage']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostmessageshow']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_hostmessage_mode'] == '0'}
					{$lang['nomessage']}
					{elseif $serverinfo['virtualserver_hostmessage_mode'] == '1'}
					{$lang['showmessagelog']}
					{elseif $serverinfo['virtualserver_hostmessage_mode'] == '2'}
					{$lang['showmodalmessage']}
					{elseif $serverinfo['virtualserver_hostmessage_mode'] == '3'}
					{$lang['modalandexit']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hosturl']}:</td>
				<td class="green1">{$serverinfo['virtualserver_hostbanner_url']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbannerurl']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_hostbanner_gfx_url']!=''}
				<img style="width:350px" src="{$serverinfo['virtualserver_hostbanner_gfx_url']}" alt="" /><br />
				{/if}
				{$serverinfo['virtualserver_hostbanner_gfx_url']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbannerintval']}:</td>
				<td class="green1">{$serverinfo['virtualserver_hostbanner_gfx_interval']}</td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttongfx']}:</td>
				<td class="green2">{$serverinfo['virtualserver_hostbutton_gfx_url']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbuttontooltip']}:</td>
				<td class="green1">{$serverinfo['virtualserver_hostbutton_tooltip']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttonurl']}:</td>
				<td class="green2">{$serverinfo['virtualserver_hostbutton_url']}</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['autoban']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['autobancount']}:</td>
				<td class="green2">{$serverinfo['virtualserver_complain_autoban_count']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['autobantime']}:</td>
				<td class="green1">{$serverinfo['virtualserver_complain_autoban_time']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['removetime']}:</td>
				<td class="green2">{$serverinfo['virtualserver_complain_remove_time']}</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['antiflood']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointstickreduce']}:</td>
				<td class="green1">{$serverinfo['virtualserver_antiflood_points_tick_reduce']}</td>
			</tr>
			<tr>
				<td class="green2">{$lang['pointsneededblockcmd']}:</td>
				<td class="green2">{$serverinfo['virtualserver_antiflood_points_needed_command_block']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointsneededblockip']}:</td>
				<td class="green1">{$serverinfo['virtualserver_antiflood_points_needed_ip_block']}</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['transfers']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['upbandlimit']}:</td>
				<td class="green1">{$serverinfo['virtualserver_max_upload_total_bandwidth']} Byte/s</td>
			</tr>
			<tr>
				<td class="green2">{$lang['uploadquota']}:</td>
				<td class="green2">{$serverinfo['virtualserver_upload_quota']} MiB</td>
			</tr>
			<tr>
				<td class="green1">{$lang['downbandlimit']}:</td>
				<td class="green1">{$serverinfo['virtualserver_max_download_total_bandwidth']} Byte/s</td>
			</tr>
			<tr>
				<td class="green2">{$lang['downloadquota']}:</td>
				<td class="green2">{$serverinfo['virtualserver_download_quota']} MiB</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['logs']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logclient']}:</td>
				<td class="green1">
				{if $serverinfo['virtualserver_log_client'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logquery']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_log_query'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logchannel']}:</td>
				<td class="green1">
				{if $serverinfo['virtualserver_log_channel'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logpermissions']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_log_permissions'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logserver']}:</td>
				<td class="green1">
				{if $serverinfo['virtualserver_log_server'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}	
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logfiletransfer']}:</td>
				<td class="green2">
				{if $serverinfo['virtualserver_log_filetransfer'] == 1}
					{$lang['yes']}
				{else}
					{$lang['no']}
				{/if}	
				</td>
			</tr>			
		</table>
		</td>
		<?php } ?>
		<td style="width:50%" align="center">
		<table style="width:100%" cellpadding="0" cellspacing="0">
			<tr>
				<td>
				<div class="content">
				{$tree}
				</div>
				</td>
			</tr>
			<tr>
				<td>
				{$lang['tsviewpubhtml']}
				<textarea rows="20" cols="20" style="width:445px; height:100px;" readonly="readonly" class="green1">{$pubtsview}</textarea>
				</td>
			</tr>
		</table>
		</td>
	{/if}
	</tr>
</table>
