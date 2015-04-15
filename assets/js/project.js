(function($) {
	$.project = {
		get:function(id,func)
		{
			var data='act=get&id='+id;
			 $.ajax({
		            url : '/action/projectAction.php',
		            type : 'post',
		            data : data,//form.serialize(),
		            cache : false,
		            dataType : "json",
		            asyn:false,
		            error : function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("服务器无响应! status: " + textStatus);
		                //window.location.href = '/login.html';
		             },
		            success : function(json, textStatus) {

		                switch(json['status']){
		                    case 0:
		                    	//alert(JSON.stringify(json['data']));
		                    	func(json['data']);
		                        break;
		                    default:
		                    	alert(json['msg']);
		                        break;
		                }
		            }
		        });
		},
		savetbl:function(id,json)
		{
			var data='act=savetbl&id='+id+'&tbl='+json;
			 $.ajax({
		            url : '/action/projectAction.php',
		            type : 'post',
		            data : data,//form.serialize(),
		            cache : false,
		            dataType : "json",
		            error : function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("服务器无响应! status: " + textStatus);
		                //window.location.href = '/login.html';
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
		            }
		        });
		},
		changeTitle:function(id,title)
		{
			var data='act=changeTitle&id='+id+'&title='+title;
			 $.ajax({
		            url : '/action/projectAction.php',
		            type : 'post',
		            data : data,//form.serialize(),
		            cache : false,
		            dataType : "json",
		            error : function(XMLHttpRequest, textStatus, errorThrown) {
		                alert("服务器无响应! status: " + textStatus);
		                //window.location.href = '/login.html';
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
		            }
		        });
		}
		
	};
})(jQuery);
