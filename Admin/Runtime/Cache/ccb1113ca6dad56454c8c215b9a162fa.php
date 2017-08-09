<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
		<link rel="stylesheet" href="__PUBLIC__/Css/login.css" />
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
		<script type="text/javascript" src="__PUBLIC__/Js/login.js"></script>
		<script type="text/javascript">
			function changSrc(){
				var oCode=document.getElementById('code');
				oCode.src=oCode.src+"?"+Math.random();
			}
		</script>
	</head>
	<body>
		<div id="top">

		</div>
		<div class="login">	
			<form action="<?php echo U(GROUP_NAME.'/Login/login');?>" method="post" id="login">
			<div class="title">
				IUANCMS | 登录后台
			</div>
			<table border="1" width="100%">
				<tr>
					<th>管理员帐号:</th>
					<td>
						<input type="username" name="username" class="len250"/>
					</td>
				</tr>
				<tr>
					<th>密码:</th>
					<td>
						<input type="password" class="len250" name="password"/>
					</td>
				</tr>
				<tr>
					<th>验证码:</th>
					<td>
						<input type="code" class="len250" name="code"/> <img src="<?php echo U(GROUP_NAME . '/Login/verify');?>" id="code"/> <a href="javascript:;" onclick='changSrc()'>看不清</a>
					</td>
				</tr>
				<tr>
					<td colspan="2" style="padding-left:160px;"> <input type="submit" class="submit" value="登录"/></td>
				</tr>
			</table>
		</form>
	</div>
	</body>
</html>
<script>
//登录验证  1为空   2为错误
var validate={username:1,password:1,code:1}
$(function(){
	$("#login").submit(function(){
		if(validate.username==0 && validate.password==0 && validate.code==0){
			return true;
		}
		//验证用户名
		$("input[name='username']").trigger("blur");
		//验证密码
		$("input[name='password']").trigger("blur");
		//验证验证码
		$("input[name='code']").trigger("blur");
		return false;
	})
	//验证用户名
	$("input[name='username']").blur(function(){
		var username = $("input[name='username']");
		if(username.val().trim()==''){
			username.parent().find("span").remove().end().append("<span class='error'>用户名不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkusername",{username:username.val().trim()},function(stat){
			if(stat==1){
				validate.username=0;
				username.parent().find("span").remove();
			}else{
				username.parent().find("span").remove().end().append("<span class='error'>用户不存在</span>");
			}

		})
	})
	//验证密码
	$("input[name='password']").blur(function(){
		var password = $("input[name='password']");
		var username=$("input[name='username']");
		if(username.val().trim()==''){
			return;
		}
		if(password.val().trim()==''){
			password.parent().find("span").remove().end().append("<span class='error'>密码不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkpassword",{password:password.val().trim(),username:username.val().trim()},function(stat){
			if(stat==1){
				validate.password=0;
				password.parent().find("span").remove();
			}else{
				password.parent().find("span").remove().end().append("<span class='error'>密码错误</span>");
			}

		})
	})
	//验证验证码
	$("input[name='code']").blur(function(){
		var code = $("input[name='code']");
		if(code.val().trim()==''){
			code.parent().find("span").remove().end().append("<span class='error'>验证码不能为空</span>");
			return ;
		}
		$.post(CONTROL+"/checkcode",{code:code.val().trim()},function(stat){
			if(stat==1){
				validate.code=0;
				code.parent().find("span").remove();
			}else{
				code.parent().find("span").remove().end().append("<span class='error'>验证码错误</span>");
			}

		})
	})
})

function change_code(obj){
	$("#code").attr("src",URL+Math.random());
	return false;
}
</script>