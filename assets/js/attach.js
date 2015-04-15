/**
 * 
 */
(function($) {
	var attch_id = 1;
	function getType(name)
	{
		var filename=name;  
		var index1=filename.lastIndexOf(".");  
		var index2=filename.length;
		var postf=filename.substring(index1,index2);//后缀名  
		switch(postf)
		{
			case '.doc':
				return 'doc';
			break;
			case '.jpg':
			case '.png':
			case '.gif':
			case '.bmp':
				return 'pic';
			break;
			case '.rar':
			case '.zip':
			case '.tar':
				return 'rar';			
			break;
		}
		return 'unkown';
	};
	$.attach = {
		attachAreaClear : function() {
			$('.attach .a-info ul:first-child').html("");
			attch_id = 1;
		},
		delAttach : function(id,func) {
			var data = 'act=delAttach&id=' + id;
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

					switch (json['status']) {
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
		getAllAttach : function(id,func) {
			var data = 'act=getAllAttach&id=' + id;
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

					switch (json['status']) {
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
		getAttach : function(id,pjname,func) {
			var data = 'act=getAttach&pjname='+pjname+'&id=' + id;
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

					switch (json['status']) {
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
		
		reload : function(data)
		{
			var html = "";
			for(var i in data)
			{
				html += '<li atid='+data[i].t_pkId+' class="'+getType(data[i].name)+'" owner="'+data[i].fk_user+'">';
				html += '<p>'+data[i].name+'</p>';
				//html += '<a href="action/down.php?id='+data[i].t_pkId+'">下载</a>';
				html += '<a href="'+data[i].url+'">下载</a>';
				html += '<div class="cross"></div></li>';				
				//alert(data[i].url);
			}
			//alert(html);			
			$('.attach-bar ul').html(html);
		}
	};
	$('#attach').click(function() {
		$('.attach').show();
		$.public.mask(true);
	});

	$('.attach .a-add')
			.click(
					function() {
						var id = "fileToUpload" + attch_id;
						var html = "";
						html += ('<li><div class="file-box">'
								+ '<input type="text" name="textfield" id="textfield" class="txt" />'
								+ '<input type="button" class="btn" value="..." /> '
								+ ' <input type="file" name="' + id
								+ '" size="45" class="file" id="' + id + '" />' + '</div></li>');
						$(this).parent('ul').prev().append(html);
						attch_id++;
					});
	$('.file').live("change", function() {
		$(this).parent('div').find('.txt').val($(this).val());
	});

})(jQuery);