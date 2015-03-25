<?php include_once '/frwk/inculde.php'; ?>
<?php

echo $userSessionObj->t_name;
$entity = new User ();

?>
<html>
<head>
<title>Admin</title>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
</head>

<script src="/assets/js/jquery-1.8.1.min.js"></script>
<script src="/assets/js/handsontable.full.js"></script>
<script src="/assets/js/a.js"></script>
<link rel="stylesheet" media="screen"
	href="/assets/css/handsontable.full.css">
<link rel="stylesheet" media="screen" href="/assets/css/b.css">
</head>
<style type="text/css">
.negative {
	color: red;
}

.warp {
	WORD-WRAP: break-word;
}
</style>
<script type="text/javascript">
$(document).ready(function () {
	$('#show').click(function(){
		alert(JSON.stringify({"data": hot2.getData()})); //returns all cells' data
	});
	$('#addcol').click(function(){
		hot2.alter('insert_col',1);
	});
	$('#delcol').click(function(){
		hot2.alter('remove_col',1);
	});
	$('#addrow').click(function(){
		hot2.alter('insert_row',null);
	});
   var fixCol = new Array('项目',"责任科室",'责任人', "完成情况");
   var readOnlyRow = new Array('责任人','责任科室');
   var selectUnit;
   var selectUser;
   function textWarp(instance, td, row, col, prop, value, cellProperties) {
	  Handsontable.renderers.TextRenderer.apply(this, arguments);
	  td.className = 'warp'; //add class "negative"
	  var meta = instance.getCellMeta(row, col);
	    if (meta.readOnly)
	    {
	    	 td.className += ' negative';
  		}
  }
   
   $('.add-user ul li .addBtn').live("click",function(){
	   //alert("del");
	var obj = $('.add-user ul').eq(-2).html();
	});

   $('.add-user ul li .delBtn').live("click",function(){
	   //alert("del");
	$(this).parent("li").parent("ul").remove();
	});
   function showChoiceDiv(row, units, users)
   {
	   var div = $('.add-user');
	   $.public.mask(true);
	   
	   var html = '<ul class="title">'+
					'<li>责任科室1</li>' +
					'<li>责任人</li>' +
					'<li>操作</li>'+
					'</ul>';
       var unitstrs= new Array(); //定义一数组
       unitstrs=units.split("\n"); //字符分割
       var userstrs = new Array();
       userstrs = users.split("\n");
       for (i=0;i<unitstrs.length ;i++ )
 	   {

     		  html += '<ul>';

           html += '<li>'+unitstrs[i]+'</li>';
           html += '<li>'+userstrs[i]+'</li>';
			html +='<li><a class="delBtn" href="javascript:;">删除</a></li>';
	     	   html += '</ul>';
 	   } 


   	html += "<ul><li><select><option>1</option><option>2</option></select></li>";
   	html += "<li><select><option>3</option><option>4</option></select></li>";
	html += '<li><a class="addBtn" href="javascript:return;">添加</a></li></ul>';
       div.html(html);					
	   div.show();
   }
  function setSelect(row){
	  //alert("row:"+row);
		var head = hot2.getData()[0];
		var data = hot2.getData()[row];
		var unitCol;
		var personCol;
		for(var i in head)
		  {
			  if(head[i] == '责任人')
				  personCol = i;
			  if(head[i] == '责任科室')
				  unitCol = i;
		  }
		selectUnit = data[unitCol];
		selectUser = data[personCol];
		showChoiceDiv(row,data[unitCol],data[personCol]);
		  //alert(personCol+":"+data[personCol]+"--"+unitCol+":"+data[unitCol]);
	//var colUnit;
  }
  function fixColCheck(name){
	  //alert(name);
	  for(var i in fixCol)
	  {
		  if(name == fixCol[i]){
			  return true;
		  }
	  }
	  
	  return false;
  }
  
  function readOnlyColCheck(name){
	  //alert(name);
	  for(var i in readOnlyRow)
	  {
		  if(name == readOnlyRow[i]){
			  return true;
		  }
	  }
  }
  $('#test').click(function(){
	  var strs= new Array(); //定义一数组
	  strs=hot2.getDataAtCell(1,1).split("\n"); //字符分割
	  for (i=0;i<strs.length ;i++ )
	  {
	  	alert(strs[i]); //分割后的字符输出
	  } 
	});
	 
  $('#noheader').click(function(){
	  //hot2.destroy ();
	  hot = new Handsontable(example,{
		    data: hot2.getData(),

		    colWidths: [80, 100, 100,100],
		    manualColumnResize: true,
		    manualRowResize: true,
		    cells: function (row, col, prop) {
		    	    var cellProperties = {};    	
		    	    if (row === 0 ) {
		        	    if(fixColCheck(this.instance.getData()[row][col]) == true ){
		    	        	cellProperties.readOnly = true; //make cell read-only if it is first row or the text reads 'readOnly'
		        	    }
		        	    else
		        	    	cellProperties.readOnly = false;
		    	    }

		    	    if(readOnlyColCheck(this.instance.getData()[0][col]) == true)
		  	      		cellProperties.readOnly = true; //make cell read-only if it is first row or the text reads 'readOnly'
		  	      		
		    	    cellProperties.renderer = textWarp; //uses lookup map    	    
		    	    return cellProperties;
		    },
			beforeRemoveCol:function (index, amount)
			{
				var name = this.getData()[0][index];
				if(fixColCheck(name) == true)
				{
					alert("固定列不允许删除");
					return false;
				}

			},
	  });
	  hot2.destroy();
	  //hot2 =hot;
  });
  function getCarData() {
    return [
    ["项目", "责任科室", "责任人", "完成情况"],
    ["2009", '科室1\n科室2\n科室3', '员工1\n员工2\n员工3', 14],
    ["2010", '科室1\n科室2\n科室3\n科室5', '员工1\n员工2\n员工3\n员工35', 12]
    ];
  }
  var example2 = document.getElementById('example2');
  var hot2 = new Handsontable(example2,{
    data: getCarData(),

    colWidths: [80, 100, 100,100],
    manualColumnResize: true,
    manualRowResize: true,
//    contextMenu: true,
//     contextMenu: {
//     	callback:function(key, options){
//     		if(key=== 'addrow_blow')	
//     		{
//     			//var row = this.getSelected()[0];
//     			//$('#addrow').click();
//     			//setTimeout(function () { 
//         			//this.alter('insert_row',row + 1); 
//         			//}, 1000);
//     		}
//     		else if (key === 'addrow_above')
//     		{
//     			//var row = this.getSelected()[0];
//     			//$('#addrow').click();
//     			//setTimeout(function () { 
//     			//this.alter('insert_row',row ); 
//     			//}, 1000);
//         	}
//     		//this.deselectCell();
//     	},
//     	items:{
//     		"addrow_blow":{name: '下面添加行'},
//     		"addrow_above":{name: '上面添加行',
//     			 disabled: function () {
//        	          //if first row, disable this option
//        	          //return (this.getSelected()[0]===0)
//        	        }
//    	        },
//     	}
//     },
    contextMenu: {
    	callback:function(key, options){
    		if(key=== 'set_user')	
    		{
    			setSelect(this.getSelected()[0]);
    		}

    	},
    	items:{
    		"set_user":{name: '设置责任人'},
    	}
    },
     rowHeaders: true,
    colHeaders: true,
    cells: function (row, col, prop) {
    	    var cellProperties = {};    	
    	    if (row === 0 ) {
        	    if(fixColCheck(this.instance.getData()[row][col]) == true ){
    	        	cellProperties.readOnly = true; //make cell read-only if it is first row or the text reads 'readOnly'
        	    }
        	    else
        	    	cellProperties.readOnly = false;
    	    }

    	    if(readOnlyColCheck(this.instance.getData()[0][col]) == true)
  	      		cellProperties.readOnly = true; //make cell read-only if it is first row or the text reads 'readOnly'
  	      		
    	    cellProperties.renderer = textWarp; //uses lookup map    	    
    	    return cellProperties;
    },
	beforeRemoveCol:function (index, amount)
	{
		var name = this.getData()[0][index];
		if(fixColCheck(name) == true)
		{
			alert("固定列不允许删除");
			return false;
		}

	},
  });
  

});
</script>
<body>
	this is index
	<a href="logout.php">登出</a>

	<div class="handsontable" id="example2"></div>
	<div class="handsontable" id="example"></div>
	<input id="add" type="button" value="提交">
	<input id="show" type="button" value="查看">
	<input id="addcol" type="button" value="添加列">
	<input id="delcol" type="button" value="删除第二列">
	<input id="addrow" type="button" value="添加行">
	<input id="test" type="button" value="test">
	<!-- 	<input id="noheader" type="button" value="不要头"> -->
	<div class="add-user">
		<ul class="title">
			<li>责任科室</li>
			<li>责任人</li>
			<li>操作</li>
		</ul>
		<ul>
			<li><select>
					<option>1</option>
			</select></li>
			<li><select>
					<option>1</option>
			</select></li>
			<li><a class="addBtn" href="javascript:void(0);">添加</a></li>
		</ul>
	</div>
	<div id="mask" class="mask" style="display: none;">
		<iframe frameborder="0" src="about:blank"
			style="filter: progid:DXImageTransform.Microsoft.Alpha(opacity:0); position: absolute; top: 0px; left: 0px; width: 100%; height: 100%;"></iframe>
	</div>
</body>
</html>