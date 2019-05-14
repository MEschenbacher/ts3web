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
{if isset($permoverview['b_virtualserver_token_list']) AND empty($permoverview['b_virtualserver_token_list'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<form method="post" action="index.php?site=token&amp;sid={$sid}">
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="7">{$lang['tokenlist']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['token']}</td>
		<td class="thead">{$lang['type']}</td>
		<td class="thead">{$lang['id1']}</td>
		<td class="thead">{$lang['id2']}</td>
		<td class="thead">{$lang['created']}</td>
		<td class="thead">{$lang['description']}</td>
		<td class="thead">{$lang['selectall']}<input type="checkbox" name="checkall" value="0" onclick="check(1)" /></td>
	</tr>
	{if !empty($tokenlist)}
		{foreach key=key item=value from=$tokenlist}
			{if $change_col % 2} {assign var=td_col value="green1"} {else} {assign var=td_col value="green2"} {/if}
			<tr>
				<td class="{$td_col} center">{$value['token']}</td>
				<td class="{$td_col} center">
				{if $value['token_type']==0}
					{$lang['servergroup']}
					{elseif $value['token_type'] == 1}
					{$lang['channelgroup']}
				{/if}
				</td>
				<td class="{$td_col} center">
				{if $value['token_type'] == 0}
					{foreach key=key2 item=value2 from=$sgrouplist}
						{if $value2['sgid'] == $value['token_id1']}
							{$value2['name']}
						{/if}
					{/foreach}
				{elseif $value['token_type'] == 1}
					{foreach key=key2 item=value2 from=$cgrouplist}
						{if $value2['cgid'] == $value['token_id1']}
							{$value2['name']}
						{/if}
					{/foreach}
				{/if}
				</td>
				<td class="{$td_col} center">
				{if $value['token_type']==1}
					{foreach key=key2 item=value2 from=$channellist}
						{if $value2['cid'] == $value['token_id2']}
							{$value2['channel_name']}
						{/if}
					{/foreach}
				{/if}
				</td>
				<td class="{$td_col} center">{$value['token_created']|date_format:"%d.%m.%Y - %H:%M:%S"}</td>
				<td class="{$td_col} center">{$value['token_description']}</td>
				<td class="{$td_col} center">
				{if !isset($permoverview['b_virtualserver_token_delete']) OR $permoverview['b_virtualserver_token_delete']==1}
				<input type="checkbox" name="token[]" value="{$value['token']}" />
				{/if}
				</td>
			</tr>
			{assign var=change_col value="`$change_col+1`"}
		{/foreach} 
		<tr>
			<td colspan="6">&nbsp;</td>
			<td align="center"><input type="submit" name="deltoken" value="{$lang['delete']}" /></td>
		</tr>
	{/if}
</table>
</form>
<br />
{/if}
{if isset($permoverview['b_virtualserver_token_add']) AND empty($permoverview['b_virtualserver_token_add'])}
	<table class="border" style="width:50%;" cellpadding="1" cellspacing="0">
		<tr>
			<td class="thead">{$lang['error']}</td>
		</tr>
		<tr>
			<td class="green1">{$lang['nopermissions']}</td>
		</tr>
	</table>
{else}
<form method="post" action="index.php?site=token&amp;sid={$sid}">
<table class="border" style="width:100%" cellpadding="1" cellspacing="0">
	<tr>
		<td class="thead" colspan="6">{$lang['createtoken']}</td>
	</tr>
	<tr>
		<td class="thead">{$lang['type']}</td>
		<td class="thead">{$lang['groups']}</td>
		<td class="thead">{$lang['channel']}</td>
		<td class="thead">{$lang['description']}</td>
		<td class="thead">{$lang['number']}</td>
		<td class="thead">{$lang['option']}</td>
	</tr>
	<tr>
		<td class="green1 center">
		<select name="tokentype" onchange="hide_select(this.value)">
			<option value="">{$lang['type']}</option>
			<option value="0">(0){$lang['servergroup']}</option>
			<option value="1">(1){$lang['channelgroup']}</option>
		</select>
		</td>
		<td class="green1 center">
		<div id="groups">
		<select id="servergroups" style="display:none" name="tokenid1_1">
		<optgroup label="{$lang['servergroups']}">
		{foreach key=key item=value from=$sgrouplist}
			{if $value['type'] != 0}
				<option value="{$value['sgid']}">({$value['sgid']}) {$value['name']}</option>
			{/if}
		{/foreach}
		</optgroup>
		</select>
		<select id="channelgroups" style="display:none" name="tokenid1_2">
		<optgroup label="{$lang['channelgroups']}">
		{foreach key=key item=value from=$cgrouplist}
			{if $value['type'] != 0}
				<option value="{$value['cgid']}">({$value['cgid']}) {$value['name']}</option>
			{/if}
		{/foreach}
		</optgroup>
		</select>
		</div>
		</td>
		<td class="green1 center">
		<select id="channel" style="display:none" name="tokenid2">
		<option value="0">{$lang['channel']}</option>
		{foreach key=key item=value from=$channellist}
			<option value="{$value['cid']}">{$value['channel_name']}</option>
		{/foreach}
		</select>
		</td>
		<td class="green1 center">
		<input type="text" name="description" value="" />
		</td>
		<td class="green1 center">
		<input type="text" name="number" size="3" value="1" />
		</td>
		<td class="green1 center">
		<input class="button" type="submit" name="addtoken" value="{$lang['create']}" />
		</td>
	</tr>
</table>
</form>
{/if}