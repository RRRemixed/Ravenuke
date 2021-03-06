<?php
if (eregi("block-Google_PRank.php",$PHP_SELF)) {
    Header("Location: index.php");
    die();
}

//ADD YOUR SITE URL BELOW
$prurl ="http://roxor.gaming.free.fr"; //Replace with your url
//END CONFIG - DO NOT TOUCH BELOW THIS LINE
//------------------------------------------------
//Authors : Raistlin Majere (euclide at email dot it) (google_pagerank()
//          Emre Odabas (eodabas at msn dot com)
Class GooglePR {
	
	var $GOOGLE_MAGIC = 0xE6359A60;
	var $PageRank = -1;

	function GetPR($url) {
		$result=array("",-1);

		if (($url.""!="")&&($url.""!="http://")) {
			// check for protocol
			$url = "info:".((substr(strtolower($url),0,7)!="http://")? "http://".$url:$url);
			$checksum=$this->GoogleCH($this->strord($url));
			$google_url=sprintf("http://www.google.com/search?client=navclient-auto&ch=6%u&features=Rank&q=".$url,$checksum); // url to get from google
			$contents="";
			
			// let's get ranking
			// this way could cause problems because the Browser Useragent is not set...
			$contents = @file_get_contents($google_url);


			$result[0]=$contents;
			// Rank_1:1:0 = 0
			// Rank_1:1:5 = 5
			// Rank_1:1:9 = 9
			// Rank_1:2:10 = 10 etc
			$p=explode(":",$contents);
			if (isset($p[2])) $result[1]=$p[2];
		}

		if($result[1] == -1)
		$result[1] = 0;
		$this->PageRank =(int)trim($result[1]);
		return $this->PageRank;

	}

	function zeroFill($a, $b) {
		$z = hexdec(80000000);
		if ($z & $a) {
			$a = ($a>>1);
			$a &= (~$z);
			$a |= 0x40000000;
			$a = ($a>>($b-1));
		} else {
			$a = ($a>>$b);
		}
		return $a;
	}

	function mix($a,$b,$c) {
		$a -= $b; $a -= $c; $a ^= ($this->zeroFill($c,13));
		$b -= $c; $b -= $a; $b ^= ($a<<8);
		$c -= $a; $c -= $b; $c ^= ($this->zeroFill($b,13));
		$a -= $b; $a -= $c; $a ^= ($this->zeroFill($c,12));
		$b -= $c; $b -= $a; $b ^= ($a<<16);
		$c -= $a; $c -= $b; $c ^= ($this->zeroFill($b,5));
		$a -= $b; $a -= $c; $a ^= ($this->zeroFill($c,3));
		$b -= $c; $b -= $a; $b ^= ($a<<10);
		$c -= $a; $c -= $b; $c ^= ($this->zeroFill($b,15));

		return array($a,$b,$c);
	}

	function GoogleCH($url, $length=null) {
		if(is_null($length)) {
			$length = sizeof($url);
		}
		$a = $b = 0x9E3779B9;
		$c = $this->GOOGLE_MAGIC;
		$k = 0;
		$len = $length;
		while($len >= 12) {
			$a += ($url[$k+0] +($url[$k+1]<<8) +($url[$k+2]<<16) +($url[$k+3]<<24));
			$b += ($url[$k+4] +($url[$k+5]<<8) +($url[$k+6]<<16) +($url[$k+7]<<24));
			$c += ($url[$k+8] +($url[$k+9]<<8) +($url[$k+10]<<16)+($url[$k+11]<<24));
			$mix = $this->mix($a,$b,$c);
			$a = $mix[0]; $b = $mix[1]; $c = $mix[2];
			$k += 12;
			$len -= 12;
		}

		$c += $length;
		switch($len) /* all the case statements fall through */
		{
			case 11: $c+=($url[$k+10]<<24);
			case 10: $c+=($url[$k+9]<<16);
			case 9 : $c+=($url[$k+8]<<8);
			/* the first byte of c is reserved for the length */
			case 8 : $b+=($url[$k+7]<<24);
			case 7 : $b+=($url[$k+6]<<16);
			case 6 : $b+=($url[$k+5]<<8);
			case 5 : $b+=($url[$k+4]);
			case 4 : $a+=($url[$k+3]<<24);
			case 3 : $a+=($url[$k+2]<<16);
			case 2 : $a+=($url[$k+1]<<8);
			case 1 : $a+=($url[$k+0]);
			/* case 0: nothing left to add */
		}
		$mix = $this->mix($a,$b,$c);
		/*-------------------------------------------- report the result */
		return $mix[2];
	}

	//converts a string into an array of integers containing the numeric value of the char
	function strord($string) {
		for($i=0;$i<strlen($string);$i++) {
			$result[$i] = ord($string{$i});
		}
		return $result;
	}




}
$gpr = new GooglePR();
$ranknum = $gpr->GetPR("$prurl");
$content ="<br><center><img src='images/PRank/$ranknum.gif' border='0'></center><br>";
?>