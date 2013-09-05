{if isset($permoverview['b_virtualserver_channelgroup_client_list']) AND empty($permoverview['b_virtualserver_channelgroup_client_list'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
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
<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="7">{$lang['searchfor']}{$lang['client']}</td>
	</tr>
	<tr>
		<td class="green1" colspan="7">
		<form method="post" action="index.php?site=cgroupclients&amp;sid={$sid}&amp;cgid={$cgid}">
		<select name="searchby">
		<option value="cldbid">{$lang['cldbid']}</option>
		<option value="name">{$lang['name']}</option>
		</select>
		<input type="text" name="search" value="" />
		<input type="submit" name="sendsearch" value="{$lang['search']}" />
		</form>
		</td>
	</tr>
	<tr>
		<td class="thead" colspan="7">({$cgroupid}) {$cgroupname} {$lang['groupmember']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['channelid']}</td>
		<td class="thead">{$lang['channelname']}</td>
		<td class="thead">{$lang['clientdbid']}</td>
		<td class="thead">{$lang['clientname']}</td>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['lastonline']}</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
	{if !empty($groupclients)}
		{foreach key=key item=value from=$groupclients}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['cid']}</td>
				<td class="{$td_col} center">{secure($value['channel_name'])}</td>
				<td class="{$td_col} center">{$value['cldbid']}</td>
				<td class="{$td_col} center">{secure($value['client_nickname'])}</td>
				<td class="{$td_col} center">{$value['client_created']}</td>
				<td class="{$td_col} center">{$value['client_lastconnected']}</td>
				<td class="{$td_col} center">
				<form method="post" action="index.php?site=cgroupclients&amp;sid={$sid}&amp;cgid={$cgid}">
				<select name="cgid">
				{foreach key=key2 item=value2 from=$channelgroups}
					{if $value2['cgid'] != $cgroupid AND $value2['type'] != '0'}
					<option value="{$value2['cgid']}">({$value2['cgid']}){$value2['name']}</option>
					{/if}
				{/foreach}
				</select>
				<input type="hidden" name="cid" value="{$value['cid']}" />
				<input type="hidden" name="cldbid" value="{$value['cldbid']}" />
				<input type="submit" name="switchgroup" value="{$lang['switch']}" />
				</form>
				</td>
				
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach}
	{/if}
</table>
<br />
<form method="post" action="index.php?site=cgroupclients&amp;sid={$sid}&amp;cgid={$cgid}">
<table class="border" cellpadding="1" cellspacing="0">
	<tr>
		<td colspan="2" class="thead">{$lang['addclient']}</td>
	</tr>
	<tr>
		<td class="green1">{$lang['channel']}:</td>
		<td class="green1">
		<select name="cid">
		{foreach key=key item=value from=$channellist}
			<option value="{$value['cid']}">{$value['channel_name']}</option>
		{/foreach}
		</select>
		</td>
	</tr>
	<tr>
		<td class="green2">{$lang['cldbid']}:</td>
		<td class="green2"><input type="text" name="cldbid" value="" /></td>
	</tr>
	<tr>
		<td class="green1">{$lang['option']}:</td>
		<td class="green1"><input type="submit" name="addclient" value="{$lang['add']}" /></td>
	</tr>
</table>
</form>
{/if}