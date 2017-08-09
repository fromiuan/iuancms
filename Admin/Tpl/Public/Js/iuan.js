$(function(){
	resize_window();
	$(window).resize(function(){
		resize_window();
	});
	$('.demo-cancel-click').click(function(){return false;});
})

function resize_window(){
	$("#left").height($(window).height()-42);
	$("#right").height($(window).height()-42).width($(window).width()-211);
}


//提交反馈mian
function feedBack(){
	var yourname = $("#yourname").val();
	var youremail = $("#youremail").val();
	var content = getContentTxt();
	if (yourname=='') {
		alert('请填写姓名');
	}else if(youremail==''){
		alert("请填写邮箱");
	}else if(content ==''){
		alert("请填写内容")
	}else{
		$.ajax({
			type: "POST",
			url: "./send_mail",
			data: "content="+content+"",
			success: function(msg){
				alert(msg);
			}
		});
	}
}

//Ueditor获取函数内容
function getContentTxt() {
    var arr = [];
    arr.push(UE.getEditor('content').getContentTxt());
    return arr;
}

//文章添加高级设置
function showAdSet(){
	$("#adSet").toggle();
}

//日期时间插件
function opcal(){
    J.calendar.Show();
}

//增加点击数
function checkNum(){
	var Num=Math.floor(Math.random()*1000+1);
	$("#click").val(Num);
}

//Blog出现图片
function showLitpic(){
	$("#litpic").toggle();
	$("#isLitpic").toggle('slow');
}

//批量删除文章
function All_del(){
	if(confirm("确实要删除吗?")){
		if($("#item:checked").length>0){
		var numArray=new Array();
		var urls=$("#urlaction").val();				//获取URL
	      $("#item:checked").each(function(){  
	      	numArray.push($(this).val());
	      })
	      $.ajax({
				type:"GET",
				url: urls+"admin.php/Blog/All_del",
				data: "num="+numArray+"",
				success: function(msg){
					window.location.reload()
					alert(msg);
				}
			});
	      // alert(numArray);  
	    }else {  
	      alert("请选你要操作的文章");  
	    }
	}
}


//批量审核文章
function All_pass(){
	if($("#item:checked").length>0){
		var numArray=new Array();
		var urls=$("#urlaction").val();				//获取URL
	      $("#item:checked").each(function(){  
	      	numArray.push($(this).val());
	      })
	      $.ajax({
				type:"GET",
				url: urls+"admin.php/Blog/All_pass",
				data: "num="+numArray+"",
				success: function(msg){
					window.location.reload()
					alert(msg);
				}
			});
	      // alert(numArray);  
	}else {  
	    alert("请选你要操作的文章");  
	}
}

//批量彻底删除
function All_del_over(){
	if(confirm("确实要删除吗?")){
		if($("#item:checked").length>0){
			var numArray=new Array();
			var urls=$("#urlaction").val();				//获取URL
		      $("#item:checked").each(function(){  
		      	numArray.push($(this).val());
		      })
		      $.ajax({
					type:"GET",
					url: urls+"admin.php/Blog/All_del_over",
					data: "num="+numArray+"",
					success: function(msg){
						window.location.reload()
						alert(msg);
					}
				});
		      // alert(numArray);  
		}else {  
		    alert("请选你要操作的文章");  
		}
	}
}

//批量还原文章
function All_restore(){
	if($("#item:checked").length>0){
		var numArray=new Array();
		var urls=$("#urlaction").val();				//获取URL
	      $("#item:checked").each(function(){  
	      	numArray.push($(this).val());
	      })
	      $.ajax({
				type:"GET",
				url: urls+"admin.php/Blog/All_restore",
				data: "num="+numArray+"",
				success: function(msg){
					window.location.reload()
					alert(msg);
				}
			}); 
	}else {  
	    alert("请选你要操作的文章");  
	}
}

//添加水印按钮
function picWater(){
	if($("#isWater:checked").length){
		var isWater=1;
	}else{
		var isWater=0;
	}
	$.ajax({
				type:"GET",
				url: "../Blog/water",
				data: "isWater="+isWater+"",
				// success: function(msg){
				// 	alert(msg);
				// }
	}); 
}


//*************************** 栏目JS ********************************///
//链接出现
function toUrl(){
	if($("#linkUrl:checked").length>0){
		$("#linkTxt").css("display","block");
	}else{
		$("#linkTxt").css("display","none");
	}
}

//文章添加高级设置
function showCont(){
	$("#adCont").toggle();
}

