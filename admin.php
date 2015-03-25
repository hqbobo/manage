<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
 <head>
    <title>管理后台</title>
  	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
  	<link rel="stylesheet" type="text/css" href="assets/css/main.css">
  	<link rel="stylesheet" type="text/css" href="assets/css/admin.css">
</head>
<body bgcolor="#303740">
<div class="body-container admin-bg">
	<div class="admin-field admin-main middle">
		<p class="title">用户管理</p>
		<div class="btn usr-add margin-from-title" group='1'><p>添加用户</p></div>
		<div class="btn usr-manage margin-normal" group='1'><p>用户管理</p></div>
		<div class="btn group-manage margin-normal" group='1'><p>科室管理</p></div>
		<div class="btn-exit margin-normal"><p>退出</p></div>
	</div>
	
	
	<div class="admin-field admin-user hidden ">
		<p class="title">创建用户</p>
		<input default_text="姓名" type="text" class="margin-from-title default" id="user_name">
		<input default_text="账号" type="text" class="margin-normal default" id="user_acct">
		<input default_text="密码" type="text" class="margin-normal default" id="user_pwd">
		<select class="margin-normal" id="id" placeholder="分组">
		</select>
		<select class="margin-normal" id="level">
			<option value="1">普通权限</option>
			<option value="2">管理员权限</option>
		</select>
		<div class="btn select  margin-from-title save"><p>保存</p></div>
	</div>
	
	<div class="admin-field admin-user-list right hidden ">
		<p class="title">用户列表</p>
		<div class="margin-from-title list-container">			
		</div>
	</div>
	<div class="admin-field user-del-confirm ">
		<p class="title">删除确定</p>
		<p class="name margin-from-title"></p>
		<input id="id" type="hidden">
		<div class="  margin-from-title ok"><p>确定</p></div>
		<div class="  margin-normal cancel"><p>取消</p></div>
	</div>	
	
	<div class="admin-field admin-prompt right hidden">
		<p class="title">左边选择后相应的人员名字</p>
		<select class="margin-from-title" id="user" placeholder="分组">
		</select>
		<select class="margin-from-title" id="level" placeholder="分组">
			<option value="1">普通权限</option>
			<option value="2">管理员权限</option>
		</select>
		<div class="btn select  margin-from-title save"><p>保存</p></div>
	</div>
	
	<div class="admin-field admin-group-main right hidden">
		<p class="title">用户管理</p>
		<div class="btn add margin-from-title" group='2'><p>新增科室</p></div>
		<div class="btn del margin-normal" group='2'><p>删除科室</p></div>
		<div class="btn modify margin-normal" group='2'><p>修改科室</p></div>
	</div>
	
<!-- 	新科室			 -->
	<div class="admin-field group-new right hidden">
		<p class="title">创建科室</p>
		<input placeholder="姓名" type="text" class="margin-from-title" id="group_name">

		<div class="btn select  margin-from-title save"><p>保存</p></div>
	</div>
<!-- 	删除科室			 -->
	<div class="admin-field group-del right hidden ">
		<p class="title">删除科室</p>
		<select class="margin-from-title" id="id" placeholder="分组">
		</select>

		<div class="btn select  margin-from-title save"><p>删除</p></div>
	</div>	
<!-- 	修改科室			 -->
	<div class="admin-field group-modify right hidden">
		<p class="title">修改科室</p>
		<select class="margin-from-title" id="gid" placeholder="分组">
		</select>
		<input placeholder="姓名" type="text" class="margin-from-title" id="group_name">
		<div class="btn select  margin-from-title save"><p>修改</p></div>
	</div>
<!-- 	修改验证			 -->
	<div class="admin-field group-modify-confirm hidden">
		<p class="title">修改</p>
		<p class="margin-from-title text">确定要将</p>
		<p class="margin-normal text old">确定要修改</p>
		<p class="margin-normal text">修改为</p>
		<p class="margin-normal text new">确定要修改</p>
		<input id="gid" type="hidden">
		<div class="  margin-from-title ok"><p>修改</p></div>
		<div class="  margin-normal cancel"><p>取消</p></div>
	</div>	
	<div id="mask" class="mask" style="display:none;">	
</div>

<!-- 	删除科室			 -->
	<div class="admin-field group-delete-confirm hidden">
		<p class="title">删除科室</p>
		<p class="margin-from-title text">确定要将删除</p>
		<p class="margin-from-title text old">确定要将删除</p>
		<div class="  margin-from-title ok"><p>删除</p></div>
		<div class="  margin-normal cancel"><p>取消</p></div>
	</div>

<!-- Le javascript
================================================== -->
<!-- Placed at the end of the document so the pages load faster -->
<script type="text/javascript" src="/assets/js/jquery-1.8.1.min.js"></script>
<script type="text/javascript" src="/assets/js/md5-min.js"></script>
<script type="text/javascript" src="/assets/js/public.js"></script>
<script type="text/javascript" src="/assets/js/admin.js"></script>
<script type="text/javascript" src="/assets/js/ui.js"></script>
<script type="text/javascript">
$(function(){
	function groupAdminAuth(json)
	{
		if(parseInt(json['t_level']) < 5)
		{

			window.location.href = '/logout.php';
		}
	}
	$.public.getUser(groupAdminAuth);

	$('.btn-exit').click(function(){
		window.location.href = '/logout.php';
	});


});
</script>

</body>
</html>
