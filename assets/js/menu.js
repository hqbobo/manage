// JavaScript Document
(function($) {
	var del_func = false;
	var edit_func = false;
	var click_func = false;
	$('.del_btn').live("click",function(){
		if(del_func != false)
			del_func($(this).parent('li'));
	});
	
	$('.edit_btn').live("click",function(){
		if(edit_func != false)
			edit_func($(this).parent('li'));
	});
	function SetString(str, len) {
		var strlen = 0;
		var s = "";
		for (var i = 0; i < str.length; i++) {
			if (str.charCodeAt(i) > 128) {
				strlen += 2;
			} else {
				strlen++;
			}
			s += str.charAt(i);
			if (strlen >= len) {
				return s+'...';
			}
		}
		return s;
	};
	function menuParse(jsons,menudiv)
	{
		
		var html = '<ul>';
		//alert(JSON.stringify(jsons));
		for(var i in jsons)
		{
			//alert(JSON.stringify(jsons[i].data));
			html += '<li class="item-list" year="'+jsons[i].t_year+'">'; 
			html += '<p class="np-list-name">'+jsons[i].t_year+'年项目目标</p>';
			html += '<div class="submenu"><ul>';
			for(var j in jsons[i].data)
			{
				
				html += '<li attrid='+jsons[i].data[j].t_pkid+
					'><p class="tt" data="'+jsons[i].data[j].t_projectName+'">'+jsons[i].data[j].t_month
					+'.'+jsons[i].data[j].t_day+' '+SetString(jsons[i].data[j].t_projectName, 18)+'</p>';
				html+='<p class="del_btn"><p class="edit_btn"></p><div class="select"></div></li>';
			}
			html += '</ul></div>';
			html += '</li>';
		}
		html +='</ul>';
		//alert(html);
		menudiv.html(html);
	};
	
	$.menu = {
		bind:function(d_func, e_func, c_func){
			del_func = d_func;
			edit_func = e_func;
			click_func = c_func;
		},
		strCut:function(charAllow)   
		{   			
			  $('.submenu ul li p').each(function(){
				  	$(this).html((SetString($(this).html(), charAllow)+'...'));
			  });
			  
		},
		select: function(id)
		{
			$('.submenu ul li p').each(function(){
			  	$(this).html((SetString($(this).html(), charAllow)+'...'));
		  });
		},
		menuInit:function(menudiv, selectid,selectfunc,finishfunc)
		{
			var jsonData=false;
			var data='act=getAll';
			 $.ajax({
		            url : '/action/projectAction.php',
		            type : 'post',
		            data : 0,//form.serialize(),
		            cache : false,
		            dataType : "json",
		            error : function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("服务器无响应! status: " + textStatus);
		                //window.location.href = '/login.html';
		             },
		            success : function(json, textStatus) {

		                switch(json['status']){
		                    case 0:
		                    	menuParse(json.data,menudiv);
		                    	$('.submenu ul li').each(function(){
		                    		if(selectid  == $(this).attr('attrid'))
		                    		{
		                    			selectfunc($(this));
		                    		}
		            			});
		                    	if(finishfunc!= null) finishfunc();
		                        break;
		                    default:
		                    	alert(json['msg']);
		                        break;
		                }
		            }
		        });
		}
	};
	$('.submenu ul li .tt').live("click", function(){
		if(click_func != false)
		{
			click_func($(this).parent('li'));
		}
	});
	
	$('.item-list .np-list-name').live('click',function(){
		var obj = $(this).parent('li');
		if(obj.hasClass('selected'))
		{
			obj.removeClass('selected');
		}
		else
		{
			obj.addClass('selected');
		}
		obj.find('.submenu').fadeToggle();
	});
	

	
	
	$('.new-project-btn').click(function(){
		$.public.mask(true);
		$('.new-project').show();
		//$.public.mask(false);
	});
	
	$('.np-cancel').click(function(){
		$('.new-project').hide();
		$.public.mask(false);
	});
	function addCheck()
	{
		if($('.new-project .np-name').val().length == 0)
		{
			alert('需要填写项目名称');
			$('.np-name').focus();
			return false;
		}
		if($('.new-project .np-year option:selected').attr('opid') == 0)
		{
			alert('需要选择年份');
			$('.np-year').focus();
			return false;
		}
		if($('.new-project .np-month option:selected').attr('opid') == 0)
		{
			alert('需要选择月份');
			$('.np-month').focus();
			return false;
		}
		if($('.new-project .np-day option:selected').attr('opid') == 0)
		{
			alert('需要选择日期');
			$('.np-day').focus();
			return false;
		}
		return true;
	}
	$('.np-ok').click(function(){
		if(!addCheck())
			return;
		var data='act=add'+'&pjname='+$('.new-project .np-name').val()+'&year='+$('.new-project .np-year option:selected').attr('opid')
		+'&month='+$('.new-project .np-month option:selected').attr('opid')+'&day='+$('.new-project .np-day option:selected').attr('opid');

		 $.ajax({
	            url : '/action/projectAction.php',
	            type : 'post',
	            data : data,//form.serialize(),
	            cache : false,
	            dataType : "json",
	            error : function(XMLHttpRequest, textStatus, errorThrown) {
	                alert("添加服务器无响应! status: " + textStatus);
	                //window.location.href = '/login.html';
	                $('.new-project').hide();
	        		$.public.mask(false);
	             },
	            success : function(json, textStatus) {

	                switch(json['status']){
	                    case 0:	                    	
	                    	alert(json['msg']);
	                    	window.location.reload();
	                        break;
	                    default:
	                    	alert(json['msg']);
	                        break;
	                }
	                //$.menu.menuInit($('.show-project'));
	                //$('.new-project').hide();
	        		//$.public.mask(false);
	            }
	        });

	});
	$('.dp-ok').click(function(){
		var data="act=del&id="+$('.dp-info').attr('attrid');

		$.ajax({
            url : '/action/projectAction.php',
            type : 'post',
            data : data,//form.serialize(),
            cache : false,
            dataType : "json",
            error : function(XMLHttpRequest, textStatus, errorThrown) {
                alert("服务器无响应! status: " + textStatus);
                //window.location.href = '/login.html';
                $('.del-project').hide();
        		$.public.mask(false);
             },
            success : function(json, textStatus) {

                switch(json['status']){
                    case 0:	                    	
                    	//alert(json['msg']);
                    	window.location.href = '/';
                        break;
                    default:
                    	alert(json['msg']);
                        break;
                }
            }
        });
	});
	$('.dp-cancel').click(function(){
		$('.del-project').hide();
		$.public.mask(false);
	});

	
})(jQuery);
