var AjaxUp=null;
var isInit=false;
function showUpload(obj, inputID, Path, fcount, func){
	if(!isInit){
		var cont="<div id=\"upload_Box\" style=\"z-index:999;position:absolute;border:1px #D2D2D2 solid;padding:1px;width:510px;display:none;background-color:#fff;font-size:12px;\">";
		cont +="<div id=\"uploader_Title\" style=\"background-color:#0591D3 ;padding:4px; height:20px; line-height:20px; color:#FFF;\"><span style=\"float:right;cursor:pointer;\" onclick=\"this.parentNode.parentNode.style.display='none';Cover.hide();\">[关闭]</span>文件上传</div>";
		cont +="<p style=\" padding:2px; line-height:22px; color:#FD021C;\">支持格式：( jpg|bmp|gif|jpeg|png|rar|zip|txt|doc|xls|ppt|pdf|docx|xlsx|pptx ) size<20M</p><div id=\"uploadContenter\" style=\"\"></div>";
		cont +="<iframe style=\"display:none;\" name=\"up\"></iframe>";
		cont +="</div>";
		var tmpDiv  = document.createElement("div");
		    tmpDiv.innerHTML = cont;
			document.body.appendChild(tmpDiv);
			Drag("uploader_Title","upload_Box",-210,0);
			isInit = true;
	}
	Cover.init().show();
	try{
		AjaxUp.reset();
	}
	
	catch(ex){}var box=$$("upload_Box");
	if(obj){
		var ps=ABS(obj);box.style.left=ps.x - parseInt(box.style.width)/2 + 30 + "px";
		    box.style.top=ps.y +25 + "px";
	}else{
		box.style.left="50%";
		box.style.top="30%";
		box.style.marginLeft="-210px";
	}
	box.style.display="block";
	
	
	AjaxUp=new AjaxProcesser("uploadContenter");
	AjaxUp.target="up";
	AjaxUp.url="upload_save.php";
	AjaxUp.MaxFileCount=(isNaN(fcount) ? 999: fcount);
	AjaxUp.savePath=(Path.trim()!="" ? Path.trim(): "../uploads/image");
	AjaxUp.succeed=function(files){
		var info="";
		for(var i=0;i<files.length;i++){
			info+=files[i].name + ",";
		}
		info=info.substr(0,info.length-1);
		if(typeof(func)=="function"){
			func(files);
		}else{
			$$(inputID).value=info;
		}
		box.style.display="none";
		Cover.hide();
	};
	AjaxUp.faild=function(msg){
		box.style.display="none";
		alert("失败原因:" + msg);
		Cover.hide();
	}
}


String.prototype.utf8=function(){
	return encodeURIComponent(this.toString());
};
String.prototype.DeCode=function(){
	return decodeURIComponent(this.toString()).replace(/\+/g," ");
};
String.prototype.reg=function(r){
	return r.test(this.toString());
};
String.prototype.toNum=function(){
	return parseInt(this.toString());
};
String.prototype.trim=function(){
	return this.toString().replace(/^(\s+)|(\s+)$/,"");
};
Array.prototype.trim=function(){
	var a = new Array();
	for(var i=0;i<this.length;i++){
		if(typeof(this[i])=="string"){
			a[i] = this[i].trim();
		}else{
			a[i] = this[i];
		}
	}return a;
};


String.prototype.json=function(){
	try{
		eval("var jsonStr = (" + this.toString() + ")");
	}
	catch(ex){
		var jsonStr = null;
	}
	return jsonStr;
};								
				
function $$(){
	var elements = new Array();
	for (var i = 0; i < arguments.length; i++) {
		var element = arguments[i];
		if (typeof element == 'string') element = document.getElementById(element); 
		if (element){
		}else{
		  element = null;
		}
		if (arguments.length == 1) {
			return element; 
		} else {
			elements.push(element); 
		}
	} 
	return elements; 
}

function ABS(a){
	a = $$(a);
	var b ={x: a.offsetLeft, y: a.offsetTop};
	a = a.offsetParent;
	while (a){
		b.x += a.offsetLeft;
		b.y += a.offsetTop;
		a = a.offsetParent;
	}
	return b;
}

