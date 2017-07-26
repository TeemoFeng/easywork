<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">var id=0; var pid=0;
$(function(){
	var th = $(".top").height();
	th = 111-th
	var wh = $(window).height()-th;
	whs = (wh-39);
	var pr = '<?php echo $page_row ?>';
	var pn = false;
	if(pr>0){
		pn = true;
	}

	$("#filesIndexList<?php echo ($uniqid); ?>").datagrid({	
		height:whs,
		autoRowHeight:true,
		singleSelect:true,
		striped:true,
		pagination:pn,
		//rownumbers:true,
		pagination:true,
		pageSize:50,
		pageList:[30,50,80,100,1000],
		method:'get',
		sortName:'addtime',
		sortOrder:'desc',
		url:'__URL__/fileslist/type/<?php echo ($type); ?>/json/1',
		fitColumns:true,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		selectOnCheck:false,
		checkOnSelect:true,
		onBeforeLoad: function () {  
			 if($("#filesIndexListCon<?php echo ($uniqid); ?> .datagrid-toolbar table tr #sersSearchFiles<?php echo ($uniqid); ?>").length==0){
				 var grid = $("#filesIndexListCon<?php echo ($uniqid); ?> .datagrid-toolbar table tr");  
				 var date = '<td>'+$("#selectInputFiles<?php echo ($uniqid); ?>").html()+'</td>';    
				 grid.prepend(date);
			 }
		},
		onDblClickRow:function(e,rowIndex,rowData){
			var se = $("#filesIndexList<?php echo ($uniqid); ?>").datagrid('getSelected')
			//var se = $("#filesIndexList<?php echo ($uniqid); ?>").datagrid('getChecked');
			//var se_len = se.length;
			id = se['id'];
			pid = se['pro_id'];
			type = se['type'];
			//alert(pid);
			if(type==1){
				getDetailFiles(id);
			}else{
				$.post('__URL__/enter',{pro_id:pid},function(data){
					$("#filesIndexList<?php echo ($uniqid); ?>").datagrid('reload');
				});
			}
		},
		onUncheck:function(i,d){
			$("#filesIndexList<?php echo ($uniqid); ?>").datagrid('unselectRow',i);
		},
		toolbar:[{
			iconCls: 'icon-reload',
			text : '重载',
			handler: function(){
				$.get('__URL__/clear', function(data){
					$("#sersSearchFiles<?php echo ($uniqid); ?>").val('');
					$("#filesIndexList<?php echo ($uniqid); ?>").datagrid('reload');
				});
			}
		},'-',{
			iconCls: 'icon-file',
			text : '新建文档',
			handler: function(){
				var isform = $(".add-file").length;
				if(!isform && pid){
					$("<div/>").dialog({
						title:'新建文档',
						resizable:true,
						width:850,
						height:465,
						href:'__GROUP__/project/file/act/add/id/'+pid,
						onOpen:function(){
							cancel['FileAdd'] = $(this);
							cancel['FilesUniqid'] = '<?php echo ($uniqid); ?>';
						},
						onClose:function(){
							cancel['FileAdd'].dialog('destroy');
							cancel['FireAdd'] = null;
							cancel['FilesUniqid'] = null;
						}
					});
				}
			}
		}],
		columns:[[ 
			{field:'title',title:'文档',width:320},
			{field:'username',title:'由谁更新',width:60},
			{field:'addtime',title:'最后更新时间',width:120},
			{field:'action',title:'',width:80,align:'center'}
		]]
	});
	
	$("#rightTabs").tabs({
		onClose:function(t,i){
			$.ajaxSetup({  
				async : false  
			});
			if(t=='文档列表'){
				$.get('__URL__/clear', function(data){});
			}
			$.ajaxSetup({  
				async : true  
			});
		}
	});
	
	$("#rightTabs").tabs('select','文档列表');
});

function toFilesSearch(idd){
	$.messager.progress();
	var tit = $("#sersSearchFiles<?php echo ($uniqid); ?>").val();
	$.post('__URL__/search',{title:tit},function(data){
		$("#filesIndexList<?php echo ($uniqid); ?>").datagrid('reload');
	});
	$.messager.progress('close');
}

function toEditFiles(idd){
	var isform = $(".add-file").length;
	if(!isform){
		$("<div/>").dialog({
			title:'编辑文档',
			resizable:true,
			width:850,
			height:465,
			href:'__GROUP__/project/file/act/edit/id/'+idd,
			onOpen:function(){
				cancel['FileAdd'] = $(this);
				cancel['FilesUniqid'] = '<?php echo ($uniqid); ?>';
			},
			onClose:function(){
				cancel['FileAdd'].dialog('destroy');
				cancel['FireAdd'] = null;
				cancel['FilesUniqid'] = null;
			}
		});
	}
}

function toDelFiles(idd){
	$.messager.confirm('提示','确定删除该文档吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.get('__GROUP__/project/file/act/del/go/1/id/'+idd, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除文档成功！','info',function(){
						$("#filesIndexList<?php echo ($uniqid); ?>").datagrid('reload');
					});
				}else if(data==0){
					$.messager.alert('提示','删除文档失败！','warning');
				}else{
					$.messager.alert('提示','您沒有刪除的權限！','warning');
				}
			});
		}
	});
}

function getDetailFiles(id){
	var isform = $(".add-filesdetail").length;
	if(!isform){
		$("<div/>").dialog({
			title:'文档详情',
			resizable:true,
			width:850,
			height:500,
			href:'__URL__/detail/id/'+id,
			onOpen:function(){
				cancel['FileDetail'] = $(this);
			},
			onClose:function(){
				cancel['FileDetail'].dialog('destroy');
				cancel['FileDetail'] = null;
			}
		});
	}
}

function onExcel(id){
	window.location = "__URL__/word/id/"+id;
}
</script><div class="con" id="filesIndexListCon<?php echo ($uniqid); ?>" onselectstart="return false;" style="-moz-user-select:none;"><form id="searchForm<?php echo ($uniqid); ?>"><table id="filesIndexList<?php echo ($uniqid); ?>"></table></form></div><div id="selectInputFiles<?php echo ($uniqid); ?>" style="display:none"><span style="margin-right:3px;"></span> 文档搜索：<input id="sersSearchFiles<?php echo ($uniqid); ?>" style="width:220px;" name="title" AUTOCOMPLETE="off" /><a href="javascript:void(0);" onclick="javascript:toFilesSearch('<?php echo ($uniqid); ?>')" class="searchBtn"></a><span class="datagrid-btn-separator-nofloat" style="margin-right:2px;"></span></div>