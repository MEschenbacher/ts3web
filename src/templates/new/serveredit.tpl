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
	<tr valign="top">
		<td style="width:50%">
		<form method="post" action="index.php?site=serveredit&amp;sid={$sid}">
		<table  style="width:100%" class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="thead" colspan="2">{$lang['virtualserver']} #{$serverinfo['virtualserver_id']} {$lang['editor']} </td>
			</tr>
			<tr>
				<td class="green1" style="width:50%">{$lang['autostart']}:</td>
				<td class="green1" style="width:50%">
				{if isset($permoverview['b_virtualserver_modify_autostart']) AND empty($permoverview['b_virtualserver_modify_autostart'])}
					-
				{else}
					<select name="newsettings[virtualserver_autostart]">
						<option value="1" {if $serverinfo['virtualserver_autostart'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
						<option value="0" {if $serverinfo['virtualserver_autostart'] == 0}selected="selected"{/if}>{$lang['no']}</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2" style="width:50%">{$lang['port']}:</td>
				<td class="green2" style="width:50%">
				{if isset($permoverview['b_virtualserver_modify_port']) AND empty($permoverview['b_virtualserver_modify_port'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_port]" value="{$serverinfo['virtualserver_port']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1" style="width:50%">{$lang['minclientversion']}:</td>
				<td class="green1" style="width:50%">
				{if isset($permoverview['b_virtualserver_modify_min_client_version']) AND empty($permoverview['b_virtualserver_modify_min_client_version'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_min_client_version]" value="{$serverinfo['virtualserver_min_client_version']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['name']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_name']) AND empty($permoverview['b_virtualserver_modify_name'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_name]" value="{$serverinfo['virtualserver_name']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['welcomemsg']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_welcomemessage']) AND empty($permoverview['b_virtualserver_modify_welcomemessage'])}
					-
				{else}
					<textarea name="newsettings[virtualserver_welcomemessage]" rows="5" cols="30">{$serverinfo['virtualserver_welcomemessage']}</textarea>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxclients']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_maxclients']) AND empty($permoverview['b_virtualserver_modify_maxclients'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_maxclients]" value="{$serverinfo['virtualserver_maxclients']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['maxreservedslots']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_reserved_slots']) AND empty($permoverview['b_virtualserver_modify_reserved_slots'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_reserved_slots]" value="{$serverinfo['virtualserver_reserved_slots']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['showonweblist']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_weblist']) AND empty($permoverview['b_virtualserver_modify_weblist'])}
					-
				{else}
					<select name="newsettings[virtualserver_weblist_enabled]">
						<option value="1" {if $serverinfo['virtualserver_weblist_enabled'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
						<option value="0" {if $serverinfo['virtualserver_weblist_enabled'] == 0}selected="selected"{/if}>{$lang['no']}</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['codecencryptionmode']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_codec_encryption_mode']) AND empty($permoverview['b_virtualserver_modify_codec_encryption_mode'])}
					-
				{else}
					<select name="newsettings[virtualserver_codec_encryption_mode]">
					<option value="0" {if $serverinfo['virtualserver_codec_encryption_mode'] == 0}selected='selected'{/if}>{$lang['codecencryptionmodeindi']}</option>
					<option value="1" {if $serverinfo['virtualserver_codec_encryption_mode'] == 1}selected='selected'{/if}>{$lang['codecencryptionmodegoff']}</option>
					<option value="2" {if $serverinfo['virtualserver_codec_encryption_mode'] == 2}selected='selected'{/if}>{$lang['codecencryptionmodegon']}</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['passwordset']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_password']) AND empty($permoverview['b_virtualserver_modify_password'])}
					-
				{else}
					{if $serverinfo['virtualserver_flag_password'] == 1}{$lang['yes']}{else} {$lang['no']}{/if}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['securitylevel']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_needed_identity_security_level']) AND empty($permoverview['b_virtualserver_modify_needed_identity_security_level'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_needed_identity_security_level]" value="{$serverinfo['virtualserver_needed_identity_security_level']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['minclientschan']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_channel_forced_silence']) AND empty($permoverview['b_virtualserver_modify_channel_forced_silence'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_min_clients_in_channel_before_forced_silence]" value="{$serverinfo['virtualserver_min_clients_in_channel_before_forced_silence']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['iconid']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_icon_id']) AND empty($permoverview['b_virtualserver_modify_icon_id'])}
					-
				{else}
					<input id="iconid" type="text" name="newsettings[virtualserver_icon_id]" value="{$serverinfo['virtualserver_icon_id']}" /><a href="javascript:oeffnefenster('site/showallicons.php?ip={$smarty.session.server_ip}&amp;sid={$sid}&amp;port={$serverinfo['virtualserver_port']}');">{$lang['set']}</a>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['standardgroups']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['servergroup']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_default_servergroup']) AND empty($permoverview['b_virtualserver_modify_default_servergroup'])}
					-
				{else}
					<select name="newsettings[virtualserver_default_server_group]">
					{foreach key=key item=value from=$servergroups}
						{if $value['type'] == 1}
							<option {if $value['sgid'] == $serverinfo['virtualserver_default_server_group']}selected="selected"{/if} value="{$value['sgid']}">{$value['sgid']} {$value['name']}</option>
						{/if}
					{/foreach}
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['channelgroup']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_default_channelgroup']) AND empty($permoverview['b_virtualserver_modify_default_channelgroup'])}
					-
				{else}
					<select name="newsettings[virtualserver_default_channel_group]">
					{foreach key=key item=value from=$channelgroups}
						{if $value['type'] == 1}
							<option {if $value['cgid'] == $serverinfo['virtualserver_default_channel_group']}selected="selected"{/if} value="{$value['cgid']}">{$value['cgid']} {$value['name']}</option>
						{/if}
					{/foreach}
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['chanadmingroup']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_default_channeladmingroup']) AND empty($permoverview['b_virtualserver_modify_default_channeladmingroup'])}
					-
				{else}
					<select name="newsettings[virtualserver_default_channel_admin_group]">
					{foreach key=key item=value from=$channelgroups}
						{if $value['type'] == 1}
							<option {if $value['cgid'] == $serverinfo['virtualserver_default_channel_admin_group']}selected="selected"{/if} value="{$value['cgid']}">{$value['cgid']} {$value['name']}</option>
						{/if}
					{/foreach}
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['host']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostmessage']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_hostmessage']) AND empty($permoverview['b_virtualserver_modify_hostmessage'])}
					-
				{else}
					<textarea name="newsettings[virtualserver_hostmessage]" rows="5" cols="30">{$serverinfo['virtualserver_hostmessage']}</textarea>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostmessageshow']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_hostmessage']) AND empty($permoverview['b_virtualserver_modify_hostmessage'])}
					-
				{else}
				<select name="newsettings[virtualserver_hostmessage_mode]">
					<option value="0" {if $serverinfo['virtualserver_hostmessage_mode'] == 0}selected='selected'{/if}>{$lang['nomessage']}</option>
					<option value="1" {if $serverinfo['virtualserver_hostmessage_mode'] == 1}selected='selected'{/if}>{$lang['showmessagelog']}</option>
					<option value="2" {if $serverinfo['virtualserver_hostmessage_mode'] == 2}selected='selected'{/if}>{$lang['showmodalmessage']}</option>
					<option value="3" {if $serverinfo['virtualserver_hostmessage_mode'] == 3}selected='selected'{/if}>{$lang['modalandexit']}</option>
				</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hosturl']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_hostbanner']) AND empty($permoverview['b_virtualserver_modify_hostbanner'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_hostbanner_url]" value="{$serverinfo['virtualserver_hostbanner_url']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbannerurl']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_hostbanner']) AND empty($permoverview['b_virtualserver_modify_hostbanner'])}
					-
				{else}
					{if $serverinfo['virtualserver_hostbanner_gfx_url']!=''}
					<img style="width:350px" src="{$serverinfo['virtualserver_hostbanner_gfx_url']}" alt="" /><br />
					{/if}
					<input type="text" name="newsettings[virtualserver_hostbanner_gfx_url]" value="{$serverinfo['virtualserver_hostbanner_gfx_url']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbannerintval']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_hostbanner']) AND empty($permoverview['b_virtualserver_modify_hostbanner'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_hostbanner_gfx_interval]" value="{$serverinfo['virtualserver_hostbanner_gfx_interval']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttontooltip']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_hostbutton']) AND empty($permoverview['b_virtualserver_modify_hostbutton'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_hostbutton_tooltip]" value="{$serverinfo['virtualserver_hostbutton_tooltip']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbuttongfx']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_hostbutton']) AND empty($permoverview['b_virtualserver_modify_hostbutton'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_hostbutton_gfx_url]" value="{$serverinfo['virtualserver_hostbutton_gfx_url']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttonurl']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_hostbutton']) AND empty($permoverview['b_virtualserver_modify_hostbutton'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_hostbutton_url]" value="{$serverinfo['virtualserver_hostbutton_url']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['autoban']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['autobancount']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_complain']) AND empty($permoverview['b_virtualserver_modify_complain'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_complain_autoban_count]" value="{$serverinfo['virtualserver_complain_autoban_count']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['autobantime']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_complain']) AND empty($permoverview['b_virtualserver_modify_complain'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_complain_autoban_time]" value="{$serverinfo['virtualserver_complain_autoban_time']}" />{$lang['seconds']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['removetime']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_complain']) AND empty($permoverview['b_virtualserver_modify_complain'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_complain_remove_time]" value="{$serverinfo['virtualserver_complain_remove_time']}" />{$lang['seconds']}
				{/if}
				</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['antiflood']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointstickreduce']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_antiflood']) AND empty($permoverview['b_virtualserver_modify_antiflood'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_antiflood_points_tick_reduce]" value="{$serverinfo['virtualserver_antiflood_points_tick_reduce']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['pointsneededblockcmd']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_antiflood']) AND empty($permoverview['b_virtualserver_modify_antiflood'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_antiflood_points_needed_command_block]" value="{$serverinfo['virtualserver_antiflood_points_needed_command_block']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointsneededblockip']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_antiflood']) AND empty($permoverview['b_virtualserver_modify_antiflood'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_antiflood_points_needed_ip_block]" value="{$serverinfo['virtualserver_antiflood_points_needed_ip_block']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['transfers']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['upbandlimit']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_ft_settings']) AND empty($permoverview['b_virtualserver_modify_ft_settings'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_max_upload_total_bandwidth]" value="{$serverinfo['virtualserver_max_upload_total_bandwidth']}" />Byte/s
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['uploadquota']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_ft_quotas']) AND empty($permoverview['b_virtualserver_modify_ft_quotas'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_upload_quota]" value="{$serverinfo['virtualserver_upload_quota']}" />MiB
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['downbandlimit']}:</td>
				<td class="green1">
				{if isset($permoverview['b_virtualserver_modify_ft_settings']) AND empty($permoverview['b_virtualserver_modify_ft_settings'])}
					-
				{else}
					<input type="text" name="newsettings[virtualserver_max_download_total_bandwidth]" value="{$serverinfo['virtualserver_max_download_total_bandwidth']}" />Byte/s
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['downloadquota']}:</td>
				<td class="green2">
				{if isset($permoverview['b_virtualserver_modify_ft_quotas']) AND empty($permoverview['b_virtualserver_modify_ft_quotas'])}
					-
				{else}	
					<input type="text" name="newsettings[virtualserver_download_quota]" value="{$serverinfo['virtualserver_download_quota']}" />MiB
				{/if}
				</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['logs']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logclient']}:</td>
				<td class="green1">
				<select name="newsettings[virtualserver_log_client]">
					<option value="1" {if $serverinfo['virtualserver_log_client'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_client'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logquery']}:</td>
				<td class="green2">
				<select name="newsettings[virtualserver_log_query]">
					<option value="1" {if $serverinfo['virtualserver_log_query'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_query'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logchannel']}:</td>
				<td class="green1">
				<select name="newsettings[virtualserver_log_channel]">
					<option value="1" {if $serverinfo['virtualserver_log_channel'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_channel'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logpermissions']}:</td>
				<td class="green2">
				<select name="newsettings[virtualserver_log_permissions]">
					<option value="1" {if $serverinfo['virtualserver_log_permissions'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_permissions'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logserver']}:</td>
				<td class="green1">
				<select name="newsettings[virtualserver_log_server]">
					<option value="1" {if $serverinfo['virtualserver_log_server'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_server'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>	
			<tr>
				<td class="green2">{$lang['logfiletransfer']}:</td>
				<td class="green2">
				<select name="newsettings[virtualserver_log_filetransfer]">
					<option value="1" {if $serverinfo['virtualserver_log_filetransfer'] == 1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $serverinfo['virtualserver_log_filetransfer'] == 0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				</td>
			</tr>	
			<tr>
				<td class="green1">{$lang['option']}:</td>
				<td class="green1"><input class="button" type="submit" name="editserver" value="Edit" /></td>
			</tr>
		</table>
		</form>
		</td>
		<td style="width:50%" align="center">
		{if !isset($permoverview['b_virtualserver_modify_password']) OR $permoverview['b_virtualserver_modify_password'] == 1}
			<form method="post" action="index.php?site=serveredit&amp;sid={$sid}">
			<table class="border" cellpadding="1" cellspacing="0">
				<tr>
					<td class="thead" colspan="2">{$lang['serverpassword']}</td>
				</tr>
				<tr>
					<td class="green1">{$lang['newpassword']}:</td>
					<td class="green1">
					<input type="text" name="newsettings[virtualserver_password]" value=""/>
					</td>
				</tr>
				<tr>
					<td class="green2">{$lang['option']}:</td>
					<td class="green2"><input class="button" type="submit" name="editpw" value="Senden" /></td>
				</tr>
			</table>
			</form>
		{/if}
		</td>
	</tr>
</table>