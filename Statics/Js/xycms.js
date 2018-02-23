// form 
$(document).ready(function(){	
	$("#dh").keyup(function(){
	   if($.trim($("#dh").val())!==''){
		   $("#dhunmber").text('');
	   }

	});
	$("#b_name").keyup(function(){
	   if($.trim($("#b_name").val())!==''){
		   $("#b_n_t").text('');
	   }

	});
	$("#b_title").keyup(function(){
	   if($.trim($("#b_title").val())!==''){
		   $("#b_sm_t").text('');
	   }

	});
	
    $("#p_form").submit(function(){
	   if(xymcs_submit()){
		   return true;
	   }else{
		   return false;
		   }
	   
	});
});

function xymcs_submit(){
	var dh = $.trim($("#dh").val());
	var b_name = $.trim($("#b_name").val());
	var b_title = $.trim($("#b_title").val());
	var b_content = $.trim($("#b_content").val());
	if(b_title == ""){
		$("#b_sm_t").text("请输入留言标题");
		$("#b_title").focus();
		return false;
	}
	if(b_content == ""){
		alert('请输入留言内容');
		$("#b_content").focus();
		return false;
	}
	if(b_content.length<=8){
		alert('留言字数太少啦，请多写点哦！');
		$("#b_content").focus();
		return false;
	}
	if(b_name == ""){
		$("#b_n_t").text("请输入留言用户名");
		$("#b_name").focus();
		return false;
	}
	if(dh == ""){
		$("#dhunmber").text("请输入快件单号");
		$("#dh").focus();
		return false;
	}
	return true;
}


function xycms_loadcode(){
	$('#checkCode').html('<img src="code.php?act=yes" align="middle">');
	$('#tip').hide();
} 
