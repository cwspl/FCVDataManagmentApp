<?php

namespace App;
class GujaratiToEnglish
{
	public static function wordToENG($w){
        mb_internal_encoding("UTF-8");
		switch ($w) {
			case 'ઁ':
				return 'au';
			case'ં':
			    return 'aan';
			case 'ઃ':
			    return 'aah';
			case 'અ':
			    return 'Q|a';
			case 'આ':
			    return 'a|x';
			case 'ઇ':
			    return 'e';
			case 'ઈ':
			    return 'ey';
			case 'ઉ':
			    return 'u';
			case 'ઊ':
			    return 'uu';
			case 'ઋ':
			    return 'r';
			case 'ઌ':
			    return 'l';
			case 'ઍ':
			    return 'ae';
			case 'એ':
			    return 'ae';
			case 'ઐ':
			    return 'aui';
			case 'ઑ':
			    return 'o';
			case 'ઓ':
			    return 'o';
			case 'ઔ':
			    return 'au';
			case 'ક':
			    return 'ka';
			case 'ખ':
			    return 'kha';
			case 'ગ':
			    return 'ga';
			case 'ઘ':
			    return 'gha';
			case 'ઙ':
			    return 'nga';
			case 'ચ':
			    return 'cha';
			case 'છ':
			    return 'chha';
			case 'જ':
			    return 'ja';
			case 'ઝ':
			    return 'jha';
			case 'ઞ':
			    return 'nya';
			case 'ટ':
			    return 'ta';
			case 'ઠ':
			    return 'tha';
			case 'ડ':
			    return 'da';
			case 'ઢ':
			    return 'dha';
			case 'ણ':
			    return 'na';
			case 'ત':
			    return 'ta';
			case 'થ':
			    return 'tha';
			case 'દ':
			    return 'da';
			case 'ધ':
			    return 'dha';
			case 'ન':
			    return 'na';
			case 'પ':
			    return 'pa';
			case 'ફ':
			    return 'fa';
			case 'બ':
			    return 'ba';
			case 'ભ':
			    return 'bha';
			case 'મ':
			    return 'Ma';
			case 'ય':
			    return 'ya';
			case 'ર':
			    return 'ra';
			case 'લ':
			    return 'la';
			case 'ળ':
			    return 'ana';
			case 'વ':
			    return 'va';
			case 'શ':
			    return 'sha';
			case 'ષ':
			    return 'sha';
			case 'સ':
			    return 'sa';
			case 'હ':
			    return 'ha';
			case 'ા':
			    return 'aQ1|';
			case 'િ':
			    return 'ai';
			case 'ી':
			    return 'aee';
			case 'ુ':
			    return 'au';
			case 'ૂ':
			    return 'aoo';
			case 'ૃ':
			    return 'aru';
			case 'ૄ':
			    return 'arru';
			case 'ૅ':
			    return 'ae';
			case 'ે':
			    return 'ae';
			case 'ૈ':
			    return 'aui';
			case 'ૉ':
			    return 'ao';
			case 'ો':
			    return 'ao';
			case 'ૌ':
			    return 'aou';
			case '્':
			    return 'a';
			case 'ૐ':
			    return 'om';
			case 'ૠ':
			    return 'rra';
			case 'ૡ':
			    return 'lda';
			case 'ૢ':
			    return 'lu';
			case 'ૣ':
			    return 'ldu';
			case '૦':
			    return '0';
			case '૧':
			    return '1';
			case '૨':
			    return '2';
			case '૩':
			    return '3';
			case '૪':
			    return '4';
			case '૫':
			    return '5';
			case '૬':
			    return '6';
			case '૭':
			    return '7';
			case '૮':
			    return '8';
			case '૯':
			    return '9';
			case '૱':
			    return 'Rs.';
			default:
				return $w;
		}
	}
	public static function convert($t){
        mb_internal_encoding("UTF-8");
		$i = mb_strlen($t);
		$a = 1;
		$str = '';
		while($a < ($i+1)){
			$tem = mb_substr($t,$a - 1,1);
			$str = $str.self::wordToENG($tem);
			$str = str_replace('aa','',$str);
			$a++;
		}
		if((substr($str,-1) == 'a') && (substr($str,-2,1) != 'a')){
			$str = substr($str,0,strlen($str)-1);
		}
		while(strrpos($str,'a ') != null){
			$i = strrpos($str,'a ');
			if(substr(substr($str,0,$i),-1) != 'a'){
				$str = substr($str,0,$i).substr($str,$i+1);
			}
		}
		$str = str_replace('a|x','aa',$str);
		$str = str_replace('Q|','a',$str);
		$str = str_replace('Q1|','aa',$str);
		return strtolower($str);
	}
}
