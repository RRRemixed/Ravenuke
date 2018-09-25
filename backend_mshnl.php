<?php
/************************************************************************/
/* PHP-NUKE: Web Portal System                                          */
/* ===========================                                          */
/*                                                                      */
/* Copyright (c) 2002 by Francisco Burzi                                */
/* http://phpnuke.org                                                   */
/*                                                                      */
/* This program is free software. You can redistribute it and/or modify */
/* it under the terms of the GNU General Public License as published by */
/* the Free Software Foundation; either version 2 of the License.       */
/************************************************************************/
/************************************************************************
* Script:     HTML Newsletter module for PHP-Nuke 6.5 - 7.6
* Version:    01.03.02
* Author:     Rob Herder (aka: montego) of montegoscripts.com
* Contact:    montego@montegoscripts.com
* Copyright:  Copyright © 2006 by Montego Scripts
* License:    GNU/GPL (see provided LICENSE.txt file)
************************************************************************/
/************************************************************************
* Rev Date      Change ID       Description
* -----------   --------------  -----------------------------------------
* 16-MAY-2006   RN_0000185      Make XHTML 1.0 Compliant, plus better use of quotes
* 12-MAR-2006   MSNL_010301_01  Add backend RSS interface
************************************************************************/
/************************************************************************
* This is a backend RSS/XML feed producer script that is configurable by
* newsletter category.  Since RSS/XML feeds by their very nature are
* "anonymous", ONLY newsletters that are of this type are listed.
************************************************************************/
include_once('mainfile.php');
/***********************************************************************/
/************************************************************************
* CONFIGURE THE NEWSLETTER BACKEND FEED USING THE BELOW VARIABLES
*
* Newsletters will be presented in sorted order of send date. Also comes
* pre-configured to present the two categories which come with the module.
************************************************************************/
/***********************************************************************/

$msnl_iUseCats = 0;              //1 = Use category selection, 0 = All categories
$msnl_sCats = '';                //Use an empty string to pull ALL categories
$msnl_iUseGTNG = 1;              //1 = Use GT-NextGEn (GoogleTap) URLs, 0 = standard URLs
$msnl_sRSSTitle = 'Newsletters'; //Change this label to whatever you like for your RSS feed

/***********************************************************************/
/************************************************************************
* YOU SHOULD NOT HAVE TO MODIFY ANYTHING BELOW THIS LINE
************************************************************************/
/***********************************************************************/

global $prefix, $db, $nukeurl;

$result = '';
$row = '';
$msnl_sCats	= str_replace(' ', '', $msnl_sCats);

if ($msnl_iUseCats == 1 && !empty($msnl_sCats)) {
	$sql = 'SELECT `nid`, `topic` FROM `'.$prefix.'_hnl_newsletters` WHERE `cid` IN ('.$msnl_sCats.') AND `view` = 0 ORDER BY `datesent` DESC';
} else {
	$sql = 'SELECT `nid`, `topic` FROM `'.$prefix.'_hnl_newsletters` WHERE `view` = 0 ORDER BY `datesent` DESC';
}

$gmtdiff = date('O', time());
$gmtstr = substr($gmtdiff, 0, 3) . ':' . substr($gmtdiff, 3, 9);
$now = date('Y-m-d\TH:i:s', time());
$now = $now . $gmtstr;

header('Content-Type: application/xml;charset=iso-8859-1');
echo '<?xml version="1.0" encoding="iso-8859-1"?>'."\n";
echo '<rss version="2.0" '."\n";
echo '  xmlns:dc="http://purl.org/dc/elements/1.1/"'."\n";
echo '  xmlns:sy="http://purl.org/rss/1.0/modules/syndication/"'."\n";
echo '  xmlns:admin="http://webns.net/mvcb/"'."\n";
echo '  xmlns:rdf="http://www.w3.org/1999/02/22-rdf-syntax-ns#">'."\n\n";
echo '<channel>'."\n";
echo '<title>'.entity_to_decimal_value($sitename).'</title>'."\n";
if ($msnl_iUseGTNG == 1) { //Use shortened URLs
	echo '<link>'.$nukeurl.'/html_newsletter.html</link>'."\n";
} else { //Use normal URLs
	echo '<link>'.$nukeurl.'/modules.php?name=HTML_Newsletter</link>'."\n";
}
echo '<description>'.htmlspecialchars($backend_title).' - '.$msnl_sRSSTitle.'</description>'."\n";
echo '<dc:language>'.$backend_language.'</dc:language>'."\n";
echo '<dc:creator>'.$adminmail.'</dc:creator>'."\n";
echo '<dc:date>'.$now.'</dc:date>'."\n\n";
echo '<sy:updatePeriod>hourly</sy:updatePeriod>'."\n";
echo '<sy:updateFrequency>1</sy:updateFrequency>'."\n";
echo '<sy:updateBase>'.$now.'</sy:updateBase>'."\n\n";