function Drag(source, target, offSetX, offSetY){
	source = typeof(source) == "object" ? source : document.getElementById(source);
	target = typeof(target) == "object" ? target : document.getElementById(target);
	var x0 = 0, y0 = 0, x1 = 0, y1 = 0, moveable = false, NS = (navigator.appName == 'Netscape');
	offSetX = typeof offSetX == "undefined" ? 0 : offSetX;offSetY = typeof offSetY == "undefined" ? 0 : offSetY;
	source.onmousedown = function(e){
		e = e ? e : (window.event ? window.event : null);
		if(e.button == (NS) ? 0 : 1){
		  if(!NS){
			  this.setCapture();
		  }
		  x0 = e.clientX ;
		  y0 = e.clientY ;
		  x1 = parseInt(ABS(target).x);  
		  y1 = parseInt(ABS(target).y);    
		  moveable = true; 
	    }
	};
	source.onmousemove = function(e){
		e = e ? e : (window.event ? window.event : null); 
		if(moveable){
			target.style.left = (x1 + e.clientX - x0 - offSetX) + "px";
			target.style.top  = (y1 + e.clientY - y0 - offSetY) + "px";
			this.style.cursor = "move";
		}
	};
	source.onmouseup = function (e){
		if(moveable){
			if(!NS){
				this.releaseCapture();
			}
			moveable = false;
			this.style.cursor = "default";
		}
	};
}

function GetWH(){
	var page = document.body;
	var ps ={w:0,h:0};
	if (!(document.compatMode && document.compatMode.indexOf('Back') == 0)){
		page = page.parentNode;
	}
	ps.h = parseInt(page.clientHeight) + parseInt(page.scrollTop);
	ps.w = parseInt(page.clientWidth) + parseInt(page.scrollLeft);
	return ps;
}

var Cover=window.Cover={
	ele:null,size:null,zindex:999,currentO:0,show:function(){
		this.ele.style.display="block";
		if(this.currentO < 30){
			this.currentO+=20;
			this.ele.style.filter ="progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.currentO + ")";
			this.ele.style.opacity=this.currentO/100;window.setTimeout("Cover.show()", 20);
		}
		return this;
	},hide:function(){
		if(this.currentO >= 0) {
			this.currentO-=30;
			this.ele.style.filter ="progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.currentO + ")";
			this.ele.style.opacity=this.currentO/100; 
			window.setTimeout("Cover.hide()", 20); 
		}else{
			this.ele.style.display="none";
		}
		return this;
	},init:function(obj){
		if(!obj){
			this.size=GetWH();
		}else{
			this.size.w=obj.offsetWidth;
			this.size.h=obj.offsetHeight;
		}if(!this.ele){
			var vele=document.createElement("div");
			this.ele=vele;document.body.appendChild(this.ele);
		}
		this.ele.style.filter ="progid:DXImageTransform.Microsoft.Alpha(opacity=" + this.currentO + ")";
		this.ele.style.opacity=this.currentO/100;this.ele.style.position="absolute";
		this.ele.style.backgroundColor="#ddd";this.ele.style.left="0px";
		this.ele.style.top="0px";
		this.ele.style.width=this.size.w + "px";
		this.ele.style.height=this.size.h + "px";
		this.ele.style.display="none";
		this.ele.style.zindex=this.zindex;window.onscroll=function(){
			if(Cover.ele.style.display!="none"){
				Cover.init().show();
			}
		};
		return this;
	}
};

var QString=function (searchStr){
	var url=window.location.search;
	if(url.indexOf("?")>=0){
		url=url.substr(1);
		var varis=url.split("&");
		for(var i in varis){
			var Ary=varis[i].split("=");
			if(Ary[0].toLowerCase()==searchStr.toLowerCase()){
				return Ary[1];
			}
		}
		return "";
	}else{
		return "";
	}
};
	
function getRandomString(len){
	var tmpStr = "abcd23efgh78ijklmn14opqr6tuvwxs5yz09";
	var resultStr = "";
	for(var i = 0; i<len ; i++){
		resultStr += tmpStr.substr(parseInt(Math.random() * 36),1);
	}
	return resultStr;
}


