function update(link) 
{ 
sendd(link);
}
function odiv(p,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/'+p+'.php', div);
}
function nav_btn(p,div){
	document.getElementById('nav_cnt_btn').className = 'navbar-toggle collapsed';
	document.getElementById('bs-example-navbar-collapse-1').className = 'navbar-collapse collapse';
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/'+p+'.php', div);
}
function odiv_a(p,a,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/'+p+'.php'+a, div);
}
function otab(p,y,a,c,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/tab/'+p+'.php?yr='+y+'&ar='+a+'&cid='+c, div);
	mt("table");
}
function otab_y(p,y,a,c,div){
	y = document.getElementById(y).value;
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/tab/'+p+'.php?yr='+y+'&ar='+a+'&cid='+c, div);
	mt("table");
}
function loaddiv(link, div)
{
var xmlhttp;
if (window.XMLHttpRequest){
xmlhttp=new XMLHttpRequest();}
else {
xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");}
xmlhttp.onreadystatechange=function(){
if (xmlhttp.readyState==4 && xmlhttp.status==200) {
document.getElementById(div).innerHTML=xmlhttp.responseText; }}
xmlhttp.open("GET",link,true);
xmlhttp.send();
}
function sendd(action)
{
    if(typeof XMLHttpRequest != "undefined")
    {
        oxmlHttpSend = new XMLHttpRequest();
    }
    else if (window.ActiveXObject)
    {
       oxmlHttpSend = new ActiveXObject("Microsoft.XMLHttp");
    }
    if(oxmlHttpSend == null)
    {
       alert("Browser does not support XML Http Request");
       return;
    }
    oxmlHttpSend.open("GET",action,true);
    oxmlHttpSend.send(null);
}





function ckl(id,er){
	if(document.getElementById(val).value.length == len){
		document.getElementById(id).focus();
	}
}
function pc_kup(id,er,div){
	if(document.getElementById(id).value.length == 4){
		pc_log(id,er,div);
	}
}
function pc_log(id,er,div){
	var p = document.getElementById(id).value;
	if(!isFinite(document.getElementById(id).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Passcode is contain Numbers Only !";
	document.getElementById(id).focus();document.getElementById(id).value = '';
	} else if(document.getElementById(id).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Passcode is Empty !";
	document.getElementById(id).focus();document.getElementById(id).value = ''
	} else if(document.getElementById(id).value.trim().length != 4){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Passcode must 4 digits !";
	document.getElementById(id).focus();document.getElementById(id).value = ''
	} else {
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/home.php?p='+p, div);
	}
}


function src_c(id,div,p){
	var q = document.getElementById(id).value;
	if(document.getElementById(id).value.trim().length > 2){
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/'+p+'.php?q='+q, div);
	}
	else if(document.getElementById(id).value.trim().length == 0){
		document.getElementById(div).innerHTML = "<i class='glyphicon glyphicon-remove'></i> It's Empty !!";
	}
}
function adar(id,er,div){
	if(document.getElementById(id).value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> It's Empty !!";
	} else {
		var q = document.getElementById(id).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/rada.php?q='+q, div);
	}
}

function adc(er,div){
	if(document.getElementById('name').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Connection Name is Empty !!";
	} else if((document.getElementById('mno').value.trim().length != 0) && (document.getElementById('mno').value.trim().length != 10)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Mobile Number !!";
	} else if((document.getElementById('ano').value.trim().length != 0) && (document.getElementById('ano').value.trim().length > 3)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else if(document.getElementById('mfd').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Monthly Fund is Empty !!";
	} else if(document.getElementById('tjm').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Total Jama is Empty !!";
	} else {
		var aid = document.getElementById('ara').value;
		var name = document.getElementById('name').value;
		var mno = document.getElementById('mno').value;
		var ano = document.getElementById('ano').value;
		var mo = document.getElementById('scm').value;
		var yr = document.getElementById('scy').value;
		var jmo = document.getElementById('jmm').value;
		var jyr = document.getElementById('jmy').value;
		var amt = document.getElementById('mfd').value;
		var jama = document.getElementById('tjm').value*document.getElementById('mmf').value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/radc.php?aid='+aid+'&name='+name+'&mno='+mno+'&ano='+ano+'&mo='+mo+'&yr='+yr+'&amt='+amt+'&jama='+jama+'&jmm='+jmo+'&jyr='+jyr, div);
	}
}

function edc(id,name,mno,ano,ar,p,div,er){
	if(document.getElementById(id).value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> No Connection Selected !!";
	} else if(document.getElementById(name).value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Connection Name is Empty !!";
	} else if((document.getElementById(mno).value.trim().length != 0) && (document.getElementById(mno).value.trim().length != 10)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Mobile Number !!";
	} else if((document.getElementById(ano).value.trim().length != 0) && (document.getElementById(ano).value.trim().length > 3)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else {
		id = document.getElementById(id).value;
		ar = document.getElementById(ar).value;
		name = document.getElementById(name).value;
		mno = document.getElementById(mno).value;
		ano = document.getElementById(ano).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/'+p+'.php?id='+id+'&aid='+ar+'&name='+name+'&mno='+mno+'&ano='+ano, div);
	}
}

function adfic(tid,id,divv){
	document.getElementById(tid).value = id;
	document.getElementById('abot').innerHTML = '<h4 style="clear: both; border-bottom: 1.5px solid #f4f4f4;color:gray;" align="center"> In '+divv+'</h4>';
}
function addf(id,amt,m,y,p,div,er){
	if(!isFinite(document.getElementById(amt).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Amount is contain Numbers Only !";
	} else if(document.getElementById(amt).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Amount is Empty !";
	} else if(document.getElementById(id).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Select Connection First !";
	} else {
		id = document.getElementById(id).value;
		m = document.getElementById(m).value;
		y = document.getElementById(y).value;
		amt = document.getElementById(amt).value*document.getElementById('mmf').value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/'+p+'.php?id='+id+'&amt='+amt+'&mo='+m+'&yr='+y, div);
	}
}

function cmf(id,amt,m,y,p,div,er){
	if(!isFinite(document.getElementById(amt).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Amount is contain Numbers Only !";
	} else if(document.getElementById(amt).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Amount is Empty !";
	} else if(document.getElementById(id).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Select Connection First !";
	} else {
		id = document.getElementById(id).value;
		m = document.getElementById(m).value;
		y = document.getElementById(y).value;
		amt = document.getElementById(amt).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
		loaddiv('src/'+p+'.php?id='+id+'&amt='+amt+'&m='+m+'&y='+y, div);
	}
}
function refrow(id,y,div){
	var yr = document.getElementById(y).value;
	document.getElementById(div).innerHTML = '<div align="center"><h1 style="font-size:150px;color:gray" class=" glyphicon-refresh-animate">+</h1></div>';
	loaddiv('src/tab/refrow.php?cid='+id+'&yr='+yr, div);
}
function mtab(id,tid,btn){
	document.getElementById(id).style.display = 'block';
	document.getElementById(btn).style.display = 'none';
	mt(tid);
}
function mt(t) {
    $('#'+t).DataTable({
		dom: 'Bfrtip',
		buttons : [
			'Print'
		]
	});
}
function odet(id,btn){
	if(document.getElementById(id).style.display == 'none'){
		document.getElementById(id).style.display = 'block';
		document.getElementById(btn).className = 'glyphicon glyphicon-chevron-up';
	} else {
		document.getElementById(id).style.display = 'none';
		document.getElementById(btn).className = 'glyphicon glyphicon-chevron-down';
	}
}
function printit(y,a,cid,btn){
	document.getElementById(btn).innerHTML = '<i class="glyphicon glyphicon-print"></i> Print Requested';
	document.getElementById(btn).disabled = true;
	update('src/rprint.php?y='+y+'&a='+a+'&cid='+cid);
}