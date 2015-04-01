// JavaScript Document
(function($) {
	$.public = {
		getDate : function(formatStr) {
			var myDate = new Date();
			var str = formatStr;
			var Week = [ '星期日', '星期一', '星期二', '星期三', '星期四', '星期五', '星期六' ];

			str = str.replace(/yyyy|YYYY/, myDate.getFullYear());
			str = str.replace(/yy|YY/, (myDate.getYear() % 100) > 9 ? (myDate
					.getYear() % 100).toString() : '0'
					+ (myDate.getYear() % 100));
			var month = myDate.getMonth() + 1;

			str = str.replace(/MM/, month > 9 ? month.toString() : '0' + month);
			str = str.replace(/M/g, month);

			str = str.replace(/w|W/g, Week[myDate.getDay()]);

			str = str.replace(/dd|DD/, myDate.getDate() > 9 ? myDate.getDate()
					.toString() : '0' + myDate.getDate());
			str = str.replace(/d|D/g, myDate.getDate());

			str = str.replace(/hh|HH/, myDate.getHours() > 9 ? myDate
					.getHours().toString() : '0' + myDate.getHours());
			str = str.replace(/h|H/g, myDate.getHours());
			str = str.replace(/mm/, myDate.getMinutes() > 9 ? myDate
					.getMinutes().toString() : '0' + myDate.getMinutes());
			str = str.replace(/m/g, myDate.getMinutes());

			str = str.replace(/ss|SS/, myDate.getSeconds() > 9 ? myDate
					.getSeconds().toString() : '0' + myDate.getSeconds());
			str = str.replace(/s|S/g, myDate.getSeconds());

			return str;
		},
		getUser : function(func) {
			$.ajax({
				url : '/action/getInfoAction.php',
				type : 'post',
				data : 0,//form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					//window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					//alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						func(json['msg']);
						break;
					default:
						func(json['msg']);
						break;
					}
				}
			});
			return false;
		},
		auth : function() {
			$.ajax({
				url : '/action/authTest.php',
				type : 'post',
				data : 0,//form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					//window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					//alert(JSON.stringify(json));
					switch (json['status']) {
					case 0:
						break;
					default:
						//alert(json['msg']);
						window.location.href = '/login.html';
						break;
					}
				}
			});
			return false;
		},
		showTest : function(id) {
			$.ajax({
				url : '/action/showTest.php',
				type : 'post',
				data : 0,//form.serialize(),
				cache : false,
				dataType : "json",
				error : function(XMLHttpRequest, textStatus, errorThrown) {
					alert("服务器无响应! status: " + textStatus);
					//window.location.href = '/login.html';
				},
				success : function(json, textStatus) {
					//alert(JSON.stringify(json));
					switch (json['status']) {
					case 14:
						//alert(json['data']);
						window.location.href = json['data'] + '?id=' + id;
						break;
					default:
						break;
					}
				}
			});
			return false;
		},
		get : function(name) {
			var aQuery = window.location.href.split("?");//取得Get参数
			//alert(aQuery);
			//var aGET = new Array();
			if (aQuery.length > 1) {
				var aBuf = aQuery[1].split("&");
				for (var i = 0, iLoop = aBuf.length; i < iLoop; i++) {
					var aTmp = aBuf[i].split("=");//分离key与Value
					if (name == aTmp[0])
						return aTmp[1];
					//aGET[aTmp[0]] = aTmp[1];
				}
			}
			return null;
			//return aGET;
		},
		mask : function(flag) {
			if (flag == true) {
				$('.mask').show();
			} else {
				$('.mask').hide();
			}
		},
		tip : function(flag, text, left ,top) {
			var obj = $('.tip-info');
			if(flag == true){				
				obj.html(text);
				obj.css('left', left);
				obj.css('top', top);
				obj.show()
			}
			else
				obj.hide();
		}
	};
	function editPrepare() {
		$('.edit').each(function() {
			$(this).attr('contentEditable', 'true');
		});
	};
	function dataInit() {
		$('.np-year').each(function() {
			var yearStart = 1980;
			var date = new Date();
			var yearEnd = date.getFullYear();
			var html = '<option opid=0>年份</option>'
			for (var i = yearEnd; i >= yearStart; i--) {
				html += '<option opid=' + i + '>' + i + '年</option>'
			}
			$(this).html(html);
		});
		$('.np-month').each(function() {
			var html = '<option opid=0>月份</option>'
			for (var i = 1; i <= 12; i++) {
				html += '<option opid=' + i + '>' + i + '月</option>'
			}
			$(this).html(html);
		});
		$('.np-day').each(function() {
			var html = '<option opid=0>日</option>'
			for (var i = 1; i <= 31; i++) {
				html += '<option opid=' + i + '>' + i + '号</option>'
			}
			$(this).html(html);
		});
	}
	
	$('.change').click(function(){
		$.public.mask(true);
		$('.pwd-change').show();
	});
	$('.pc-ok').click(function(){
		if($('#change-pwd').val()=="")
		{
			alert("请填写新密码");
			$.public.mask(false);
			$('.pwd-change').hide();
			return;
		}
		$.admin.userPwdChange(hex_md5($('#change-pwd').val()), function(){
			$('#change-pwd').val("");
			$.public.mask(false);
			$('.pwd-change').hide();
		});
		
	});
	$('.pc-cancel').click(function(){
		$.public.mask(false);
		$('.pwd-change').hide();
	});
	$.public.auth();
	editPrepare();
	dataInit();
	$('.date').html($.public.getDate("YYYY/MM/DD W"));

	function infoSet(json) {
		$('.user').html('欢迎您,' + json['t_name']);
	}
	$.public.getUser(infoSet);

})(jQuery);
