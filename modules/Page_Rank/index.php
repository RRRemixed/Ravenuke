<?php

if (!defined('MODULE_FILE')) {
   die ("You can't access this file directly...");
}
require_once("mainfile.php");
$module_name = basename(dirname(__FILE__));
include("header.php");
define('INDEX_FILE', true);

OpenTable();
?>


<center>
<form method=POST>
Enter Web Site: <input name='url' value='<?=$_REQUEST['url']; ?>' size="20"><input type="submit" value="Get My Site Rank">
<hr>
<?

	$website = $_REQUEST['url'];
	if( $website ){
		if( !strstr($website,"http://") && !strstr($website,"https://") ){
			$website = "http://".$website;
		}
?>
		Retrieving info for <?=$website?>...<br>
<?
		$resa = linkcheck($website,'google');
		$resi = GoogleLinks($website);
		$pr = GooglePageRank($website);
		$indexed = $resi[google][0];
		$links = $resa[google][0];
?>
		Website: <a href="<?=$website?>"><?=$website?></a><br>
		Page Rank: <?=$pr?> / 10<br>
		Indexed Pages: <a href="<?=$resi[google][1]?>"><?=$indexed?></a><br>
		BackLinks: <a href="<?=$resa[google][1]?>"><?=$links?></a><br>
<?	
	}
	function linkcheck($url, $engine) {
		global $total;
		$arr = parse_url($url);
		$url = $arr['host'];
		$path = "http://www.google.com/search?hl=en&lr=&ie=UTF-8&q=link%3A".$url;
		if(!file_exists($path)) {
			$data = strtolower(strip_tags(implode("", file($path))));
			$data = substr($data, strpos($data, "of about")+9, strlen($data));
			$data = substr($data, 0, strpos($data, " "));
			if(eregi("[[:alpha:]]", $data)) {
				$results[$engine] = array('0', $path);
			} else {
				$results[$engine] = array($data, $path);
				$total+=str_replace(',', '', $data);
			}
		} else {
			$results[$engine] = array('n/a', $path);
		}
		return $results;
	}
	function GoogleLinks($url){
		$arr = parse_url($url);
		$url = $arr['host'];
		$engine = 'google';
		$path = 'http://www.google.com/search?q=site:'.$url.'&hl=en&lr=&ie=UTF-8&filter=0';
		if(!file_exists($path)) {
			$data = str_replace('&nbsp;', ' ', strtolower(strip_tags(@implode('', @file($path))))); 
			if(!strpos($data, 'did not match any documents')) {
				$data = substr($data, strpos($data, 'Results')+10, strlen($data)); 
				$data = trim(substr($data, 0, strpos($data, 'from'))); //echo $data; // TEST
				$data = explode(' ', $data);
				$data = $data[(count($data)-1)];
				$results[$engine] = array($data, $path);
				$total+=str_replace(',', '', $data);
			} else {
				$results[$engine] = array('0', $path);
			}
		} else {
			$results[$engine] = array('n/a', $path);
		}
		return $results;
	}

	
	function GooglePageRank($url){ // function gets PR from google site;
		$arr = parse_url($url);
		$url = $arr['host'];
		$url="info:".$url; $ch=GoogleCSum($url,0xE6359A60); // Counting Google control sum
		$host="toolbarqueries.google.com"; $hostip=gethostbyname($host); // Creating request to Google with Toolbar emulation
		$query ="GET /search?client=navclient-auto&ch=6".$ch."&ie=UTF-8&oe=UTF-8&features=Rank&q=".rawurlencode($url)." HTTP/1.0\r\n";
		$query.="Host: $host\r\n"; $rank=-1;
		$query.="User-Agent: Mozilla/4.0 (compatible; MSIE 6.0; Windows NT 5.1)\r\n";
		$query.="Connection: Close\r\n\r\n";
		$fp=fsockopen($hostip,80,$errno,$errstr,30); // Connecting to Google and getting data from it
		if ($fp)
		{ fputs($fp,$query); $data=""; while (!feof($fp)) $data.=fgets($fp,4096); fclose($fp);
		$data=explode("\n",$data);
		foreach ($data as $line)
		if (!is_bool(strpos($line,"Rank_1")))
		{ $rank=explode(":",trim($line)); $rank=$rank[2]; break; } }
		return $rank; 
	}
	// function for calculating Google URL Checksum
	function GoogleCSum($s,$key){
		$v4=$len=strlen($s); $esi=$key; $ebx=$edi=0x9E3779B9; $p=0;
		if ($len>=12)
		for($i=0;$i<floor($len/12);$i++)
		{ $edi=unsign($edi+ord($s[$p+4])+(ord($s[$p+5]) << 8)+(ord($s[$p+6]) << 16)+(ord($s[$p+7]) << 24));
		$esi=unsign($esi+ord($s[$p+8])+(ord($s[$p+9]) << 8)+(ord($s[$p+10]) << 16)+(ord($s[$p+11]) << 24));
		$edx=unsign(($ebx+ord($s[$p+0])+(ord($s[$p+1]) << 8)+(ord($s[$p+2]) << 16)+(ord($s[$p+3]) << 24)-$edi-$esi)^shr($esi,13));
		$edi=unsign(($edi-$esi-$edx)^($edx << 8));
		$esi=unsign(($esi-$edx-$edi)^shr($edi,13));
		$edx=unsign(($edx-$edi-$esi)^shr($esi,12));
		$edi=unsign(($edi-$esi-$edx)^($edx << 16));
		$esi=unsign(($esi-$edx-$edi)^shr($edi,5));
		$edx=unsign(($edx-$edi-$esi)^shr($esi,3)); $ebx=$edx;
		$edi=unsign(($edi-$esi-$ebx)^($ebx << 10));
		$esi=unsign(($esi-$ebx-$edi)^shr($edi,15));
		$v4-=12; $p+=12; }
		$esi=unsign($esi+$len);
		if ($v4>=11) $esi=unsign($esi+(ord($s[$p+10]) << 24));
		if ($v4>=10) $esi=unsign($esi+(ord($s[$p+9]) << 16));
		if ($v4>=9) $esi=unsign($esi+(ord($s[$p+8]) << 8));
		if ($v4>=8) $edi=unsign($edi+ord($s[$p+4])+(ord($s[$p+5]) << 8)+(ord($s[$p+6]) << 16)+(ord($s[$p+7]) << 24));
		else
		{ if ($v4>=7) $edi=unsign($edi+(ord($s[$p+6]) << 16));
		if ($v4>=6) $edi=unsign($edi+(ord($s[$p+5]) << 8));
		if ($v4>=5) $edi=unsign($edi+ord($s[$p+4])); }
		if ($v4>=4) $ebx=unsign($ebx+ord($s[$p+0])+(ord($s[$p+1]) << 8)+(ord($s[$p+2]) << 16)+(ord($s[$p+3]) << 24));
		else
		{ if ($v4>=3) $ebx=unsign($ebx+(ord($s[$p+2]) << 16));
		if ($v4>=2) $ebx=unsign($ebx+(ord($s[$p+1]) << 8));
		if ($v4>=1) $ebx=unsign($ebx+ord($s[$p+0])); }
		$ebx=unsign(($ebx-$edi-$esi)^shr($esi,13));
		$edi=unsign(($edi-$esi-$ebx)^($ebx << 8));
		$esi=unsign(($esi-$ebx-$edi)^shr($edi,13));
		$ebx=unsign(($ebx-$edi-$esi)^shr($esi,12));
		$edi=unsign(($edi-$esi-$ebx)^($ebx << 16));
		$esi=unsign(($esi-$ebx-$edi)^shr($edi,5));
		$ebx=unsign(($ebx-$edi-$esi)^shr($esi,3));
		$edi=unsign(($edi-$esi-$ebx)^($ebx << 10));
		$esi=unsign(($esi-$ebx-$edi)^shr($edi,15)); return $esi; 
	}
	function shr($x,$y) { 
		$x=unsign($x); 
		for($i=0;$i<$y;$i++) $x=floor($x/2); return $x; 
	}
	function unsign($l) { 
		$l=intval($l);
		if ($l>=0){
			return $l;
		}else{
			return 4294967296+$l;
		}
	}



CloseTable();
include("footer.php");
?>