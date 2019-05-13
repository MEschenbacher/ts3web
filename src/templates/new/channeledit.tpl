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
		
		<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead">{$lang['channel']} {$lang['editor']}</td>
			</tr>
			<tr>
				<td class="green1" style="width:50%">{$lang['name']}:</td>
				<td class="green1" style="width:50%">
				<form method="post" action="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">
				{if isset($permoverview['b_channel_modify_name']) AND empty($permoverview['b_channel_modify_name'])}
					-
				{else}
				<input type="text" name="newsettings[channel_name]" value="{$channelinfo['channel_name']}" />
				<input class="button" type="submit" name="editchannelname" value="{$lang['rename']}" />
				{/if}
				</form>
				</td>
			</tr>
		</table>
		<form method="post" action="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">
		<table style="width:100%" class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="green2" style="width:50%">{$lang['topic']}:</td>
				<td class="green2" style="width:50%">
				{if isset($permoverview['b_channel_modify_topic']) AND empty($permoverview['b_channel_modify_topic'])}
					-
				{else}
					<input type="text" name="newsettings[channel_topic]" value="{if isset($channelinfo['channel_topic'])}{$channelinfo['channel_topic']}{/if}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['description']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_modify_description']) AND empty($permoverview['b_channel_modify_description'])}
					-
				{else}
					<input type="text" name="newsettings[channel_description]" value="{if isset($channelinfo['channel_description'])}{$channelinfo['channel_description']}{/if}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['codec']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_modify_codec']) AND empty($permoverview['b_channel_modify_codec'])}
					-
				{else}
					<select name="newsettings[channel_codec]">
					<option value="0" {if $channelinfo['channel_codec'] == '0'}selected="selected"{/if}>{$lang['codec0']}</option>
					<option value="1" {if $channelinfo['channel_codec'] == '1'}selected="selected"{/if}>{$lang['codec1']}</option>
					<option value="2" {if $channelinfo['channel_codec'] == '2'}selected="selected"{/if}>{$lang['codec2']}</option>
					<option value="3" {if $channelinfo['channel_codec'] == '3'}selected="selected"{/if}>{$lang['codec3']}</option>
					<option value="4" {if $channelinfo['channel_codec'] == '4'}selected="selected"{/if}>{$lang['codec4']}</option>
					<option value="5" {if $channelinfo['channel_codec'] == '5'}selected="selected"{/if}>{$lang['codec5']}</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['codecquality']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_modify_codec_quality']) AND empty($permoverview['b_channel_modify_codec_quality'])}
					-
				{else}
					<select name="newsettings[channel_codec_quality]">
					<option value="0" {if $channelinfo['channel_codec_quality'] == '0'}selected="selected"{/if}>0</option>
					<option value="1" {if $channelinfo['channel_codec_quality'] == '1'}selected="selected"{/if}>1</option>
					<option value="2" {if $channelinfo['channel_codec_quality'] == '2'}selected="selected"{/if}>2</option>
					<option value="3" {if $channelinfo['channel_codec_quality'] == '3'}selected="selected"{/if}>3</option>
					<option value="4" {if $channelinfo['channel_codec_quality'] == '4'}selected="selected"{/if}>4</option>
					<option value="5" {if $channelinfo['channel_codec_quality'] == '5'}selected="selected"{/if}>5</option>
					<option value="6" {if $channelinfo['channel_codec_quality'] == '6'}selected="selected"{/if}>6</option>
					<option value="7" {if $channelinfo['channel_codec_quality'] == '7'}selected="selected"{/if}>7</option>
					<option value="8" {if $channelinfo['channel_codec_quality'] == '8'}selected="selected"{/if}>8</option>
					<option value="9" {if $channelinfo['channel_codec_quality'] == '9'}selected="selected"{/if}>9</option>
					<option value="10" {if $channelinfo['channel_codec_quality'] == '10'}selected="selected"{/if}>10</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['codecunencrypted']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_modify_maxclients']) AND empty($permoverview['b_channel_modify_maxclients'])}
					-
				{else}
				<select name="newsettings[channel_codec_is_unencrypted]">
					<option value="1" {if $channelinfo['channel_codec_is_unencrypted']==1}selected="selected"{/if}>{$lang['yes']}</option>
					<option value="0" {if $channelinfo['channel_codec_is_unencrypted']==0}selected="selected"{/if}>{$lang['no']}</option>
				</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['maxclients']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_modify_maxclients']) AND empty($permoverview['b_channel_modify_maxclients'])}
					-
				{else}
					<input type="text" name="newsettings[channel_maxclients]" value="{$channelinfo['channel_maxclients']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxfamilyclients']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_modify_maxfamilyclients']) AND empty($permoverview['b_channel_modify_maxfamilyclients'])}
					-
				{else}
					<input type="text" name="newsettings[channel_maxfamilyclients]" value="{$channelinfo['channel_maxfamilyclients']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['type']}:</td>
				<td class="green1">
				{if !isset($permoverview['b_channel_modify_make_temporary']) or $permoverview['b_channel_modify_make_temporary'] == 1}
					{$lang['temporary']}<input type="radio" name="chantyp" value="0" {if $channelinfo['channel_flag_permanent'] == 0 AND $channelinfo['channel_flag_semi_permanent'] == 0}checked="checked"{/if} /><br/>
				{/if}
				{if !isset($permoverview['b_channel_modify_make_semi_permanent']) or $permoverview['b_channel_modify_make_semi_permanent'] == 1}
					{$lang['semipermanent']}<input type="radio" name="chantyp" value="1" {if $channelinfo['channel_flag_semi_permanent'] == 1}checked="checked"{/if} /><br/>
				{/if}
				{if !isset($permoverview['b_channel_modify_make_permanent']) or $permoverview['b_channel_modify_make_permanent'] == 1}
					{$lang['permanent']}<input type="radio" name="chantyp" value="2" {if $channelinfo['channel_flag_permanent'] == 1 AND $channelinfo['channel_flag_default']==0}checked="checked"{/if} /><br />
				{/if}
				{if !isset($permoverview['b_channel_modify_make_default']) or $permoverview['b_channel_modify_make_default'] == 1}
					{$lang['default']}<input type="radio" name="chantyp" value="3" {if $channelinfo['channel_flag_default'] == 1}checked="checked"{/if} />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxfamilyclientsinherited']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_modify_maxfamilyclients']) AND empty($permoverview['b_channel_modify_maxfamilyclients'])}
					-
				{else}
					<select name="newsettings[channel_flag_maxfamilyclients_inherited]">
					<option value="0" {if $channelinfo['channel_flag_maxfamilyclients_inherited'] == '0'}selected="selected"{/if}>0</option>
					<option value="1" {if $channelinfo['channel_flag_maxfamilyclients_inherited'] == '1'}selected="selected"{/if}>1</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['neededtalkpower']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_modify_needed_talk_power']) AND empty($permoverview['b_channel_modify_needed_talk_power'])}
					-
				{else}
					<input type="text" name="newsettings[channel_needed_talk_power]" value="{$channelinfo['channel_needed_talk_power']}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['phoneticname']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_modify_name']) AND empty($permoverview['b_channel_modify_name'])}
					-
				{else}
					<input type="text" name="newsettings[channel_name_phonetic]" value="{if isset($channelinfo['channel_name_phonetic'])}{$channelinfo['channel_name_phonetic']}{/if}" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['option']}:</td>
				<td class="green1"><input class="button" type="submit" name="editchannel" value="{$lang['edit']}" /></td>
			</tr>
		</table>
		</form>
		</td>
		<td style="width:50%">
		{if !isset($permoverview['b_channel_modify_password']) OR $permoverview['b_channel_modify_password'] == 1}
		<form method="post" action="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td class="thead" colspan="2">{$lang['channelpassword']}</td>
			</tr>
			<tr>
			<td class="green1">{$lang['passwordset']}:</td>
			<td class="green1">
			{if $channelinfo['channel_flag_password'] == 1}
				{$lang['yes']}
			{else}
				{$lang['no']}
			{/if}
			</td>
			</tr>
			<tr>
				<td class="green2">{$lang['newpassword']}:</td>
				<td class="green2">
				{if $channelinfo['channel_flag_default'] == 1}
					{$lang['defaultnopw']}
				{else}
				<input type="text" name="newsettings[channel_password]" value="" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['option']}:</td>
				<td class="green1">
				{if $channelinfo['channel_flag_default'] == 0}
					<input class="button" type="submit" name="editpw" value="{$lang['send']}" />
				{/if}
				</td>
			</tr>
		</table>
		</form>
		<br />
		{/if}
		{if !isset($permoverview['b_channel_modify_parent']) OR $permoverview['b_channel_modify_parent'] == 1}
		<form method="post" action="index.php?site=channeledit&amp;sid={$sid}&amp;cid={$cid}">
		<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead">{$lang['channelmove']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['moveto']}:</td>
				<td class="green1">
				<select name="move">
				<option value="0">{$lang['mainchannel']}</option>
				{foreach key=key item=value from=$channellist}
					{if $value['cid'] != $cid}
						<option value="{$value['cid']}">{$value['channel_name']}</option>
					{/if}
				{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['option']}:</td>
				<td class="green2"><input class="button" type="submit" name="movechan" value="{$lang['move']}" /></td>
			</tr>
		</table>
		</form>
		{/if}
		</td>
	</tr>
</table>