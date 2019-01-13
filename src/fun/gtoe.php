<?php
mb_internal_encoding("UTF-8");
	function gujtoeng($a){
	       	 if($a=='ઁ')
		    {return 'au';}
		else if($a=='ં')
		    {return 'aan';}
		else if($a=='ઃ')
		    {return 'aah';}
		else if($a=='અ')
		    {return 'Q|a';}
		else if($a=='આ')
		    {return 'a|x';}
		else if($a=='ઇ')
		    {return 'e';}
		else if($a=='ઈ')
		    {return 'ey';}
		else if($a=='ઉ')
		    {return 'u';}
		else if($a=='ઊ')
		    {return 'uu';}
		else if($a=='ઋ')
		    {return 'r';}
		else if($a=='ઌ')
		    {return 'l';}
		else if($a=='ઍ')
		    {return 'ae';}
		else if($a=='એ')
		    {return 'ae';}
		else if($a=='ઐ')
		    {return 'aui';}
		else if($a=='ઑ')
		    {return 'o';}
		else if($a=='ઓ')
		    {return 'o';}
		else if($a=='ઔ')
		    {return 'au';}
		else if($a=='ક')
		    {return 'ka';}
		else if($a=='ખ')
		    {return 'kha';}
		else if($a=='ગ')
		    {return 'ga';}
		else if($a=='ઘ')
		    {return 'gha';}
		else if($a=='ઙ')
		    {return 'nga';}
		else if($a=='ચ')
		    {return 'cha';}
		else if($a=='છ')
		    {return 'chha';}
		else if($a=='જ')
		    {return 'ja';}
		else if($a=='ઝ')
		    {return 'jha';}
		else if($a=='ઞ')
		    {return 'nya';}
		else if($a=='ટ')
		    {return 'ta';}
		else if($a=='ઠ')
		    {return 'tha';}
		else if($a=='ડ')
		    {return 'da';}
		else if($a=='ઢ')
		    {return 'dha';}
		else if($a=='ણ')
		    {return 'na';}
		else if($a=='ત')
		    {return 'ta';}
		else if($a=='થ')
		    {return 'tha';}
		else if($a=='દ')
		    {return 'da';}
		else if($a=='ધ')
		    {return 'dha';}
		else if($a=='ન')
		    {return 'na';}
		else if($a=='પ')
		    {return 'pa';}
		else if($a=='ફ')
		    {return 'fa';}
		else if($a=='બ')
		    {return 'ba';}
		else if($a=='ભ')
		    {return 'bha';}
		else if($a=='મ')
		    {return 'Ma';}
		else if($a=='ય')
		    {return 'ya';}
		else if($a=='ર')
		    {return 'ra';}
		else if($a=='લ')
		    {return 'la';}
		else if($a=='ળ')
		    {return 'ana';}
		else if($a=='વ')
		    {return 'va';}
		else if($a=='શ')
		    {return 'sha';}
		else if($a=='ષ')
		    {return 'sha';}
		else if($a=='સ')
		    {return 'sa';}
		else if($a=='હ')
		    {return 'ha';}
		else if($a=='ા')
		    {return 'aQ1|';}
		else if($a=='િ')
		    {return 'ai';}
		else if($a=='ી')
		    {return 'aee';}
		else if($a=='ુ')
		    {return 'au';}
		else if($a=='ૂ')
		    {return 'aoo';}
		else if($a=='ૃ')
		    {return 'aru';}
		else if($a=='ૄ')
		    {return 'arru';}
		else if($a=='ૅ')
		    {return 'ae';}
		else if($a=='ે')
		    {return 'ae';}
		else if($a=='ૈ')
		    {return 'aui';}
		else if($a=='ૉ')
		    {return 'ao';}
		else if($a=='ો')
		    {return 'ao';}
		else if($a=='ૌ')
		    {return 'aou';}
		else if($a=='્')
		    {return 'a';}
		else if($a=='ૐ')
		    {return 'om';}
		else if($a=='ૠ')
		    {return 'rra';}
		else if($a=='ૡ')
		    {return 'lda';}
		else if($a=='ૢ')
		    {return 'lu';}
		else if($a=='ૣ')
		    {return 'ldu';}
		else if($a=='૦')
		    {return '0';}
		else if($a=='૧')
		    {return '1';}
		else if($a=='૨')
		    {return '2';}
		else if($a=='૩')
		    {return '3';}
		else if($a=='૪')
		    {return '4';}
		else if($a=='૫')
		    {return '5';}
		else if($a=='૬')
		    {return '6';}
		else if($a=='૭')
		    {return '7';}
		else if($a=='૮')
		    {return '8';}
		else if($a=='૯')
		    {return '9';}
		else if($a=='૱')
		    {return 'Rs.';}
		else{return $a;}
	}
	function gtoe($t){
		$i = mb_strlen($t);
		$a = 1;
		$str = '';
		while($a < ($i+1)){
			$tem = mb_substr($t,$a - 1,1);
			$str = $str.gujtoeng($tem);
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
?>