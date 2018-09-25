<?php
if (!defined('MSNL_LOADED')){die("Cannot Access Newsletter Directly");}
$ftopic = "Les accents et caractères spéciaux en HTML";
$fsender = "Webmaster";
$fcid = "2";
$emailfile = <<< EOD

<!-- Hi  Your System cannot read HTML-Mails! Following message was send to you: <p><style type="text/css">
.accent
{
	color:black;
	font-weigth:normal;
	font-family: Georgia, sans, courier, "courier new", arial;
	border-collapse:collapse;
	border:1px solid black;
}
</style></p>
<div id="content">
<p>La liste des codes avec esperluette (&quot;et&quot; commercial) des caract&egrave;res      accentu&eacute;s et des symboles sp&eacute;ciaux.</p>
<table align="center" class="accent">
    <thead>
        <tr>
            <th width="253">Nom de l'accent</th>
            <th width="106">Lettre</th>
            <th width="96">HTML</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="253">a accent grave</td>
            <td width="106">&agrave;</td>
            <td width="96">&amp;agrave;</td>
        </tr>
        <tr>
            <td width="253">A accent grave</td>
            <td width="106">&Agrave;</td>
            <td width="96">&amp;Agrave;</td>
        </tr>
        <tr>
            <td width="253">a accent aigu</td>
            <td width="106">&aacute;</td>
            <td width="96">&amp;aacute;</td>
        </tr>
        <tr>
            <td width="253">A accent aigu</td>
            <td width="106">&Aacute;</td>
            <td width="96">&amp;Aacute;</td>
        </tr>
        <tr>
            <td width="253">a accent circonflexe</td>
            <td width="106">&acirc;</td>
            <td width="96">&amp;acirc;</td>
        </tr>
        <tr>
            <td width="253">A accent circonflexe</td>
            <td width="106">&Acirc;</td>
            <td width="96">&amp;Acirc;</td>
        </tr>
        <tr>
            <td width="253">a tilde</td>
            <td width="106">&atilde;</td>
            <td width="96">&amp;atilde;</td>
        </tr>
        <tr>
            <td width="253">A tilde</td>
            <td width="106">&Atilde;</td>
            <td width="96">&amp;Atilde;</td>
        </tr>
        <tr>
            <td width="253">a tr&eacute;ma</td>
            <td width="106">&auml;</td>
            <td width="96">&amp;auml;</td>
        </tr>
        <tr>
            <td width="253">A tr&eacute;ma</td>
            <td width="106">&Auml;</td>
            <td width="96">&amp;Auml;</td>
        </tr>
        <tr>
            <td width="253">a rond</td>
            <td width="106">&aring;</td>
            <td width="96">&amp;aring;</td>
        </tr>
        <tr>
            <td width="253">A rond</td>
            <td width="106">&Aring;</td>
            <td width="96">&amp;Aring;</td>
        </tr>
        <tr>
            <td width="253">ae ligatur&eacute;</td>
            <td width="106">&aelig;</td>
            <td width="96">&amp;aelig;</td>
        </tr>
        <tr>
            <td width="253">AE ligatur&eacute;</td>
            <td width="106">&AElig;</td>
            <td width="96">&amp;AElig;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">e accent grave</td>
            <td width="106">&egrave;</td>
            <td width="96">&amp;egrave;</td>
        </tr>
        <tr>
            <td width="253">E accent grave</td>
            <td width="106">&Egrave;</td>
            <td width="96">&amp;Egrave;</td>
        </tr>
        <tr>
            <td width="253">e accent aigu</td>
            <td width="106">&eacute;</td>
            <td width="96">&amp;eacute;</td>
        </tr>
        <tr>
            <td width="253">E accent aigu</td>
            <td width="106">&Eacute;</td>
            <td width="96">&amp;Eacute;</td>
        </tr>
        <tr>
            <td width="253">e accent circonflexe</td>
            <td width="106">&ecirc;</td>
            <td width="96">&amp;ecirc;</td>
        </tr>
        <tr>
            <td width="253">E accent circonflexe</td>
            <td width="106">&Ecirc;</td>
            <td width="96">&amp;Ecirc;</td>
        </tr>
        <tr>
            <td width="253">e tr&eacute;ma</td>
            <td width="106">&euml;</td>
            <td width="96">&amp;euml;</td>
        </tr>
        <tr>
            <td width="253">E tr&eacute;ma</td>
            <td width="106">&Euml;</td>
            <td width="96">&amp;Euml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">i accent grave</td>
            <td width="106">&igrave;</td>
            <td width="96">&amp;igrave;</td>
        </tr>
        <tr>
            <td width="253">I accent grave</td>
            <td width="106">&Igrave;</td>
            <td width="96">&amp;Igrave;</td>
        </tr>
        <tr>
            <td width="253">i accent aigu</td>
            <td width="106">&iacute;</td>
            <td width="96">&amp;iacute;</td>
        </tr>
        <tr>
            <td width="253">I accent aigu</td>
            <td width="106">&Iacute;</td>
            <td width="96">&amp;Iacute;</td>
        </tr>
        <tr>
            <td width="253">i accent circonflexe</td>
            <td width="106">&icirc;</td>
            <td width="96">&amp;icirc;</td>
        </tr>
        <tr>
            <td width="253">I accent circonflexe</td>
            <td width="106">&Icirc;</td>
            <td width="96">&amp;Icirc;</td>
        </tr>
        <tr>
            <td width="253">i tr&eacute;ma</td>
            <td width="106">&iuml;</td>
            <td width="96">&amp;iuml;</td>
        </tr>
        <tr>
            <td width="253">I tr&eacute;ma</td>
            <td width="106">&Iuml;</td>
            <td width="96">&amp;Iuml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">o accent grave</td>
            <td width="106">&ograve;</td>
            <td width="96">&amp;ograve;</td>
        </tr>
        <tr>
            <td width="253">O accent grave</td>
            <td width="106">&Ograve;</td>
            <td width="96">&amp;Ograve;</td>
        </tr>
        <tr>
            <td width="253">o accent aigu</td>
            <td width="106">&oacute;</td>
            <td width="96">&amp;oacute;</td>
        </tr>
        <tr>
            <td width="253">O accent aigu</td>
            <td width="106">&Oacute;</td>
            <td width="96">&amp;Oacute;</td>
        </tr>
        <tr>
            <td width="253">o accent circonflexe</td>
            <td width="106">&ocirc;</td>
            <td width="96">&amp;ocirc;</td>
        </tr>
        <tr>
            <td width="253">O accent circonflexe</td>
            <td width="106">&Ocirc;</td>
            <td width="96">&amp;Ocirc;</td>
        </tr>
        <tr>
            <td width="253">o tilde</td>
            <td width="106">&otilde;</td>
            <td width="96">&amp;otilde;</td>
        </tr>
        <tr>
            <td width="253">O tilde</td>
            <td width="106">&Otilde;</td>
            <td width="96">&amp;Otilde;</td>
        </tr>
        <tr>
            <td width="253">o tr&eacute;ma</td>
            <td width="106">&ouml;</td>
            <td width="96">&amp;ouml;</td>
        </tr>
        <tr>
            <td width="253">O tr&eacute;ma</td>
            <td width="106">&Ouml;</td>
            <td width="96">&amp;Ouml;</td>
        </tr>
        <tr>
            <td width="253">o barr&eacute;</td>
            <td width="106">&oslash;</td>
            <td width="96">&amp;oslash;</td>
        </tr>
        <tr>
            <td width="253">O barr&eacute;</td>
            <td width="106">&Oslash;</td>
            <td width="96">&amp;Oslash;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">u accent grave</td>
            <td width="106">&ugrave;</td>
            <td width="96">&amp;ugrave;</td>
        </tr>
        <tr>
            <td width="253">U accent grave</td>
            <td width="106">&Ugrave;</td>
            <td width="96">&amp;Ugrave;</td>
        </tr>
        <tr>
            <td width="253">u accent aigu</td>
            <td width="106">&uacute;</td>
            <td width="96">&amp;uacute;</td>
        </tr>
        <tr>
            <td width="253">U accent aigu</td>
            <td width="106">&Uacute;</td>
            <td width="96">&amp;Uacute;</td>
        </tr>
        <tr>
            <td width="253">u accent circonflexe</td>
            <td width="106">&ucirc;</td>
            <td width="96">&amp;ucirc;</td>
        </tr>
        <tr>
            <td width="253">U accent circonflexe</td>
            <td width="106">&Ucirc;</td>
            <td width="96">&amp;Ucirc;</td>
        </tr>
        <tr>
            <td width="253">u tr&eacute;ma</td>
            <td width="106">&uuml;</td>
            <td width="96">&amp;uuml;</td>
        </tr>
        <tr>
            <td width="253">U tr&eacute;ma</td>
            <td width="106">&Uuml;</td>
            <td width="96">&amp;Uuml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">n tilde</td>
            <td width="106">&ntilde;</td>
            <td width="96">&amp;ntilde;</td>
        </tr>
        <tr>
            <td width="253">N tilde</td>
            <td width="106">&Ntilde;</td>
            <td width="96">&amp;Ntilde;</td>
        </tr>
        <tr>
            <td width="253">c c&eacute;dille</td>
            <td width="106">&ccedil;</td>
            <td width="96">&amp;ccedil;</td>
        </tr>
        <tr>
            <td width="253">C c&eacute;dille</td>
            <td width="106">&Ccedil;</td>
            <td width="96">&amp;Ccedil;</td>
        </tr>
        <tr>
            <td width="253">y accent aigu</td>
            <td width="106">&yacute;</td>
            <td width="96">&amp;yacute;</td>
        </tr>
        <tr>
            <td width="253">Y accent aigu</td>
            <td width="106">&Yacute;</td>
            <td width="96">&amp;Yacute;</td>
        </tr>
        <tr>
            <td width="253">double s allemand</td>
            <td width="106">&szlig;</td>
            <td width="96">&amp;szlig;</td>
        </tr>
        <tr>
            <td width="253">guillemet fran&ccedil;ais ouvrant</td>
            <td width="106">&laquo;</td>
            <td width="96">&amp;laquo;</td>
        </tr>
        <tr>
            <td width="253">guillemet fran&ccedil;ais fermant</td>
            <td width="106">&raquo;</td>
            <td width="96">&amp;raquo;</td>
        </tr>
        <tr>
            <td>esperluette</td>
            <td>&amp;</td>
            <td>&amp;amp;</td>
        </tr>
        <tr>
            <td>inf&eacute;rieur</td>
            <td>&lt;</td>
            <td>&amp;lt;</td>
        </tr>
        <tr>
            <td>sup&eacute;rieur</td>
            <td>&lt;</td>
            <td>&amp;gt;</td>
        </tr>
        <tr>
            <td>guillemet double</td>
            <td>&quot;</td>
            <td>&amp;quot;</td>
        </tr>
        <tr>
            <td width="253">paragraphe</td>
            <td width="106">&sect;</td>
            <td width="96">&amp;para;</td>
        </tr>
        <tr>
            <td width="253">copyright</td>
            <td width="106">&copy;</td>
            <td width="96">&amp;copy;</td>
        </tr>
        <tr>
            <td width="253">espace blanc</td>
            <td width="106">&nbsp;</td>
            <td width="96">&amp;nbsp;</td>
        </tr>
    </tbody>
