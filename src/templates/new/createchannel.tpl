{if isset($permoverview['b_channel_create_permanent']) AND isset($permoverview['b_channel_create_semi_permanent']) AND isset($permoverview['b_channel_create_temporary']) AND empty($permoverview['b_channel_create_permanent']) AND empty($permoverview['b_channel_create_semi_permanent']) AND empty($permoverview['b_channel_create_temporary'])}
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
<form method="post" action="index.php?site=createchannel&amp;sid={$sid}">
<table class="border" cellpadding="1" cellspacing="0">
			<tr>
				<td colspan="2" class="thead">{$lang['createachannel']}</td>
			</tr>
			<tr>
				<td class="green1">{$lang['pid']}:</td>
				<td class="green1">
				<select name="settings[cpid]">
					<option value="0">{$lang['mainchannel']}</option>
					{foreach key=key item=value from=$channellist}
					<option value="{$value['cid']}">{$value['channel_name']}</option>
					{/foreach}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['name']}:</td>
				<td class="green2"><input type="text" name="settings[channel_name]" value="" /></td>
			</tr>
			<tr>
				<td class="green1">{$lang['topic']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_create_with_topic']) AND empty($permoverview['b_channel_create_with_topic'])}
					-
				{else}
					<input type="text" name="settings[channel_topic]" value="" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['description']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_create_with_description']) AND empty($permoverview['b_channel_create_with_description'])}
					-
				{else}
					<input type="text" name="settings[channel_description]" value="" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['codec']}:</td>
				<td class="green1">
				<select name="settings[channel_codec]">
				{if !isset($permoverview['b_channel_create_modify_with_codec_speex8']) OR $permoverview['b_channel_create_modify_with_codec_speex8']==1}
					<option value="0">{$lang['codec0']}</option>
				{/if}
				{if !isset($permoverview['b_channel_create_modify_with_codec_speex16']) OR $permoverview['b_channel_create_modify_with_codec_speex16']==1}
					<option value="1">{$lang['codec1']}</option>
				{/if}
				{if !isset($permoverview['b_channel_create_modify_with_codec_speex32']) OR $permoverview['b_channel_create_modify_with_codec_speex32']==1}
				<option value="2">{$lang['codec2']}</option>
				{/if}
				{if !isset($permoverview['b_channel_create_modify_with_codec_celtmono48']) OR $permoverview['b_channel_create_modify_with_codec_celtmono48']==1}
					<option value="3">{$lang['codec3']}</option>
				{/if}
				{if !isset($permoverview['b_channel_create_modify_with_codec_opusvoice']) OR $permoverview['b_channel_create_modify_with_codec_opusvoice']==1}
					<option value="3">{$lang['codec4']}</option>
				{/if}
				{if !isset($permoverview['b_channel_create_modify_with_codec_opusmusic']) OR $permoverview['b_channel_create_modify_with_codec_opusmusic']==1}
					<option value="3">{$lang['codec5']}</option>
				{/if}
				</select>
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['codecquality']}:</td>
				<td class="green2">
				{if isset($permoverview['i_channel_create_modify_with_codec_maxquality']) AND empty($permoverview['i_channel_create_modify_with_codec_maxquality'])}
					-
				{else}
					<select name="settings[channel_codec_quality]">
					<option value="0">0</option>
					<option value="1">1</option>
					<option value="2">2</option>
					<option value="3">3</option>
					<option value="4">4</option>
					<option value="5">5</option>
					<option value="6">6</option>
					<option value="7">7</option>
					<option value="8">8</option>
					<option value="9">9</option>
					<option value="10">10</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['maxclients']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_create_with_maxclients']) AND empty($permoverview['b_channel_create_with_maxclients'])}
					-
				{else}
					<input type="text" name="settings[channel_maxclients]" value="-1" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxfamilyclients']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_create_with_maxfamilyclients']) AND empty($permoverview['b_channel_create_with_maxfamilyclients'])}
					-
				{else}
					<input type="text" name="settings[channel_maxfamilyclients]" value="-1" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['type']}:</td>
				<td class="green1">
				{if !isset($permoverview['b_channel_create_semi_permanent']) OR $permoverview['b_channel_create_semi_permanent']==1}
					{$lang['semipermanent']} <input type="radio" name="chantyp" value="1" checked="checked" /><br/>
				{/if}
				{if !isset($permoverview['b_channel_create_permanent']) OR $permoverview['b_channel_create_permanent']==1}
					{$lang['permanent']} <input type="radio" name="chantyp" value="2" /><br />
				{/if}
				{if !isset($permoverview['b_channel_create_with_default']) OR $permoverview['b_channel_create_with_default']==1}
					{$lang['default']} <input type="radio" name="chantyp" value="3" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['maxfamilyclientsinherited']}:</td>
				<td class="green2">
				{if isset($permoverview['b_channel_create_with_maxclients']) AND empty($permoverview['b_channel_create_with_maxclients'])}
					-
				{else}
					<select name="settings[channel_flag_maxfamilyclients_inherited]">
					<option value="0">0</option>
					<option value="1">1</option>
					</select>
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green1">{$lang['neededtalkpower']}:</td>
				<td class="green1">
				{if isset($permoverview['b_channel_create_with_needed_talk_power']) AND empty($permoverview['b_channel_create_with_needed_talk_power'])}
					-
				{else}
					<input type="text" name="settings[channel_needed_talk_power]" value="0" />
				{/if}
				</td>
			</tr>
			<tr>
				<td class="green2">{$lang['phoneticname']}:</td>
				<td class="green2"><input type="text" name="settings[channel_name_phonetic]" value="" /></td>
			</tr>
			<tr>
				<td class="green1">{$lang['option']}:</td>
				<td class="green1"><input type="submit" name="createchannel" value="{$lang['create']}" /></td>
			</tr>
		</table>
		</form>
{/if}