// JavaScript Document
function checkaddform(){
	if(document.addform.title.value==''){
		window.alert('请输入信息标题^_^');
		document.addform.title.focus();
		return false;
	}
	if(document.addform.catid.value==''||document.addform.catid.value==0){
		window.alert('请选择分类^_^');
		document.addform.catid.focus();
		return false;
	}
	return true;
}

function CheckAll(){ 
 for (var i=0;i<eval(addform.elements.length);i++){ 
  var e=addform.elements[i]; 
  if (e.name!="allbox") e.checked=addform.allbox.checked; 
 } 
}