</table>
<div class="pub"><script type="text/javascript"><!--
google_ad_client = "pub-2681794164750401";
google_ad_slot = "0934517442";
google_ad_width = 728;
google_ad_height = 90;</script></div>
</div> -->
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
	"http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>

<META HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=ISO-8859-1">
<title>Shit Squad Email</title>
<style type="text/css">

<!--

a:link,a:active,a:visited{ background-color: transparent; color: #000000; text-decoration: none; }
a:hover{ background-color: transparent; color: #000000; text-decoration: underline; }
body { background: #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; text-decoration: none; }
div#banner { text-align: center; vertical-align: middle; }
div#main { background: #CCCCCC; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; margin: 2% 2% 2% 2%; padding: 2% 2% 2% 2%; text-decoration: none; }
div#subtitle { background: #F5F5F5; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 2px 2px 2px 2px; text-decoration: none; }
div#title { background: #808080; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 18px; font-weight: bold; margin-bottom: 5px; margin-top: 5px; padding: 10px 10px; text-align: center; text-decoration: none; text-shadow: #D3D3D3; }
div#unsub { background-color: transparent; color: #F5F5F5; font-family: Verdana, Helvetica, sans-serif; font-size: 9px; text-decoration: none; }
tr.row { background-color: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; text-decoration: none; }
.bar { border: 1px solid #000000; margin-bottom: 5px; margin-top: 5px; }
.content { background: #F5F5F5; border: 1px solid #000000; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 12px; margin-bottom: 5px; margin-top: 5px; padding: 5px 5px 5px 5px; text-decoration: none; }
.subtitle { background: #FFFFFF; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 10px; font-weight: bold; text-decoration: none; }
.title { background: #808080; color: #000000; font-family: Verdana, Helvetica, sans-serif; font-size: 14px; font-weight: bold; text-decoration: none; }

-->

</style>
</head>
<body>
<div id="main">
	<div id="title">Newsletter from Shit Squad sent on September 10 2016</div>
	<div id="subtitle">By: Webmaster Topic: Les accents et caractères spéciaux en HTML</div>
	<div class="content"><p><style type="text/css">
.accent
{
	color:black;
	font-weigth:normal;
	font-family: Georgia, sans, courier, "courier new", arial;
	border-collapse:collapse;
	border:1px solid black;
}
</style></p>
<div id="content">
<p>La liste des codes avec esperluette (&quot;et&quot; commercial) des caract&egrave;res      accentu&eacute;s et des symboles sp&eacute;ciaux.</p>
<table align="center" class="accent">
    <thead>
        <tr>
            <th width="253">Nom de l'accent</th>
            <th width="106">Lettre</th>
            <th width="96">HTML</th>
        </tr>
    </thead>
    <tbody>
        <tr>
            <td width="253">a accent grave</td>
            <td width="106">&agrave;</td>
            <td width="96">&amp;agrave;</td>
        </tr>
        <tr>
            <td width="253">A accent grave</td>
            <td width="106">&Agrave;</td>
            <td width="96">&amp;Agrave;</td>
        </tr>
        <tr>
            <td width="253">a accent aigu</td>
            <td width="106">&aacute;</td>
            <td width="96">&amp;aacute;</td>
        </tr>
        <tr>
            <td width="253">A accent aigu</td>
            <td width="106">&Aacute;</td>
            <td width="96">&amp;Aacute;</td>
        </tr>
        <tr>
            <td width="253">a accent circonflexe</td>
            <td width="106">&acirc;</td>
            <td width="96">&amp;acirc;</td>
        </tr>
        <tr>
            <td width="253">A accent circonflexe</td>
            <td width="106">&Acirc;</td>
            <td width="96">&amp;Acirc;</td>
        </tr>
        <tr>
            <td width="253">a tilde</td>
            <td width="106">&atilde;</td>
            <td width="96">&amp;atilde;</td>
        </tr>
        <tr>
            <td width="253">A tilde</td>
            <td width="106">&Atilde;</td>
            <td width="96">&amp;Atilde;</td>
        </tr>
        <tr>
            <td width="253">a tr&eacute;ma</td>
            <td width="106">&auml;</td>
            <td width="96">&amp;auml;</td>
        </tr>
        <tr>
            <td width="253">A tr&eacute;ma</td>
            <td width="106">&Auml;</td>
            <td width="96">&amp;Auml;</td>
        </tr>
        <tr>
            <td width="253">a rond</td>
            <td width="106">&aring;</td>
            <td width="96">&amp;aring;</td>
        </tr>
        <tr>
            <td width="253">A rond</td>
            <td width="106">&Aring;</td>
            <td width="96">&amp;Aring;</td>
        </tr>
        <tr>
            <td width="253">ae ligatur&eacute;</td>
            <td width="106">&aelig;</td>
            <td width="96">&amp;aelig;</td>
        </tr>
        <tr>
            <td width="253">AE ligatur&eacute;</td>
            <td width="106">&AElig;</td>
            <td width="96">&amp;AElig;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">e accent grave</td>
            <td width="106">&egrave;</td>
            <td width="96">&amp;egrave;</td>
        </tr>
        <tr>
            <td width="253">E accent grave</td>
            <td width="106">&Egrave;</td>
            <td width="96">&amp;Egrave;</td>
        </tr>
        <tr>
            <td width="253">e accent aigu</td>
            <td width="106">&eacute;</td>
            <td width="96">&amp;eacute;</td>
        </tr>
        <tr>
            <td width="253">E accent aigu</td>
            <td width="106">&Eacute;</td>
            <td width="96">&amp;Eacute;</td>
        </tr>
        <tr>
            <td width="253">e accent circonflexe</td>
            <td width="106">&ecirc;</td>
            <td width="96">&amp;ecirc;</td>
        </tr>
        <tr>
            <td width="253">E accent circonflexe</td>
            <td width="106">&Ecirc;</td>
            <td width="96">&amp;Ecirc;</td>
        </tr>
        <tr>
            <td width="253">e tr&eacute;ma</td>
            <td width="106">&euml;</td>
            <td width="96">&amp;euml;</td>
        </tr>
        <tr>
            <td width="253">E tr&eacute;ma</td>
            <td width="106">&Euml;</td>
            <td width="96">&amp;Euml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">i accent grave</td>
            <td width="106">&igrave;</td>
            <td width="96">&amp;igrave;</td>
        </tr>
        <tr>
            <td width="253">I accent grave</td>
            <td width="106">&Igrave;</td>
            <td width="96">&amp;Igrave;</td>
        </tr>
        <tr>
            <td width="253">i accent aigu</td>
            <td width="106">&iacute;</td>
            <td width="96">&amp;iacute;</td>
        </tr>
        <tr>
            <td width="253">I accent aigu</td>
            <td width="106">&Iacute;</td>
            <td width="96">&amp;Iacute;</td>
        </tr>
        <tr>
            <td width="253">i accent circonflexe</td>
            <td width="106">&icirc;</td>
            <td width="96">&amp;icirc;</td>
        </tr>
        <tr>
            <td width="253">I accent circonflexe</td>
            <td width="106">&Icirc;</td>
            <td width="96">&amp;Icirc;</td>
        </tr>
        <tr>
            <td width="253">i tr&eacute;ma</td>
            <td width="106">&iuml;</td>
            <td width="96">&amp;iuml;</td>
        </tr>
        <tr>
            <td width="253">I tr&eacute;ma</td>
            <td width="106">&Iuml;</td>
            <td width="96">&amp;Iuml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">o accent grave</td>
            <td width="106">&ograve;</td>
            <td width="96">&amp;ograve;</td>
        </tr>
        <tr>
            <td width="253">O accent grave</td>
            <td width="106">&Ograve;</td>
            <td width="96">&amp;Ograve;</td>
        </tr>
        <tr>
            <td width="253">o accent aigu</td>
            <td width="106">&oacute;</td>
            <td width="96">&amp;oacute;</td>
        </tr>
        <tr>
            <td width="253">O accent aigu</td>
            <td width="106">&Oacute;</td>
            <td width="96">&amp;Oacute;</td>
        </tr>
        <tr>
            <td width="253">o accent circonflexe</td>
            <td width="106">&ocirc;</td>
            <td width="96">&amp;ocirc;</td>
        </tr>
        <tr>
            <td width="253">O accent circonflexe</td>
            <td width="106">&Ocirc;</td>
            <td width="96">&amp;Ocirc;</td>
        </tr>
        <tr>
            <td width="253">o tilde</td>
            <td width="106">&otilde;</td>
            <td width="96">&amp;otilde;</td>
        </tr>
        <tr>
            <td width="253">O tilde</td>
            <td width="106">&Otilde;</td>
            <td width="96">&amp;Otilde;</td>
        </tr>
        <tr>
            <td width="253">o tr&eacute;ma</td>
            <td width="106">&ouml;</td>
            <td width="96">&amp;ouml;</td>
        </tr>
        <tr>
            <td width="253">O tr&eacute;ma</td>
            <td width="106">&Ouml;</td>
            <td width="96">&amp;Ouml;</td>
        </tr>
        <tr>
            <td width="253">o barr&eacute;</td>
            <td width="106">&oslash;</td>
            <td width="96">&amp;oslash;</td>
        </tr>
        <tr>
            <td width="253">O barr&eacute;</td>
            <td width="106">&Oslash;</td>
            <td width="96">&amp;Oslash;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">u accent grave</td>
            <td width="106">&ugrave;</td>
            <td width="96">&amp;ugrave;</td>
        </tr>
        <tr>
            <td width="253">U accent grave</td>
            <td width="106">&Ugrave;</td>
            <td width="96">&amp;Ugrave;</td>
        </tr>
        <tr>
            <td width="253">u accent aigu</td>
            <td width="106">&uacute;</td>
            <td width="96">&amp;uacute;</td>
        </tr>
        <tr>
            <td width="253">U accent aigu</td>
            <td width="106">&Uacute;</td>
            <td width="96">&amp;Uacute;</td>
        </tr>
        <tr>
            <td width="253">u accent circonflexe</td>
            <td width="106">&ucirc;</td>
            <td width="96">&amp;ucirc;</td>
        </tr>
        <tr>
            <td width="253">U accent circonflexe</td>
            <td width="106">&Ucirc;</td>
            <td width="96">&amp;Ucirc;</td>
        </tr>
        <tr>
            <td width="253">u tr&eacute;ma</td>
            <td width="106">&uuml;</td>
            <td width="96">&amp;uuml;</td>
        </tr>
        <tr>
            <td width="253">U tr&eacute;ma</td>
            <td width="106">&Uuml;</td>
            <td width="96">&amp;Uuml;</td>
        </tr>
    </tbody>
    <tbody>
        <tr>
            <td width="253">n tilde</td>
            <td width="106">&ntilde;</td>
            <td width="96">&amp;ntilde;</td>
        </tr>
        <tr>
            <td width="253">N tilde</td>
            <td width="106">&Ntilde;</td>
            <td width="96">&amp;Ntilde;</td>
        </tr>
        <tr>
            <td width="253">c c&eacute;dille</td>
            <td width="106">&ccedil;</td>
            <td width="96">&amp;ccedil;</td>
        </tr>
        <tr>
            <td width="253">C c&eacute;dille</td>
            <td width="106">&Ccedil;</td>
            <td width="96">&amp;Ccedil;</td>
        </tr>
        <tr>
            <td width="253">y accent aigu</td>
            <td width="106">&yacute;</td>
            <td width="96">&amp;yacute;</td>
        </tr>
        <tr>
            <td width="253">Y accent aigu</td>
            <td width="106">&Yacute;</td>
            <td width="96">&amp;Yacute;</td>
        </tr>
        <tr>
            <td width="253">double s allemand</td>
            <td width="106">&szlig;</td>
            <td width="96">&amp;szlig;</td>
        </tr>
        <tr>
            <td width="253">guillemet fran&ccedil;ais ouvrant</td>
            <td width="106">&laquo;</td>
            <td width="96">&amp;laquo;</td>
        </tr>
        <tr>
            <td width="253">guillemet fran&ccedil;ais fermant</td>
            <td width="106">&raquo;</td>
            <td width="96">&amp;raquo;</td>
        </tr>
        <tr>
            <td>esperluette</td>
            <td>&amp;</td>
            <td>&amp;amp;</td>
        </tr>
        <tr>
            <td>inf&eacute;rieur</td>
            <td>&lt;</td>
            <td>&amp;lt;</td>
        </tr>
        <tr>
            <td>sup&eacute;rieur</td>
            <td>&lt;</td>
            <td>&amp;gt;</td>
        </tr>
        <tr>
            <td>guillemet double</td>
            <td>&quot;</td>
            <td>&amp;quot;</td>
        </tr>
        <tr>
            <td width="253">paragraphe</td>
            <td width="106">&sect;</td>
            <td width="96">&amp;para;</td>
        </tr>
        <tr>
            <td width="253">copyright</td>
            <td width="106">&copy;</td>
            <td width="96">&amp;copy;</td>
        </tr>
        <tr>
            <td width="253">espace blanc</td>
            <td width="106">&nbsp;</td>
            <td width="96">&amp;nbsp;</td>
        </tr>
    </tbody>
</table>
<div class="pub"><script type="text/javascript"><!--
google_ad_client = "pub-2681794164750401";
google_ad_slot = "0934517442";
google_ad_width = 728;
google_ad_height = 90;</script></div>
</div></div>
	<div class="bar"></div>
	
	
	
	
	
</div>
	<div id="banner"></div>
	<div class="bar"></div>
	<div id="unsub">You received this email because you are a registered user of Shit Squad, if you dont want to receive mail from Shit Squad, please let us know by following this <a href="mailto:digital.mindz@free.fr?subject=Newsletter">link</a>.</div>
</body>
</html>

EOD;

?>