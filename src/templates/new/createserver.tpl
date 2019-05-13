{if $hoststatus === false AND $serverhost === true}
<table>
	<tr>
		<td class="error">{$lang['nohoster']}</td>
	</tr>
</table>
{else}
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
{if !isset($smarty.post.createserver) OR !empty($error)}
<form method="post" action="index.php?site=createserver">
<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2">{$lang['createserverdesc']}</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['createnewserver']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['name']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_name]" value="{$screate_tmp['name']}"/></td>
			</tr>
			<tr>
				<td class="green2" style="width:50%">{$lang['port']}:</td>
				<td class="green2" style="width:50%"><input type="text" name="newsettings[virtualserver_port]" value="{$screate_tmp['port']}"/></td>
			</tr>
			<tr>
				<td class="green1" style="width:50%">{$lang['minclientversion']}:</td>
				<td class="green1" style="width:50%"><input type="text" name="newsettings[virtualserver_min_client_version]" value="{$screate_tmp['minclientversion']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['welcomemsg']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_welcomemessage]" value="{$screate_tmp['welcomemsg']}"/>
			</td>
			</tr>
			<tr>
				<td class="green1">{$lang['maxclients']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_maxclients]" value="{$screate_tmp['maxclients']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxreservedslots']}:</td>
				<td class="green2">
				<input type="text" name="newsettings[virtualserver_reserved_slots]" value="{$screate_tmp['reservedslots']}"/>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['showonweblist']}:</td>
				<td class="green1">
				<input type="text" name="newsettings[virtualserver_weblist_enabled]" value="{$screate_tmp['showonweblist']}"/>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['password']}:</td>
				<td class="green2">
				<input type="text" name="newsettings[virtualserver_password]" value="{$screate_tmp['password']}"/>
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['securitylevel']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_needed_identity_security_level]" value="{$screate_tmp['securitylvl']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['minclientschan']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_min_clients_in_channel_before_forced_silence]" value="{$screate_tmp['forcesilence']}"/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['host']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostmessage']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_hostmessage]" value="{$screate_tmp['hostmsg']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostmessageshow']}:</td>
				<td class="green2">
				{$lang['nomessage']} <input {if $screate_tmp['hostmsgshow'] === '0'} checked="checked" {/if} type="radio" name="newsettings[virtualserver_hostmessage_mode]" value="0" /><br />
				{$lang['showmessagelog']} <input {if $screate_tmp['hostmsgshow'] === '1'} checked="checked" {/if} type="radio" name="newsettings[virtualserver_hostmessage_mode]" value="1" /><br />
				{$lang['showmodalmessage']} <input {if $screate_tmp['hostmsgshow'] === '2'} checked="checked" {/if} type="radio" name="newsettings[virtualserver_hostmessage_mode]" value="2" /><br />
				{$lang['modalandexit']} <input {if $screate_tmp['hostmsgshow'] === '3'} checked="checked" {/if} type="radio" name="newsettings[virtualserver_hostmessage_mode]" value="3" />
				</td>
			</tr>
			<tr>
				<td class="green1" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green1">{$lang['hosturl']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_hostbanner_url]" value="{$screate_tmp['hosturl']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbannerurl']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_hostbanner_gfx_url]" value="{$screate_tmp['hostbannerurl']}"/></td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbannerintval']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_hostbanner_gfx_interval]" value="{$screate_tmp['hostbannerint']}"/></td>
			</tr>
			<tr>
				<td class="green2" colspan="2">&nbsp;</td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttongfx']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_hostbutton_gfx_url]" value="{$screate_tmp['hostbuttongfx']}"/></td>
			</tr>
			<tr>
				<td class="green1">{$lang['hostbuttontooltip']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_hostbutton_tooltip]" value="{$screate_tmp['hostbuttontip']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['hostbuttonurl']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_hostbutton_url]" value="{$screate_tmp['hostbuttonurl']}"/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['autoban']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['autobancount']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_complain_autoban_count]" value="{$screate_tmp['autobancount']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['autobantime']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_complain_autoban_time]" value="{$screate_tmp['autobantime']}"/> {$lang['seconds']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['removetime']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_complain_remove_time]" value="{$screate_tmp['removetime']}"/> {$lang['seconds']}</td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['antiflood']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointstickreduce']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_antiflood_points_tick_reduce]" value="{$screate_tmp['pointstickreduce']}"/></td>
			</tr>
			<tr>
				<td class="green2">{$lang['pointsneededblockcmd']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_antiflood_points_needed_command_block]" value="{$screate_tmp['pointsneededblockcmd']}"/></td>
			</tr>
			<tr>
				<td class="green1">{$lang['pointsneededblockip']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_antiflood_points_needed_ip_block]" value="{$screate_tmp['pointsneededblockip']}"/></td>
			</tr>
			<tr>
				<td class="thead" colspan="2">{$lang['transfers']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['upbandlimit']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_max_upload_total_bandwidth]" value="{$screate_tmp['uploadbandwidthlimit']}"/> Byte/s</td>
			</tr>
			<tr>
				<td class="green2">{$lang['uploadquota']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_upload_quota]" value="{$screate_tmp['uploadquota']}"/> MiB</td>
			</tr>
			<tr>
				<td class="green1">{$lang['downbandlimit']}:</td>
				<td class="green1"><input type="text" name="newsettings[virtualserver_max_download_total_bandwidth]" value="{$screate_tmp['downloadbandwidthlimit']}"/> Byte/s</td>
			</tr>
			<tr>
				<td class="green2">{$lang['downloadquota']}:</td>
				<td class="green2"><input type="text" name="newsettings[virtualserver_download_quota]" value="{$screate_tmp['downloadquota']}"/> MiB</td>
			</tr>
			<tr>
				<td class="maincat" colspan="2">{$lang['logs']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logclient']}:</td>
				<td class="green1">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_client]" value="1" {if $screate_tmp['virtualserver_log_client'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_client]" value="0" {if $screate_tmp['virtualserver_log_client'] === '0'}checked="checked"{/if} />
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logquery']}:</td>
				<td class="green2">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_query]" value="1" {if $screate_tmp['virtualserver_log_query'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_query]" value="0" {if $screate_tmp['virtualserver_log_query'] === '0'}checked="checked"{/if} />
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logchannel']}:</td>
				<td class="green1">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_channel]" value="1" {if $screate_tmp['virtualserver_log_channel'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_channel]" value="0" {if $screate_tmp['virtualserver_log_channel'] === '0'}checked="checked"{/if} />
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['logpermissions']}:</td>
				<td class="green2">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_permissions]" value="1" {if $screate_tmp['virtualserver_log_permissions'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_permissions]" value="0" {if $screate_tmp['virtualserver_log_permissions'] === '0'}checked="checked"{/if} />
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['logserver']}:</td>
				<td class="green1">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_server]" value="1" {if $screate_tmp['virtualserver_log_server'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_server]" value="0" {if $screate_tmp['virtualserver_log_server'] === '0'}checked="checked"{/if} />
				</td>
			</tr>	
			<tr>
				<td class="green2">{$lang['logfiletransfer']}:</td>
				<td class="green2">
					{$lang['yes']}<input type="radio" name="newsettings[virtualserver_log_filetransfer]" value="1" {if $screate_tmp['virtualserver_log_filetransfer'] === '1'}checked="checked"{/if} />
					{$lang['no']}<input type="radio" name="newsettings[virtualserver_log_filetransfer]" value="0" {if $screate_tmp['virtualserver_log_filetransfer'] === '0'}checked="checked"{/if} />
				</td>
			</tr>	
	<tr>
		<td class="green1">{$lang['option']}</td>
		<td class="green1"><input class="button" type="submit" name="createserver" value="{$lang['create']}" /></td>
	</tr>
</table>
</form>
{/if}
{/if}