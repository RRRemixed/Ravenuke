<?php
###############################################################
##X1plugin Competition Management
##Homepage::http://www.projectxnetwork.com
##Copyright:: Shane Andrusiak 2000-2006
##Version 2.5.5
###############################################################
if (!defined('X1plugin_include'))exit();
###############################################################
$c .= X1plugin_title(leaguemod_modinfotitle);
$c .= "
	<table class='".X1plugin_mapslist."' width='100%'>
    	<thead class='".X1plugin_tablehead."'>
			<tr>
				<th>&nbsp;</th>
			</tr>
		</thead>
		<tbody class='".X1plugin_tablebody."'>
			<tr>
				<td class='alt1'>".leaguemod_modinfodesc."</td>
			</tr>
		</tbody>
		<tfoot class='".X1plugin_tablefoot."'>
			<tr>
				<td>&nbsp;</td>
			</tr>
		</tfoot>
	</table>";
?>