$result = $db->sql_query($sql);
$resultcount = $db->sql_numrows($result);

if ($result > 0 && $resultcount > 0) { //Had results
	while ($row = $db->sql_fetchrow($result)) {
		$msnl_iNID = intval($row['nid']);
		$msnl_sTopic = stripslashes($row['topic']);
		echo '<item>'."\n";
		$rtitle = entity_to_decimal_value(str_replace('_', ' ', $msnl_sTopic));
		echo '<title>'.$rtitle.'</title>'."\n";
		if ($msnl_iUseGTNG == 1) { //Use shortened URLs
			echo '<link>'.$nukeurl.'/html_newsletter-'.$msnl_iNID.'.html</link>'."\n";
		} else { //Use normal URLs
			echo '<link>'.$nukeurl.'/modules.php?name=HTML_Newsletter&amp;op=msnl_nls_view&amp;msnl_nid='.$msnl_iNID.'</link>'."\n";
		}
		echo '<description>'.$rtitle.'</description>'."\n";
		echo '</item>'."\n\n";
	}
} //End IF to check for valid results

echo '</channel>'."\n";
echo '</rss>';

/* entity to unicode decimal value */
function entity_to_decimal_value($string) {

	static $entity_to_decimal = array(
		'&nbsp;' => '&#160;',
		'&iexcl;' => '&#161;',
		'&cent;' => '&#162;',
		'&pound;' => '&#163;',
		'&curren;' => '&#164;',
		'&yen;' => '&#165;',
		'&brvbar;' => '&#166;',
		'&sect;' => '&#167;',
		'&uml;' => '&#168;',
		'&copy;' => '&#169;',
		'&ordf;' => '&#170;',
		'&laquo;' => '&#171;',
		'&not;' => '&#172;',
		'&shy;' => '&#173;',
		'&reg;' => '&#174;',
		'&macr;' => '&#175;',
		'&deg;' => '&#176;',
		'&plusmn;' => '&#177;',
		'&sup2;' => '&#178;',
		'&sup3;' => '&#179;',
		'&acute;' => '&#180;',
		'&micro;' => '&#181;',
		'&para;' => '&#182;',
		'&middot;' => '&#183;',
		'&cedil;' => '&#184;',
		'&sup1;' => '&#185;',
		'&ordm;' => '&#186;',
		'&raquo;' => '&#187;',
		'&frac14;' => '&#188;',
		'&frac12;' => '&#189;',
		'&frac34;' => '&#190;',
		'&iquest;' => '&#191;',
		'&Agrave;' => '&#192;',
		'&Aacute;' => '&#193;',
		'&Acirc;' => '&#194;',
		'&Atilde;' => '&#195;',
		'&Auml;' => '&#196;',
		'&Aring;' => '&#197;',
		'&AElig;' => '&#198;',
		'&Ccedil;' => '&#199;',
		'&Egrave;' => '&#200;',
		'&Eacute;' => '&#201;',
		'&Ecirc;' => '&#202;',
		'&Euml;' => '&#203;',
		'&Igrave;' => '&#204;',
		'&Iacute;' => '&#205;',
		'&Icirc;' => '&#206;',
		'&Iuml;' => '&#207;',
		'&ETH;' => '&#208;',
		'&Ntilde;' => '&#209;',
		'&Ograve;' => '&#210;',
		'&Oacute;' => '&#211;',
		'&Ocirc;' => '&#212;',
		'&Otilde;' => '&#213;',
		'&Ouml;' => '&#214;',
		'&times;' => '&#215;',
		'&Oslash;' => '&#216;',
		'&Ugrave;' => '&#217;',
		'&Uacute;' => '&#218;',
		'&Ucirc;' => '&#219;',
		'&Uuml;' => '&#220;',
		'&Yacute;' => '&#221;',
		'&THORN;' => '&#222;',
		'&szlig;' => '&#223;',
		'&agrave;' => '&#224;',
		'&aacute;' => '&#225;',
		'&acirc;' => '&#226;',
		'&atilde;' => '&#227;',
		'&auml;' => '&#228;',
		'&aring;' => '&#229;',
		'&aelig;' => '&#230;',
		'&ccedil;' => '&#231;',
		'&egrave;' => '&#232;',
		'&eacute;' => '&#233;',
		'&ecirc;' => '&#234;',
		'&euml;' => '&#235;',
		'&igrave;' => '&#236;',
		'&iacute;' => '&#237;',
		'&icirc;' => '&#238;',
		'&iuml;' => '&#239;',
		'&eth;' => '&#240;',
		'&ntilde;' => '&#241;',
		'&ograve;' => '&#242;',
		'&oacute;' => '&#243;',
		'&ocirc;' => '&#244;',
		'&otilde;' => '&#245;',
		'&ouml;' => '&#246;',
		'&divide;' => '&#247;',
		'&oslash;' => '&#248;',
		'&ugrave;' => '&#249;',
		'&uacute;' => '&#250;',
		'&ucirc;' => '&#251;',
		'&uuml;' => '&#252;',
		'&yacute;' => '&#253;',
		'&thorn;' => '&#254;',
		'&yuml;' => '&#255;',
		'&fnof;' => '&#402;',
		'&Alpha;' => '&#913;',
		'&Beta;' => '&#914;',
		'&Gamma;' => '&#915;',
		'&Delta;' => '&#916;',
		'&Epsilon;' => '&#917;',
		'&Zeta;' => '&#918;',
		'&Eta;' => '&#919;',
		'&Theta;' => '&#920;',
		'&Iota;' => '&#921;',
		'&Kappa;' => '&#922;',
		'&Lambda;' => '&#923;',
		'&Mu;' => '&#924;',
		'&Nu;' => '&#925;',
		'&Xi;' => '&#926;',
		'&Omicron;' => '&#927;',
		'&Pi;' => '&#928;',
		'&Rho;' => '&#929;',
		'&Sigma;' => '&#931;',
		'&Tau;' => '&#932;',
		'&Upsilon;' => '&#933;',
		'&Phi;' => '&#934;',
		'&Chi;' => '&#935;',
		'&Psi;' => '&#936;',
		'&Omega;' => '&#937;',
		'&alpha;' => '&#945;',
		'&beta;' => '&#946;',
		'&gamma;' => '&#947;',
		'&delta;' => '&#948;',
		'&epsilon;' => '&#949;',
		'&zeta;' => '&#950;',
		'&eta;' => '&#951;',
		'&theta;' => '&#952;',
		'&iota;' => '&#953;',
		'&kappa;' => '&#954;',
		'&lambda;' => '&#955;',
		'&mu;' => '&#956;',
		'&nu;' => '&#957;',
		'&xi;' => '&#958;',
		'&omicron;' => '&#959;',
		'&pi;' => '&#960;',
		'&rho;' => '&#961;',
		'&sigmaf;' => '&#962;',
		'&sigma;' => '&#963;',
		'&tau;' => '&#964;',
		'&upsilon;' => '&#965;',
		'&phi;' => '&#966;',
		'&chi;' => '&#967;',
		'&psi;' => '&#968;',
		'&omega;' => '&#969;',
		'&thetasym;' => '&#977;',
		'&upsih;' => '&#978;',
		'&piv;' => '&#982;',
		'&bull;' => '&#8226;',
		'&hellip;' => '&#8230;',
		'&prime;' => '&#8242;',
		'&Prime;' => '&#8243;',
		'&oline;' => '&#8254;',
		'&frasl;' => '&#8260;',
		'&weierp;' => '&#8472;',
		'&image;' => '&#8465;',
		'&real;' => '&#8476;',
		'&trade;' => '&#8482;',
		'&alefsym;' => '&#8501;',
		'&larr;' => '&#8592;',
		'&uarr;' => '&#8593;',
		'&rarr;' => '&#8594;',
		'&darr;' => '&#8595;',
		'&harr;' => '&#8596;',
		'&crarr;' => '&#8629;',
		'&lArr;' => '&#8656;',
		'&uArr;' => '&#8657;',
		'&rArr;' => '&#8658;',
		'&dArr;' => '&#8659;',
		'&hArr;' => '&#8660;',
		'&forall;' => '&#8704;',
		'&part;' => '&#8706;',
		'&exist;' => '&#8707;',
		'&empty;' => '&#8709;',
		'&nabla;' => '&#8711;',
		'&isin;' => '&#8712;',
		'&notin;' => '&#8713;',
		'&ni;' => '&#8715;',
		'&prod;' => '&#8719;',
		'&sum;' => '&#8721;',
		'&minus;' => '&#8722;',
		'&lowast;' => '&#8727;',
		'&radic;' => '&#8730;',
		'&prop;' => '&#8733;',
		'&infin;' => '&#8734;',
		'&ang;' => '&#8736;',
		'&and;' => '&#8743;',
		'&or;' => '&#8744;',
		'&cap;' => '&#8745;',
		'&cup;' => '&#8746;',
		'&int;' => '&#8747;',
		'&there4;' => '&#8756;',
		'&sim;' => '&#8764;',
		'&cong;' => '&#8773;',
		'&asymp;' => '&#8776;',
		'&ne;' => '&#8800;',
		'&equiv;' => '&#8801;',
		'&le;' => '&#8804;',
		'&ge;' => '&#8805;',
		'&sub;' => '&#8834;',
		'&sup;' => '&#8835;',
		'&nsub;' => '&#8836;',
		'&sube;' => '&#8838;',
		'&supe;' => '&#8839;',
		'&oplus;' => '&#8853;',
		'&otimes;' => '&#8855;',
		'&perp;' => '&#8869;',
		'&sdot;' => '&#8901;',
		'&lceil;' => '&#8968;',
		'&rceil;' => '&#8969;',
		'&lfloor;' => '&#8970;',
		'&rfloor;' => '&#8971;',
		'&lang;' => '&#9001;',
		'&rang;' => '&#9002;',
		'&loz;' => '&#9674;',
		'&spades;' => '&#9824;',
		'&clubs;' => '&#9827;',
		'&hearts;' => '&#9829;',
		'&diams;' => '&#9830;',
		'&quot;' => '&#34;',
		'&amp;' => '&#38;',
		'&lt;' => '&#60;',
		'&gt;' => '&#62;',
		'&OElig;' => '&#338;',
		'&oelig;' => '&#339;',
		'&Scaron;' => '&#352;',
		'&scaron;' => '&#353;',
		'&Yuml;' => '&#376;',
		'&circ;' => '&#710;',
		'&tilde;' => '&#732;',
		'&ensp;' => '&#8194;',
		'&emsp;' => '&#8195;',
		'&thinsp;' => '&#8201;',
		'&zwnj;' => '&#8204;',
		'&zwj;' => '&#8205;',
		'&lrm;' => '&#8206;',
		'&rlm;' => '&#8207;',
		'&ndash;' => '&#8211;',
		'&mdash;' => '&#8212;',
		'&lsquo;' => '&#8216;',
		'&rsquo;' => '&#8217;',
		'&sbquo;' => '&#8218;',
		'&ldquo;' => '&#8220;',
		'&rdquo;' => '&#8221;',
		'&bdquo;' => '&#8222;',
		'&dagger;' => '&#8224;',
		'&Dagger;' => '&#8225;',
		'&permil;' => '&#8240;',
		'&lsaquo;' => '&#8249;',
		'&rsaquo;' => '&#8250;',
		'&euro;' => '&#8364;'
	);

	return preg_replace('/&([A-Za-z])/', '&#38;\\1', strtr($string, $entity_to_decimal));

}

?>