<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">swfobject.embedSWF(
"__JS__/chart/open-flash-chart.swf", "worklog_chart",
"550", "300", "9.0.0", "expressInstall.swf",
{"data-file":"__URL__/worklogpie/id/<?php echo $id; ?>"},{wmode: "opaque"} );

$(function(){
	$("#taskList").datagrid({	
		height:280,
		autoRowHeight:true,
		singleSelect:true,
		striped:true,
		rownumbers:true,
		pagination:true,
		pageSize:8,
		pageList:[8,30,50],
		method:'get',
		sortName:'t1_old_uptime',
		sortOrder:'desc',
		url:'__URL__/tasklist/pid/<?php echo ($id); ?>/json/1',
		fitColumns:false,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		selectOnCheck:false,
		checkOnSelect:true,
		onDblClickRow:function(e,rowIndex,rowData){
			/*var se = $("#taskList").datagrid('getChecked');
			var se_len = se.length;
			var idd = se[0]['id'];
			var pidd = $("#ids<?php echo ($uniqid); ?>").val();
			$("#proDetailCon").panel('refresh','__URL__/content/id/'+pidd+'/tid/'+idd);*/
		},
		onUncheck:function(i,d){
			$("#taskList").datagrid('unselectRow',i);
		},
		toolbar:[{
			iconCls: 'icon-excel',
			text : '导出EXCEL',
			handler: function(){				
				window.location = "__URL__/tasklist/pid/<?php echo ($id); ?>/json/1/method/excel";
			}
		}],
		frozenColumns:[[
			{field:'t1_old_title',title:'任务名称',width:248,sortable:true,rowspan:2},
		]],
		columns:[[ 
			{field:'t2_old_username',title:'指派给',width:75,sortable:true,rowspan:2},
			{field:'t4_old_fromname',title:'来自',width:65,sortable:true,rowspan:2},
			{field:'t1_new_status',title:'任务状态',width:110,sortable:true,rowspan:2},
			{field:'t1_new_level',title:'优先级',width:70,sortable:true,rowspan:2},
			{field:'t1_new_degree',title:'严重程度',width:70,sortable:true,rowspan:2},
			{field:'t1_old_startdate',title:'计划开始',width:100,sortable:true,rowspan:2},
			{field:'t1_old_enddate',title:'计划完成',width:100,sortable:true,rowspan:2},
			{field:'t1_old_pass',title:'任务进度',width:110,sortable:true,rowspan:2},
			{field:'t1_old_plantime',title:'计划用时',width:70,rowspan:2},
			{field:'t1_new_realtime',title:'已用工时',width:70,rowspan:2},
			{field:'t1_old_uptime',title:'更新时间',width:155,sortable:true,rowspan:2},
			{title:'<?php echo $week[8]; ?>',width:700,colspan:7,align:'center',resizable:false}
		],[
			{field:'w1',title:'<?php echo $week[1]; ?>',width:100,align:'center',resizable:false},
			{field:'w2',title:'<?php echo $week[2]; ?>',width:100,align:'center',resizable:false},
			{field:'w3',title:'<?php echo $week[3]; ?>',width:100,align:'center',resizable:false},
			{field:'w4',title:'<?php echo $week[4]; ?>',width:100,align:'center',resizable:false},
			{field:'w5',title:'<?php echo $week[5]; ?>',width:100,align:'center',resizable:false},
			{field:'w6',title:'<?php echo $week[6]; ?>',width:100,align:'center',resizable:false},
			{field:'w7',title:'<?php echo $week[7]; ?>',width:100,align:'center',resizable:false}
		]]
	});
	
	$("#filesList").datagrid({	
		height:280,
		autoRowHeight:true,
		singleSelect:true,
		striped:true,
		rownumbers:true,
		pagination:true,
		pageSize:9,
		pageList:[9,30,50],
		method:'get',
		sortName:'addtime',
		sortOrder:'desc',
		url:'__GROUP__/Files/fileslist/pid/<?php echo ($id); ?>/json/1',
		fitColumns:true,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		selectOnCheck:false,
		checkOnSelect:true,
		onDblClickRow:function(e,rowIndex,rowData){
			var se = $("#filesList").datagrid('getSelected');
			id = se['id'];
			pid = se['pro_id'];
			tid = se['task_id'];
			paid = se['_parentId'];
			var type = se['type'];
			//alert(id);
			if(type==1){
				getDetailFiles(id);
			}else{
				$.post('__GROUP__/files/enter',{id:id, pro_id:pid, task_id:tid, parent_id:paid},function(data){
					$("#filesList").datagrid('reload');
				});
			}
		},
		onUncheck:function(i,d){
			$("#filesList").datagrid('unselectRow',i);
		},
		columns:[[ 
			{field:'title',title:'文档',width:380},
			{field:'username',title:'由谁更新',width:65},
			{field:'addtime',title:'最后更新时间',width:160},
			{field:'action',title:'操作',width:155,align:'center'}
		]]
	});
	
	$("#logList").datagrid({	
		height:280,
		autoRowHeight:true,
		singleSelect:true,
		striped:true,
		rownumbers:true,
		pagination:true,
		pageSize:9,
		pageList:[9,30,50],
		method:'get',
		sortName:'addtime',
		sortOrder:'desc',
		url:'__GROUP__/Log/index/pid/<?php echo ($id); ?>/json/1',
		fitColumns:true,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		selectOnCheck:false,
		checkOnSelect:true,
		onDblClickRow:function(e,rowIndex,rowData){
			var se = $(this).datagrid('getSelected');
			var idd = se['id'];
			getDetailLog(idd);
		},
		toolbar:[{
			iconCls: 'icon-excel',
			text : '导出EXCEL',
			handler: function(){				
				window.location = "__GROUP__/Log/index/pid/<?php echo ($id); ?>/json/1/method/excel";
			}
		}],
		columns:[[   
			{field:'title',title:'动态',width:480},
			{field:'usages',title:'耗时',width:70},   
			{field:'status',title:'状态',width:110},
			{field:'addtime',title:'更新于',width:160}
		]]
	});
	
	$("#workToLast").click(function(){
		$.get('__URL__/chgweek/act/1', function(data){
			$("#taskList").datagrid('reload');
			$.getJSON('__URL__/tasklist/pid/<?php echo ($id); ?>/json/1/method/week',function(data){
				$("#taskList").datagrid("setColumnTitle",{field:'w1',text:data[1]});
				$("#taskList").datagrid("setColumnTitle",{field:'w2',text:data[2]});
				$("#taskList").datagrid("setColumnTitle",{field:'w3',text:data[3]});
				$("#taskList").datagrid("setColumnTitle",{field:'w4',text:data[4]});
				$("#taskList").datagrid("setColumnTitle",{field:'w5',text:data[5]});
				$("#taskList").datagrid("setColumnTitle",{field:'w6',text:data[6]});
				$("#taskList").datagrid("setColumnTitle",{field:'w7',text:data[7]});
				$("#midWeek").html(data[9]);
			});
		});
	});
	
	$("#workToNext").click(function(){
		$.get('__URL__/chgweek/act/2', function(data){
			$("#taskList").datagrid('reload');
			$.getJSON('__URL__/tasklist/pid/<?php echo ($id); ?>/json/1/method/week',function(data){
				$("#taskList").datagrid("setColumnTitle",{field:'w1',text:data[1]});
				$("#taskList").datagrid("setColumnTitle",{field:'w2',text:data[2]});
				$("#taskList").datagrid("setColumnTitle",{field:'w3',text:data[3]});
				$("#taskList").datagrid("setColumnTitle",{field:'w4',text:data[4]});
				$("#taskList").datagrid("setColumnTitle",{field:'w5',text:data[5]});
				$("#taskList").datagrid("setColumnTitle",{field:'w6',text:data[6]});
				$("#taskList").datagrid("setColumnTitle",{field:'w7',text:data[7]});
				$("#midWeek").html(data[9]);
			});
		});
	});
});

