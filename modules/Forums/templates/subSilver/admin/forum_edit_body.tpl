
<h1>{L_FORUM_TITLE}</h1>

<p>{L_FORUM_EXPLAIN}</p>

<form action="{S_FORUM_ACTION}" method="post">
</form>
<script language= "JavaScript">
<!--
function addUsername()
{
	len = document.post.usernames.length;
	if ( document.post.username.value == "" )
	{
		alert("Please enter a name!");
		document.post.username.value = "";
		return false;
	}
	for (i = 0; i < (document.post.usernames.length); i++)
	{
		if (document.post.usernames.options[i].text == document.post.username.value)
		{
			alert("Please enter a new unique name!");
			document.post.username.value = "";
			return false;
		}
	}
	if ( len > 9 )
	{
		alert("Please only enter a maximum of up to 10 names!");
		return false;
	}
	document.post.usernames.options[len] = new Option(document.post.username.value);
	document.post.usernames.options[len].text = document.post.username.value;

	updateUsername();
	document.post.username.value = "";
	return false;
}
function remUsername()
{
	for (i = 0; i < (document.post.usernames.length); i++)
	{
		if ( document.post.usernames.options[i].selected && document.post.usernames.options[i] != null )
		{
			document.post.usernames.options[i] = null;
			i = i - 1;
		}
	}
	updateUsername();
	return false;
}
function updateUsername()
{
	new_value = '';
	for (i = 0; i < document.post.usernames.length; i++)
	{
		if ( document.post.usernames.options[i] != null )
		{
			if ( i == 0 )
			{
				new_value = document.post.usernames.options[i].text;
			}
			else
			{
				new_value = new_value + "  |  " + document.post.usernames.options[i].text;
			}
		}
	}
	document.post.usernames_list.value = new_value;
}
//-->
</script>
<form action="{S_FORUM_ACTION}" method="post" name="post">
<!-- End ForumNews Advance //-->
  <table width="100%" cellpadding="4" cellspacing="1" border="0" class="forumline" align="center">
	<tr> 
	  <th class="thHead" colspan="2">{L_FORUM_SETTINGS}</th>
	</tr>
	<tr> 
	  <td class="row1">{L_FORUM_NAME}</td>
	  <td class="row2"><input type="text" size="25" name="forumname" value="{FORUM_NAME}" class="post" /></td>
	</tr>
	<tr> 
	  <td class="row1">{L_FORUM_DESCRIPTION}</td>
	  <td class="row2"><textarea rows="5" cols="45" wrap="virtual" name="forumdesc" class="post">{DESCRIPTION}</textarea></td>
	</tr>
	<tr> 
	  <td class="row1">{L_CATEGORY}</td>
	  <td class="row2"><select name="c">{S_CAT_LIST}</select></td>
	</tr>
	<tr> 
	  <td class="row1">{L_FORUM_STATUS}</td>
	  <td class="row2"><select name="forumstatus">{S_STATUS_LIST}</select></td>
	</tr>
      <tr>
        <td class="row1">{L_EVENTS_FORUM}</td>
        <td class="row2">{S_EVENTS_SELECT}</td>
      </tr>
	<tr> 
	  <td class="row1">{L_AUTO_PRUNE}</td>
	  <td class="row2"><table cellspacing="0" cellpadding="1" border="0">
		  <tr> 
			<td align="right" valign="middle">{L_ENABLED}</td>
			<td align="left" valign="middle"><input type="checkbox" name="prune_enable" value="1" {S_PRUNE_ENABLED} /></td>
		  </tr>
		  <tr> 
			<td align="right" valign="middle">{L_PRUNE_DAYS}</td>
			<td align="left" valign="middle">&nbsp;<input type="text" name="prune_days" value="{PRUNE_DAYS}" size="5" class="post" />&nbsp;{L_DAYS}</td>
		  </tr>
		  <tr> 
			<td align="right" valign="middle">{L_PRUNE_FREQ}</td>
			<td align="left" valign="middle">&nbsp;<input type="text" name="prune_freq" value="{PRUNE_FREQ}" size="5" class="post" />&nbsp;{L_DAYS}</td>
		  </tr>
	  </table></td>
	</tr>
	<tr> 
	  <td class="catBottom" colspan="2" align="center">{S_HIDDEN_FIELDS}<input type="submit" name="submit" value="{S_SUBMIT_VALUE}" class="mainoption" /></td>
	</tr>
  </table>
</form>
		
<br clear="all" />
