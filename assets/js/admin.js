// JavaScript Document
(function($) {
	var main = $('.admin-main');
	var admin_user = $('.admin-user');
	var admin_prompt = $('.admin-prompt');
	var admin_group_main = $('.admin-group-main');
	var group_new = $('.group-new');
	var group_del = $('.group-del');
	var group_modify = $('.group-modify');
	var admin_user_list = $('.admin-user-list');
	$.admin = {
		userPwdChange : function(pwd, func){
			var data = 'act=userPwdChange&pwd=' + pwd;

			$.ajax({
				url : '/action/loginAction.php',
				type : 'post',
				data : data,// form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					if(func) func();
					// window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					//alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						alert(json['msg']);
						break;
					default:
						alert(json['msg']);
						break;
					}
					if(func) func();
				}
			});
		},
		userAdd : function(name,acct,pwd,group,level) {
			var data = 'act=add&name=' + name+'&acct='+acct+'&pwd='+pwd+'&group='+group+'&level='+level;
			
			$.ajax({
				url : '/action/userAction.php',
				type : 'post',
				data : data,// form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					// window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					// alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						alert(json['msg']);
						break;
					default:
						alert(json['msg']);
						break;
					}
				}
			});
		},
		userDel : function(id, funcAfter) {
			var data = 'act=del&id='+id;
			
			$.ajax({
				url : '/action/userAction.php',
				type : 'post',
				data : data,// form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					// window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					// alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						alert(json['msg']);
						funcAfter();
						break;
					default:
						alert(json['msg']);
						break;
					}
				}
			});
		},
		userUpdate : function(id, level) {
			var data = 'act=update&id='+id+'&level='+level;
			$.ajax({
				url : '/action/userAction.php',
				type : 'post',
				data : data,// form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					// window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					// alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						alert(json['msg']);
						break;
					default:
						alert(json['msg']);
						break;
					}
				}
			});
		},
		userGetAll:function(func)		
		{   
			var data = 'act=getall';

			$.ajax({
	            url : '/action/userAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	func(json['data']);
	                        break;
	                    case 15:
	                    	break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		userGetByGroup:function(group ,func)		
		{   
			var data = 'act=getbygroup&group='+group;

			$.ajax({
	            url : '/action/userAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            async:false,
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	func(json['data']);
	                        break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		groupAdd:function(name)		
		{   
			var data = 'act=add&name='+name;

			$.ajax({
	            url : '/action/groupAction.php',
	            type : 'post',
	            data : data,// form.serialize(),
	            cache : false,
	            dataType : "json",
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	alert(json['msg']);
	                        break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		groupUpdate:function(id, name,funcAfter)		
		{   
			var data = 'act=update&id='+id+'&name='+name;
			$.ajax({
	            url : '/action/groupAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	alert(json['msg']);
	                    	if(funcAfter != null)
	                    		funcAfter();
	                    	
	                        break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		groupDel:function(id, funcAfter)		
		{   
			var data = 'act=delete&id='+id;

			$.ajax({
	            url : '/action/groupAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	alert(json['msg']);
	                    	if(funcAfter != null)
	                    		funcAfter();
	                    	
	                        break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		groupGetAll:function(func)		
		{   
			var data = 'act=getall';

			$.ajax({
	            url : '/action/groupAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            async:false,
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	             },
	            success : function(json, textStatus) {
	            	//alert(JSON.stringify(json));
	                switch(json['status']){
	                    case 0:
	                    	func(json['data']);
	                        break;
	                    case 15:
	                    	break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	            }
	        });
		},
		
	};
	function hideAll()
	{
		main.hide();
		admin_user.hide();
		admin_prompt.hide();
		admin_group_main.hide();
		group_new.hide();
		group_del.hide();
		group_modify.hide();
		admin_user_list.hide();
	}
	function postionClear(obj)
	{
		obj.hide();
		obj.removeClass('left');
		obj.removeClass('right');
		obj.removeClass('middle');
	}
	function unSelectAll(group){
		$('.btn').each(function(){
			if($(this).attr('group') == group)
			$(this).removeClass('select');
		});
	};
	function isSelect(obj)
	{
		return obj.hasClass('select');
	};
	
	$('.btn').click(function(){
		
		if(!isSelect($(this)))
		{
			unSelectAll($(this).attr('group'));
			$(this).addClass('select');
		}
//		else
//		{
//			unSelectAll($(this).attr('group'));
//		}
		
	});
	$('.usr-add').click(function(){
		hideAll();
		if(isSelect($(this)))
		{
			var select = $('.admin-user #id');
			postionClear(main);
			main.show();
			main.addClass('left');
			
			postionClear(admin_user);
			admin_user.show();
			admin_user.addClass('middle');
			
			$.admin.groupGetAll(function(list){					
				var html = "";
				for(var i in list)
				{
					html += '<option value="'+list[i].t_pkId+'">'+list[i].t_groupName+'</option>';
				}
				select.html(html);
			});
			
		}
		else
		{
			postionClear(main);
			main.show();
			main.addClass('middle');
		}
	});
	$('.admin-user .save').click(function(){
		var root = $(this).parent('div');
		var name = root.find('#user_name').val();
		var acct = root.find('#user_acct').val();
		var pwd = hex_md5(root.find('#user_pwd').val());
		if(name=='' || acct == '' || pwd == '')
		{
			alert('信息不完整');
			return;
		}
		var group = root.find('#id').find('option:selected').val();
		var level = root.find('#level').val();
		
		$.admin.userAdd(name, acct, pwd, group, level);
		root.find('#user_name').val("");
		root.find('#user_acct').val("");
		root.find('#user_pwd').val("");
	});
	// 显示用户到列表 和权限列表

	$('.usr-manage').click(function(){
		hideAll();
		if(isSelect($(this)))
		{
			var listObj = $('.list-container');
			postionClear(main);
			main.show();
			main.addClass('left');
			
			postionClear(admin_prompt);
			admin_prompt.show();
			admin_prompt.addClass('right');
			
			postionClear(admin_user_list);
			admin_user_list.show();
			admin_user_list.addClass('middle');
			listObj.html("");
			$.admin.userGetAll(function(list){
				//alert(JSON.stringify(list));
				
				var first = true;
				var lastChar = '';
				var html = "";
				var selectObj = $('.admin-prompt #user');
				var optionHtml = "";
				
				for(var i in list)
				{
					//alert(list[i].PY);
					var char = list[i].PY;

					if(lastChar != char)
					{						
						if(first == true){
							first = false;
						}
						else
							html += '</ul>';
						
						html += '<ul class="margin-from-title">';
						html += '<div class="list-title">'+char+'</div>';
					}
					
					html += '<li attrid='+list[i].pk_id+'><p class="name">'+list[i].t_name+'</p><p class="group">'+list[i].t_groupName+'</p><p class="del_btn"></p></li>';
					lastChar = char;
					
					optionHtml += '<option value="'+list[i].pk_id+'">'+list[i].t_name+'</option>';
				}
				html += '</ul>';
				listObj.html(html);
				selectObj.html(optionHtml);
			});
		}
		else
		{
			postionClear(main);
			main.show();
			main.addClass('middle');
		}
	});
	
	$('.list-container ul li').live("click", function(){
		//alert($(this).attr('attrid'));
		$(".admin-prompt #user").val($(this).attr('attrid'));
//		$('.admin-prompt #user option').each(function(){
//			alert($(this).val());
//		});
	});
	
	$('.list-container ul li .del_btn').live("click",function(){
		var li = $(this).parent('li');
		//alert(li.attr('attrid'));
		$('.user-del-confirm .name').html(li.find('.name').html());
		$('.user-del-confirm #id').val(li.attr('attrid'));
		$.public.mask(true);
		$('.user-del-confirm').show();
	});
	
	$('.user-del-confirm .ok').click(function(){
		$.public.mask(false);
		$('.user-del-confirm').hide();
		$.admin.userDel($('.user-del-confirm #id').val() ,function(){
			$('.usr-manage').click();
		});
		
	});
	$('.user-del-confirm .cancel').click(function(){
		$.public.mask(false);
		$('.user-del-confirm').hide();
	});
	
	$('.admin-prompt .save').click(function(){
		$.admin.userUpdate($(this).parent('div').find('#user').find('option:selected').val(),
				$(this).parent('div').find('#level').find('option:selected').val());
	});
	
	$('.group-manage').click(function(){
		hideAll();
		if(isSelect($(this)))
		{
			postionClear(main);
			main.show();
			main.addClass('left');
			
			postionClear(admin_group_main);
			admin_group_main.show();
			admin_group_main.addClass('middle');
			$('.admin-group-main .btn').each(function(){
				$(this).removeClass('select');
			});
			
		}
		else
		{
			postionClear(main);
			main.show();
			main.addClass('middle');
		}
	});
	$('.admin-group-main .add, .admin-group-main .del, .admin-group-main .modify').click(function(){
		hideAll();
		if(isSelect($(this)))
		{
			postionClear(main);
			main.show();
			main.addClass('left');
			
			postionClear(admin_group_main);
			admin_group_main.show();
			admin_group_main.addClass('middle');
			if($(this).hasClass('add'))
			{
				postionClear(group_new);
				group_new.show();
				group_new.addClass('right');
			}
			else if($(this).hasClass('del'))
			{
				var select = $('.group-del #id');
				postionClear(group_del);
				group_del.show();
				group_del.addClass('right');
				select.html("");
				$.admin.groupGetAll(function(list){					
					var html = "";
					for(var i in list)
					{
						html += '<option value="'+list[i].t_pkId+'">'+list[i].t_groupName+'</option>';
					}
					select.html(html);
				});
			}
			else
			{				
				var select = $('.group-modify #gid');
				postionClear(group_modify);
				group_modify.show();
				group_modify.addClass('right');
				
				$.admin.groupGetAll(function(list){					
					var html = "";
					for(var i in list)
					{
						html += '<option value="'+list[i].t_pkId+'">'+list[i].t_groupName+'</option>';
					}
					select.html(html);
				});
			}
			
		}
	});
	
	function groupLoad()
	{
		$.admin.groupGetAll(function(list){
			
		});
	}
	
	
	
	$('.group-modify .save').click(function(){
		var parent = $(this).parent('div');
		if(parent.find('#group_name').val() =='')
		{
			alert('请填写修改名称');
			return;
		}
		$('.group-modify-confirm .old').html(parent.find('#gid').find('option:selected').html());
		$('.group-modify-confirm .new').html(parent.find('#group_name').val());
		$('.group-modify-confirm #gid').html(parent.find('#gid').find('option:selected').val());
		$.public.mask(true);
		$('.group-modify-confirm').show();
	});
	
	$('.group-modify-confirm .ok').click(function(){
		$.public.mask(false);
		$('.group-modify-confirm').hide();
		var id = $('.group-modify #gid').find('option:selected').val();
		var name = $('.group-modify #group_name').val();
		
		$.admin.groupUpdate(id, name,
			function(){
			$('.admin-group-main .modify').click();
			$('.group-modify #group_name').val("");
		});
	});
	
	$('.group-modify-confirm .cancel').click(function(){
		$.public.mask(false);
		$('.group-modify-confirm').hide();
	});
	
	$('.group-new .save').click(function(){		
		if($('.group-new #group_name').val()=='')
		{
			alert('请填写名字');
			return;
		}
		$.admin.groupAdd($('.group-new #group_name').val());
		$('.group-new #group_name').val("");
	});
	$('.group-del .save').click(function(){
		$('.group-delete-confirm').show();
		$.public.mask(true);
		$('.group-delete-confirm .old').html($(this).parent('div').find('#id').find('option:selected').html());

	});
	$('.group-delete-confirm .ok').click(function(){
		$('.group-delete-confirm').hide();
		$.public.mask(false);
		$.admin.groupDel($('.group-del .save').parent('div').find('#id').find('option:selected').val(),
				function(){
				$('.admin-group-main .del').click();
			});
	});
	$('.group-delete-confirm .cancel').click(function(){
		$('.group-delete-confirm').hide();
		$.public.mask(false);
	});
})(jQuery);