function onAddReply(idd){
	var ids = $("#ids"+idd).val();
	var isform = $(".add-reply").length;
	if(!isform){
		$("<div/>").dialog({
			title:'发表评论',
			resizable:true,
			width:850,
			height:375,
			href:'__URL__/reply/act/add/id/'+ids,
			onOpen:function(){
				cancel['ReplyAdd'] = $(this);
			},
			onClose:function(){
				cancel['ReplyAdd'].dialog('destroy');
				cancel['ReplyAdd'] = null;
			}
		});
	}
}

function onEditReply(idd,id){
	var isform = $(".add-reply").length;
	if(!isform){
		$("<div/>").dialog({
			title:'编辑评论',
			resizable:true,
			width:850,
			height:375,
			href:'__URL__/reply/act/edit/id/'+id,
			onOpen:function(){
				cancel['ReplyAdd'] = $(this);
			},
			onClose:function(){
				cancel['ReplyAdd'].dialog('destroy');
				cancel['ReplyAdd'] = null;
			}
		});
	}
}

function onDelReply(idd,id){
	var ids = $("#ids"+idd).val();
	$.messager.confirm('提示','确定删除该评论吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.post('__URL__/reply/act/del/go/1/id/'+id, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除评论論成功！','info',function(){
						$("#proDetailCon").panel('refresh');
					});
				}else if(data==0){
					$.messager.alert('提示','删除评论失败！','warning');
				}else{
					$.messager.alert('提示','您没有删除权限！','warning');
				}
			});
		}
	});
}
//编辑
function onEdit(idd){
	var idd = $("#ids"+idd).val();
	$("#addProject").dialog({
		title:'编辑项目',
		resizable:true,
		width:850,
		height:480,
		href:'__URL__/add/act/edit/id/'+idd,
		onOpen:function(){
			cancel['Project'] = $(this);
		},
		onClose:function(){
			//$("#proDetailCon").panel('refresh');
			cancel['Project'] = null;
		}
	});
}

