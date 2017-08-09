<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>文章列表</title>
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/public.css">
<link rel="stylesheet" type="text/css" href="__PUBLIC__/Css/iuan.css">
<script type="text/javascript" src="__PUBLIC__/Js/jquery-1.7.2.min.js"></script>
<script type="text/javascript" src="__PUBLIC__/Js/iuan.js"></script>
<!-- 全选反选 开始-->
<script type="text/javascript">
window.onload = function ()
{
	var oA = document.getElementsByTagName("a")[0];
	var oInput = document.getElementsByTagName("input");
	var oLabel = document.getElementsByTagName("label")[0];
	var isCheckAll = function ()
	{
		for (var i = 1, n = 0; i < oInput.length; i++)
		{
			oInput[i].checked && n++
		}
		oInput[0].checked = n == oInput.length - 1;
		oLabel.innerHTML = oInput[0].checked ? "全不选" : "全选"
	};
	//全选/全不选
	oInput[0].onclick = function ()
	{
		for (var i = 1; i < oInput.length; i++)
		{
			oInput[i].checked = this.checked
		}
		isCheckAll()
	};
	//反选
	oA.onclick = function ()
	{
		for (var i = 1; i < oInput.length; i++)
		{
			oInput[i].checked = !oInput[i].checked
		}
		isCheckAll()
	};
	//根据复选个数更新全选框状态
	for (var i = 1; i < oInput.length; i++)
	{
		oInput[i].onclick = function ()
		{
			isCheckAll()
		}
	}
}
</script>
<!-- 全选反选 结束-->
</head>

<body>
	<table class="table">

		<tr>
			<td align="center"><strong><input type="checkbox" id="checkAll"/><label>全选</label><a href="javascript:;">反选</a></strong></td>
			<td align="center"><strong>ID</strong></td>
			<td align="center"><strong>标题</strong></td>
			<td align="center"><strong>所属分类</strong></td>
			<td align="center"><strong>点击次数</strong></td>
			<td align="center"><strong>发布时间</strong></td>
			<td align="center"><strong>文章添加者</strong></td>
			<td align="center"><strong>操作</strong></td>
		</tr>
		<?php if(is_array($blog)): foreach($blog as $key=>$v): ?><tr>
				<td align="center" width="8%">
					<input type="checkbox" id="item" name="item" value="<?php echo ($v["id"]); ?>"/>
				</td>
				<td align="center" width="8%">
					<?php echo ($v["id"]); ?>
				</td>
				<td>
					<?php echo ($v["title"]); ?>[<?php echo (iuan_blog_index($v["flag"])); ?>]
				</td>
				<td align="center" width="15%">
					<?php echo ($v["cate"]); ?>
				</td>
				<td align="center" width="10%">
					<?php echo ($v["click"]); ?>
				</td>
				<td align="center" width="10%">
					<?php echo ($v["createtime"]); ?>
				</td>
				<td align="center" width="10%">
					<?php echo ($v["name"]); ?>
				</td>
				<td align="center" width="15%">
					<?php if(ACTION_NAME == index): if(($v['ispass']) == "1"): ?>[<a href="<?php echo U(GROUP_NAME . '/Blog/passOne',array('id' => $v['id'],'ispass' =>0));?>">审核通过</a>]
						<?php else: ?>
							[<a href="<?php echo U(GROUP_NAME . '/Blog/passOne',array('id' => $v['id'],'ispass' =>1));?>">待审核</a>]<?php endif; ?>
						[<a href="<?php echo U(GROUP_NAME . '/Blog/modify',array('id' => $v['id']));?>">修改</a>]
						[<a href="javascript:if(confirm('确实要删除吗?'))location='<?php echo U(GROUP_NAME . '/Blog/toTrach',array('id' => $v['id'] ,'type' =>4));?>'">删除</a>]
					<?php else: ?>
						[<a href="<?php echo U(GROUP_NAME . '/Blog/toTrach',array('id' => $v['id'] ,'type' =>1));?>">还原</a>]
						[<a href="javascript:if(confirm('确实要删除吗?'))location='<?php echo U(GROUP_NAME . '/Blog/toDel',array('id' => $v['id']));?>'">彻底删除</a>]<?php endif; ?>
				</td>
			</tr><?php endforeach; endif; ?>

	</table>
	<div class="result page"><?php echo ($page); ?></div>
	<input type="hidden" name="urlaction" id="urlaction" value="<?php echo ($urlaction); ?>">
	<?php if(ACTION_NAME == index): ?><div class="All_action">
			<span id="All_del" Onclick="All_del()">批量删除</span>
			<span id="All_pass" Onclick="All_pass()">批量审核</span>
		</div>
	<?php else: ?>
		<div class="All_action">
			<span id="All_del" Onclick="All_del_over()">批量彻底删除</span>
			<span id="All_pass" Onclick="All_restore()">批量还原</span>
		</div><?php endif; ?>
</body>
</html>