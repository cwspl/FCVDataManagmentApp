function update(link) 
{ 
sendd(link);
}
function odiv(p,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/'+p+'.php', div);
}
function nav_btn(p,div){
	document.getElementById('nav_cnt_btn').className = 'navbar-toggle collapsed';
	document.getElementById('bs-example-navbar-collapse-1').className = 'navbar-collapse collapse';
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/'+p+'.php', div);
}
function odiv_a(p,a,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/'+p+'.php'+a, div);
}
function otab(p,y,a,c,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/tab/'+p+'.php?yr='+y+'&ar='+a+'&cid='+c, div);
	mt("table");
}
function otab_y(p,y,a,c,div){
	y = document.getElementById(y).value;
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
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
function pc_kup(id,ur,er,div){
	if(document.getElementById(id).value.length == 4){
		pc_log(id,ur,er,div);
	}
}
function pc_log(id,ur,er,div){
	var p = document.getElementById(id).value;
	var u = document.getElementById(ur).value;
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
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/home.php?p='+p+'&u='+u, div);
	}
}

function ch_pass(op,np,er,div){
	if(!isFinite(document.getElementById(op).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Old Passcode is contain Numbers Only !";
	document.getElementById(op).focus();document.getElementById(op).value = '';
	} else if(document.getElementById(op).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Old Passcode is Empty !";
	document.getElementById(op).focus();document.getElementById(op).value = ''
	} else if(document.getElementById(op).value.trim().length != 4){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Old Passcode must 4 digits !";
	document.getElementById(op).focus();document.getElementById(op).value = ''
	} else if(!isFinite(document.getElementById(np).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode is contain Numbers Only !";
	document.getElementById(np).focus();document.getElementById(np).value = '';
	} else if(document.getElementById(np).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode is Empty !";
	document.getElementById(np).focus();document.getElementById(np).value = ''
	} else if(document.getElementById(np).value.trim().length != 4){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode must 4 digits !";
	document.getElementById(np).focus();document.getElementById(np).value = ''
	} else {
		op = document.getElementById(op).value;
		np = document.getElementById(np).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/chpc.php?op='+op+'&np='+np, div);
	}
}

function aatu(vl,btn,na){
	if(document.getElementById(vl).value == '0'){
		document.getElementById(vl).value = '1';
		document.getElementById(btn).className = 'btn btn-block btn-social btn-success';
		document.getElementById(btn).innerHTML = '<i class="glyphicon glyphicon-ok"></i> '+na;
	} else {
		document.getElementById(vl).value = '0';
		document.getElementById(btn).className = 'btn btn-block btn-social btn-default';
		document.getElementById(btn).innerHTML = '<i class="glyphicon glyphicon-plus"></i> '+na;
	}
}
function src_c(id,div,p){
	var q = document.getElementById(id).value;
	if(document.getElementById(id).value.trim().length > 2){
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
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
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/rada.php?q='+q, div);
	}
}
function aaapusr(er,div,id){
	var np = "pass";
	if(document.getElementById('name').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> User Name is Empty !!";
	} else if(!isFinite(document.getElementById(np).value)){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode is contain Numbers Only !";
	document.getElementById(np).focus();document.getElementById(np).value = '';
	} else if(document.getElementById(np).value.trim().length == 0){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode is Empty !";
	document.getElementById(np).focus();document.getElementById(np).value = ''
	} else if(document.getElementById(np).value.trim().length != 4){
	document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> New Passcode must 4 digits !";
	document.getElementById(np).focus();document.getElementById(np).value = ''
	} else {
		na = document.getElementById("name").value;
		np = document.getElementById(np).value;
		var arary = "";
		var aarary = JSON.parse("["+document.getElementById("araarry").value.substring(1)+" ]" );
		var arrlen = aarary.length;
		var i;
		for(i = 0; i < arrlen; i++){
			if(document.getElementById(aarary[i]).value != '0'){
				arary = arary+"&ar"+i+"="+aarary[i].substring(6);
			} else {
				arary = arary+"&ar"+i+"=XX";
			}
		}
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/raapu.php?na='+na+'&ps='+np+arary+'&id='+id, div);
	}
}
		
function adc(er,div){
	if(document.getElementById('name').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Connection Name is Empty !!";
	} else if((document.getElementById('mno').value.trim().length != 0) && (document.getElementById('mno').value.trim().length != 10)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Mobile Number !!";
	} else if((document.getElementById('ano').value.trim().length != 0) && (document.getElementById('ano').value.trim().length <= 3)){
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
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
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
	} else if((document.getElementById(ano).value.trim().length != 0) && (document.getElementById(ano).value.trim().length <= 3)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else {
		id = document.getElementById(id).value;
		ar = document.getElementById(ar).value;
		name = document.getElementById(name).value;
		mno = document.getElementById(mno).value;
		ano = document.getElementById(ano).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/'+p+'.php?id='+id+'&aid='+ar+'&name='+name+'&mno='+mno+'&ano='+ano, div);
	}
}

function ejm(id,p,div,er){
	if(document.getElementById(id).value.trim().length != 0){
		id = document.getElementById(id).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/'+p+'.php?id='+id, div);
	} else {
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Jama Selected !!";
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
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
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
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/'+p+'.php?id='+id+'&amt='+amt+'&m='+m+'&y='+y, div);
	}
}
function refrow(id,y,div){
	var yr = document.getElementById(y).value;
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/tab/refrow.php?cid='+id+'&yr='+yr, div);
}
function mtab(id,tid,btn){
	document.getElementById(id).style.display = 'block';
	document.getElementById(btn).style.display = 'none';
	mt(tid);
}
function mt(t) {
    $('#'+t).DataTable( {
        dom: 'Bfrtip',
        buttons: [
		{
            extend: 'pdfHtml5',
            text: 'Download PDF'
        }
        ]
    } );
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
function printit(y,a,cid,btn,cnt){
	document.getElementById(btn).innerHTML = '<i class="glyphicon glyphicon-print"></i> Print Requested';
	document.getElementById(btn).style.display = 'none';
	update('src/rprint.php?y='+y+'&a='+a+'&cid='+cid);
	document.getElementById(cnt).style.display = 'block';
}
function entpr(id,cnt){
	var pc = document.getElementById(id).value;
	if(pc.length == 5){
		update('src/rprint2.php?pc='+pc);
		document.getElementById(cnt).innerHTML = '<i style="color:green"> <i class="glyphicon glyphicon-print"></i> Print Requested</i><br/>';
	}
}
function addaco(id,ano,div){
	if((document.getElementById(ano).value.trim().length != 0) && (document.getElementById(ano).value.trim().length <= 3)){
		document.getElementById(div).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else {
		ano = document.getElementById(ano).value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/addacno.php?id='+id+'&ano='+ano, div);
	}
}










function addc(er,div){
	if(document.getElementById('name').value.trim().length == 0){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Connection Name is Empty !!";
	} else if((document.getElementById('mno').value.trim().length != 0) && (document.getElementById('mno').value.trim().length != 10)){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Mobile Number !!";
	} else if(document.getElementById('ano').value.trim().length <= 3){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else {
		var name = document.getElementById('name').value;
		var mno = document.getElementById('mno').value;
		var ano = document.getElementById('ano').value;
		var dat = document.getElementById('dat').value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/XF0/raddc.php?name='+name+'&mno='+mno+'&ano='+ano+'&dat='+dat, div);
	}
}

function addca(er,div){
	if(document.getElementById('ano').value.trim().length <= 3){
		document.getElementById(er).innerHTML = "<i class='glyphicon glyphicon-remove'></i> Wrong Account Number !!";
	} else {
		var cid = document.getElementById('cid').value;
		var ano = document.getElementById('ano').value;
		var dat = document.getElementById('dat').value;
		document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
		loaddiv('src/XF0/raddca.php?cid='+cid+'&ano='+ano+'&dat='+dat, div);
	}
}

function refr(id,div){
	document.getElementById(div).innerHTML = '<div align="center"><h1 class="glyphicon glyphicon-refresh glyphicon-refresh-animate"></h1></div>';
	loaddiv('src/XF0/tab/refrow.php?cid='+id, div);
}