var _Ajax=window.Ajax=function (options){
	var settings = {
		asc: true,url: "",dataType: "text",method: "get",data: "",timeout:10000,succeed: function(a,b,c){
			return true
		},error: function(a,b,c){
			return true
		},ontimeout:function(a){
			return true
		}
	};
	if(options) {
		Ajax_Extend(settings, options);
	}
	var isTimeout=false;
	var s=settings;
	var a=Ajax_GetObj();
	var u=s.url;
	var b=u.indexOf("?") == -1 ? false:true;
	u= b ? u + "&Picrnd=" + Ajax_Rnd() : u + "?Picrnd=" + Ajax_Rnd();
	if(s.method.toLowerCase()=="get"){
		u=s.data=="" ? u : u + "&" + s.data;
	}
	var d=null;
	if(s.method.toLowerCase()=="post"){
		d=s.data
	}
	a.open(s.method,u,s.asc);
	if(s.method.toLowerCase()=="post"){
		a.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
	}
	window.setTimeout(function(){
							   isTimeout=true;
	},s.timeout);
	a.onreadystatechange =function(){
		if(isTimeout){
			s.ontimeout();
			a.abort();
			a=null;
			return;
		}if(a.readyState==4){
			if(a.status==200){
				var t=s.dataType.toLowerCase();
				if(t=="text"){
					s.succeed(a.responseText,a,s);
				}
				if(t=="xml"){
					s.succeed(a.responseXML,a,s);
				}
				if(t=="json"){
					try{
						eval("j=" + a.responseText);
					}catch(ex){
						j = null;
					}
					s.succeed(j,a,s);
				}
				a=null;
			}else{
				s.error(a.status,a,s);
				a=null;
			}
		}
	};
	a.send(d);
	if(!(navigator.appName=='Microsoft Internet Explorer')){
		if(a.readyState==4){
			if(a.status==200){
				var t=s.dataType.toLowerCase();
				if(t=="text"){
					s.succeed(a.responseText,a,s);
				}if(t=="xml"){
					s.succeed(a.responseXML,a,s);
				}
				if(t=="json"){
					eval("j=" + a.responseText);
					s.succeed(j,a,s);
				}
				a=null;
			}else{
				s.error(a.status,a,s);
				a=null;
			}
		}
	}
};


var Ajax_GetObj = function (){
	var b=null;
	if (window.ActiveXObject) {
		var httplist = ["MSXML2.XMLHttp.5.0","MSXML2.XMLHttp.4.0","MSXML2.XMLHttp.3.0","MSXML2.XMLHttp","Microsoft.XMLHttp"];
		for(var i = httplist.length -1;i>=0;i--){
			try{
				b= new ActiveXObject(httplist[i]);
				return b;
			}catch(ex){}
		}
	}else if (window.XMLHttpRequest) {
		b= new XMLHttpRequest();
	}
	return b;
};

var Ajax_Rnd = function (){
	var tmpStr = "abcd23efgh78ijklmn14opqr6tuvwxs5yz09";
	var resultStr = "";
	var len=10;
	for(var i = 0; i<len ; i++){
		resultStr += tmpStr.substr(parseInt(Math.random() * 36),1);
	}
	return resultStr;
};

var Ajax_Extend = function (a, b){
	for(var m in b){
		a[m]=b[m];
	}
	return a;
};

function AjaxProcesser(objID){
	this.target="";
	this.defaultStyle=false;
	this.interValID=0;
	this.timeTick=500;
	this.processID="";
	this.frm=null;this.submit=null;
	this.processIng=null;
	//this.processBar=null;
	this.process=null;
	this.processInfo=null;
	this.uploader=null;
	this.split=null;
	this.appendTo=$$(objID);
	this.appendTo.style.cssText="padding:3px";
	this.files={count:0};
	this.createUploader();
	this.startTime=0;
	this.files={count:0,list:{}};
	this.url="";
	this.savePath="";
	this.FileCount=1;
	this.MaxFileCount=999;
}

AjaxProcesser.prototype.succeed=function(a){
	return;
};

AjaxProcesser.prototype.faild=function(a){
	return;
};

//添加input
AjaxProcesser.prototype.addFile=function(){
	if(this.FileCount>=this.MaxFileCount){
		alert("超过允许的最大文件上传数量；\n\n最多允许上传" + this.FileCount + "个文件");
		return;
	}
	_this=this;
	var file=document.createElement("input");
		file.type="file";
		file.name="file[]";
		file.size=60;
		if(!this.defaultStyle){
			file.style.cssText="font-size:9pt;border:1px #DDD solid; margin-bottom:2px; padding:3px 3px 3px 3px;height:20px;";
		}
		var b=document.createElement("br");
			this.frm.insertBefore(b,this.split);
			this.frm.insertBefore(file,this.split);
			var remove=document.createElement("input");
			remove.value="移除";
			remove.type="button";
			if(!this.defaultStyle){
				remove.style.cssText="font-size:9pt;border:1px #DDD solid;padding:3px 3px 3px 3px; vertical-align:middle; color:#f00; height:20px;margin-left:3px;";
			}
			remove.onclick=function(){
				_this.frm.removeChild(this.previousSibling.previousSibling);
				_this.frm.removeChild(this.previousSibling);
				_this.frm.removeChild(this);
				_this.FileCount--;
			};
			this.frm.insertBefore(remove,this.split);
			this.FileCount++;
};