function onDel(idd){
	var idd = $("#ids"+idd).val();
	$.messager.confirm('提示','确定删除该项目吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.post('__URL__/del', {id:idd+','}, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除项目成功！','info',function(){
						$("#rightTabs").tabs('close','<?php echo ($info["title"]); ?>');
					});
				}else if(data==0){
					$.messager.alert('提示','删除项目失败！','warning');
				}else{
					$.messager.alert('提示','您没有删除权限！','warning');
				}
			});
		}
	});
}

function onAddFile(idd){
	var ids = $("#ids"+idd).val();
	//alert(ids);
	var isform = $(".add-file").length;
	if(!isform){
		$("<div/>").dialog({
			title:'新建文档',
			resizable:true,
			width:850,
			height:465,
			href:'__URL__/file/act/add/id/'+ids,
			//content:'__URL__/file/act/add/id/'+ids,
			onOpen:function(){
				cancel['FileAdd'] = $(this);
			},
			onClose:function(){
				cancel['FileAdd'].dialog('destroy');
				cancel['FireAdd'] = null;
//				$(this).dialog('destroy');

			}
		});
	}
}

function toEditFiles(idd){
	var isform = $(".add-file").length;
	if(!isform){
		$("<div/>").dialog({
			title:'编辑文档',
			resizable:true,
			width:850,
			height:465,
			href:'__URL__/file/act/edit/id/'+idd,
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

function onExcel(id){
	window.location = "__GROUP__/Files/word/id/"+id;
}

function onAddTask(idd){
	var idd = $("#ids"+idd).val();
	var isform = $(".add-task").length;
	if(!isform){
		$("<div/>").dialog({
			title:'新增任务',
			resizable:true,
			width:720,
			height:490,
			href:'__URL__/task/act/add/id/'+idd,
			onOpen:function(){
				cancel['Task'] = $(this);
			},
			onClose:function(){
				cancel['Task'].dialog('destroy');
				cancel['Task'] = null;
			}
		});
	}
}

function getAddWork(dates,tid){
	var pidd = $("#ids<?php echo ($uniqid); ?>").val();
	var isform = $(".add-worklog").length;
	if(!isform){
		$("<div/>").dialog({
			title:'新增工作日志',
			resizable:true,
			width:720,
			height:406,
			href:'__URL__/worklog/act/add/id/'+pidd+'/tid/'+tid+'/dates/'+dates,
			onOpen:function(){
				cancel['Worklog'] = $(this);
			},
			onClose:function(){
				cancel['Worklog'].dialog('destroy');
				cancel['Worklog'] = null;
			}
		});
	}
}

function getDetailWork(id){
	var isform = $(".add-worklog").length;
	if(!isform){
		$("<div/>").dialog({
			title:'工作日志详情',
			resizable:true,
			width:720,
			height:406,
			href:'__URL__/worklog/act/detail/id/'+id,
			onOpen:function(){
				cancel['Worklog'] = $(this);
			},
			onClose:function(){
				cancel['Worklog'].dialog('destroy');
				cancel['Worklog'] = null;
			}
		});
	}
}

function toPage(url){
	$("#proDetailCon").panel('refresh',url);
}

function toDelFiles(idd){
	$.messager.confirm('提示','确定删除该文档吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.get('__URL__/file/act/del/id/'+idd, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除文档成功！','info',function(){
						$("#Project").datagrid('reload');
					});
				}else if(data==0){
					$.messager.alert('提示','删除文档失败！','warning');
				}else{
					$.messager.alert('提示','您没有刪除的权限！','warning');
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
			href:'__GROUP__/files/detail/id/'+id,
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

function getDetailLog(id){
	var isform = $(".add-logdetail").length;
	if(!isform){
		$("<div/>").dialog({
			title:'操作日志详情',
			resizable:true,
			width:520,
			height:306,
			href:'__GROUP__/Log/logdetail/id/'+id,
			onOpen:function(){
				cancel['Logdetail'] = $(this);
			},
			onClose:function(){
				cancel['Logdetail'].dialog('destroy');
				cancel['Logdetail'] = null;
			}
		});
	}
}
</script><table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:6px;"><tr><td class="rebg" width="12%"><label for="title">项目名称</label><input id="ids<?php echo ($uniqid); ?>" type="hidden" value="<?php echo ($id); ?>" /></td><td colspan="3"><?php echo ($info["title"]); ?></td><td class="rebg" width="12%"><label for="title">项目代码</label></td><td width="21%"><?php echo ($info["code"]); ?></td></tr><tr><td class="rebg" width="12%"><label for="pass">项目进度</label></td><td width="21%"><?php echo ($pass); ?></td><td class="rebg" width="12%"><label for="pm_id">项目负责人</label></td><td width="22%"><?php echo ($info["pmname"]); ?></td><td class="rebg" width="12%"><label for="startdate">计划开始日</label></td><td width="21%"><?php echo ($mindate); ?></td></tr><tr><td class="rebg" width="12%"><label for="psss">完成率</label></td><td width="21%"><?php echo ($comple_pass); ?></td><td class="rebg" width="12%"><label for="hours">已用工時</label></td><td width="22%"><?php echo ($hours); ?> 小时</td><td class="rebg" width="12%"><label for="enddate">计划完成日</label></td><td width="21%"><?php echo ($maxdate); ?></td></tr><tr><td class="rebg" width="12%"><label for="client_id">所属客户</label></td><td colspan="3"><?php echo ($info["client"]); ?></td><td class="rebg"><label for="views">查看权限</label></td><td><?php echo ($info["viewname"]); ?></td></tr><tr><td height="35" colspan="6"><a href="javascript:void(0);" onclick="javascript:onAddTask('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-task'">下发任务</a><!--<a href="javascript:void(0);" onclick="javascript:onAddDir('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-filter'">新建文件夹</a>--><a href="javascript:void(0);" onclick="javascript:onAddFile('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-file'">新建文档</a><a href="javascript:void(0);" onclick="javascript:onAddReply('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-talk'">发表评论</a><a href="javascript:void(0);" onclick="javascript:onEdit('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-edit'">编辑</a><a href="javascript:void(0);" onclick="javascript:onDel('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-cancel'">刪除</a></td></tr></table><?php if($info['baseinfo']['content']){ ?><div><div class="detail-tit">项目详情</div><div class="detail-con"><?php echo ($info["baseinfo"]["content"]); ?></div></div><?php } if($hours){ ?><div style="margin-top:10px; width:50%; float:left;"><div class="detail-tit">已用工时分布</div><div class="detail-con" id="worklog_chart"></div></div><div style="margin-top:10px; width:40%; float:right;""><div class="detail-tit">项目统计</div><div class="detail-con" style="padding-top:22px;"><div class="total-box"><span class="tit">任务总数量：</span><span class="num"><?php echo $app->getTotal('task_table','`pro_id`='.$id); ?></span></div><div class="total-box"><span class="tit">任务已完成：</span><span class="num"><?php echo $app->getTotal('task_table','`pro_id`='.$id.' and `status`=51'); ?></span></div><div class="total-box"><span class="tit">任务未完成：</span><span class="num"><?php echo $app->getTotal('task_table','`pro_id`='.$id.' and `status`<>51'); ?></span></div><div class="total-box"><span class="tit">任务延误数：</span><span class="num"><?php echo $app->getTotal('task_table','`pro_id`='.$id.' and TO_DAYS(NOW())>TO_DAYS(`enddate`) and `status`<>51'); ?></span></div></div></div><div style="clear:both"></div><?php } if($rinfo){ ?><div style="margin-top:10px; margin-bottom:20px;"><div class="detail-tit">评论</div><div><table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0"><?php
 foreach($rinfo as $k=>$t){ if($k%2==0){ $cls = 'class="rebg5"'; }else{ $cls = ''; } ?><tr><td height="46" <?php echo ($cls); ?>><div class="tpt"><span class="rpl"><?php echo ($t["username"]); ?> 于	 <?php echo ($t["addtime"]); ?> 发表的评论</span><span class="rpr"><?php if($uid==$t['user_id'] || in_array('a',$role) || $role=='all'){ ?><a href="javascript:onEditReply('<?php echo ($uniqid); ?>','<?php echo ($t["id"]); ?>');">[编辑]</a>&nbsp;&nbsp;<a href="javascript:onDelReply('<?php echo ($uniqid); ?>','<?php echo ($t["id"]); ?>');">[刪除]</a><?php } ?></span></div><div class="tpc"><?php echo ($t["description"]); ?></div></td></tr><?php
 } ?></table><div class="pages"><?php echo ($showpage); ?></div></div></div><?php } ?><div style="margin-top:5px;"><div id="taskTabs" class="easyui-tabs" style="height:319px;"><div title="子任务"><div class="con2" id="taskListCon" onselectstart="return false;" style="-moz-user-select:none;"><table id="taskList"></table></div></div><div title="项目文档"><div class="con2" id="filesListCon" onselectstart="return false;" style="-moz-user-select:none;"><table id="filesList"></table></div></div><div title="项目日志"><div class="con2" id="logListCon" onselectstart="return false;" style="-moz-user-select:none;"><table id="logList"></table></div></div></div></div><div id="addProject"></div>