AjaxProcesser.prototype.reset=function(){
	while(this.appendTo.childNodes){
		this.appendTo.removeChild(this.appendTo.lastChild);
	}
};

AjaxProcesser.prototype.createUploader=function(){
	_this=this;
	var frm=document.createElement("form");
	frm.method="post";
	frm.encoding="multipart/form-data";
	frm.style.cssText="padding:0px;margin:0px;";
	var file=document.createElement("input");
	file.type="file";
	file.name="file[]";
	file.size=60;
	if(!this.defaultStyle){
		file.style.cssText="font-size:9pt; margin-bottom:2px;  border:1px #DDD solid;padding:3px 3px 3px 3px;height:20px;";
	}
	this.files[file.name]=file;
	frm.appendChild(file);
	var split=document.createElement("br");
	frm.appendChild(split);
	this.split=split;
	var button=document.createElement("input");
	button.value="开始上传";
	button.type="button";
	if(!this.defaultStyle){
		button.style.cssText="font-size:9pt;border:1px #DDD solid;padding:3px 3px 3px 3px;height:20px;margin-top:4px;";
	}
	button.onclick=function(){
		//_this.processID=getID();
		var action="";
		action=_this.url + "?path=" + _this.savePath;
		_this.frm.action=action;
		_this.frm.target=_this.target;
		_this.frm.submit();
		
	};
	var add=document.createElement("input");
	add.value="添加更多文件";
	add.type="button";
	if(!_this.defaultStyle){
		add.style.cssText="font-size:9pt;border:1px #DDD solid; padding:3px 3px 3px 3px;height:20px;margin-top:4px;margin-left:5px;";
	}
	add.onclick=function(){
		_this.addFile();
	};
	frm.appendChild(button);
	frm.appendChild(add);
	this.frm=frm;
	this.appendTo.appendChild(frm);
};




/*获取上传信息*/
AjaxProcesser.prototype.getInformation=function(info){
	var uploadInfo={
		ID:info.ID,
		stepId:0,
		step:info.step,
		DT:info.dt,
		total:info.total,
		cur:info.now,
		speed:reSize(parseInt(info.now/((Date.parse(new Date())-this.startTime)/1000))) + "/秒",
		process:(Math.floor((info.now / info.total) * 100) / 100),  
		percent:(Math.floor((info.now / info.total) * 10000) / 100) + "%", 
		alt:"",
		msg:"",
		finish:false
	};
	/*状态说明*/
	switch(info.step){
	case "":
		uploadInfo.alt="正在初始化上传...";
		uploadInfo.stepId=1;
		break;
	case "uploading":
		uploadInfo.alt="正在上传...";
		uploadInfo.stepId=2;
		break;
	case "uploaded":
		uploadInfo.alt="上传完毕,服务器处理数据中...";
		uploadInfo.stepId=3;
		break;
	case "processing":
		uploadInfo.alt="正在处理文件: " + info.description;
		uploadInfo.stepId=4;
		break;
	case "processed":
		uploadInfo.alt="处理数据完毕,准备保存文件...";
		uploadInfo.stepId=5;
		break;
	case "saving":
		uploadInfo.alt="正在保存文件: " + info.description;
		uploadInfo.stepId=6;
		break;
	case "saved":
		uploadInfo.alt="文件保存完毕,上传成功!";
		uploadInfo.msg=eval("[" + info.description + "]");
		uploadInfo.stepId=7;
		uploadInfo.finish=true;
		break;
	case "faild":
		uploadInfo.alt="上传失败!";
		uploadInfo.msg=info.description;
		uploadInfo.stepId=8;
		uploadInfo.finish=true;
		break;
	default:
		uploadInfo.alt="无此操作!";
		uploadInfo.stepId=9;
		uploadInfo.finish=true;
	}
	return uploadInfo;
};

var getID=function (){
	var mydt=new Date();
	with(mydt){
		var y=getYear();
		if(y<10){y='0'+y}
		var m=getMonth()+1;
		if(m<10){m='0'+m}
		var d=getDate();
		if(d<10){d='0'+d}
		var h=getHours();
		if(h<10){h='0'+h}
		var mm=getMinutes();
		if(mm<10){mm='0'+mm}
		var s=getSeconds();
		if(s<10){s='0'+s}
	}
	var r="000" + Math.floor(Math.random() * 1000);
	r=r.substr(r.length-4);
	return y + m + d + h + mm + s + r;
};