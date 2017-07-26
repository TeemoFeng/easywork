<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">function onAddTaskReply(idd){
	var ids = $("#ids"+idd).val();
	var pidd = $("#pids").val();
	var isform = $(".add-reply").length;
	if(!isform){
		$("<div/>").dialog({
			title:'发表评论',
			resizable:true,
			width:850,
			height:375,
			href:'__URL__/reply/act/add/id/'+pidd+'/tid/'+ids,
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

function onEditTaskReply(idd,id){
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

function onDelTaskReply(idd,id){
	var ids = $("#ids"+idd).val();
	$.messager.confirm('提示','确定删除该评论吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.post('__URL__/reply/act/del/go/1/id/'+id, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除评论成功！','info',function(){
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

function onEditTask(idd){
	var idd = $("#ids"+idd).val();
	var isform = $(".add-task").length;
	if(!isform){
		$("<div/>").dialog({
			title:'编辑任务',
			resizable:true,
			width:720,
			height:480,
			href:'__URL__/task/act/edit/id/'+idd,
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

function onDelTask(idd){
	var idd = $("#ids"+idd).val();
	var pidd = $("#pids").val();
	$.messager.confirm('提示','确定删除该任务吗！',function(r){
		if(r==true){
			$.messager.progress();
			$.post('__URL__/task/act/del/go/1', {id:idd,pid:pidd}, function(data){
				$.messager.progress('close');
				if(data==1){
					$.messager.alert('提示','删除任务成功！','info',function(){
						$("#taskTree").tree('reload');
						$("#proDetailCon").panel('refresh','__URL__/content/id/'+pidd);
					});
				}else if(data==2){
					$.messager.alert('提示','该任务已审核，不能删除！','warning');
				}else if(data==0){
					$.messager.alert('提示','删除任务失败！','warning');
				}else{
					$.messager.alert('提示','您没有删除权限！','warning');
				}
			});
		}
	});
}

function onCheck(idd,type){
	var idd = $("#ids"+idd).val();
	var pidd = $("#pids").val();
	if(type==1){
		$.messager.confirm('提示','确定审核该任务吗！',function(r){
			if(r==true){
				$.messager.progress();
				$.post('__URL__/check/type/1', {id:idd,pid:pidd}, function(data){
					$.messager.progress('close');
					if(data==1){
						$.messager.alert('提示','审核任务成功！','info',function(){
							$("#proDetailCon").panel('refresh');
						});
					}else if(data==0){
						$.messager.alert('提示','审核任务失败！','warning');
					}else{
						$.messager.alert('提示','您没有审核权限！','warning');
					}
				});
			}
		});
	}else{
		$.messager.confirm('提示','确定反审核吗！',function(r){
			if(r==true){
				$.messager.progress();
				$.post('__URL__/check/type/0', {id:idd,pid:pidd}, function(data){
					$.messager.progress('close');
					if(data==1){
						$.messager.alert('提示','反审核任务成功！','info',function(){
							$("#proDetailCon").panel('refresh');
						});
					}else if(data==0){
						$.messager.alert('提示','反审核任务失败！','warning');
					}else{
						$.messager.alert('提示','您没有审核权限！','warning');
					}
				});
			}
		});
	}
}

function onAddTasks(idd){
	var idd = $("#ids"+idd).val();
	var pidd = $("#pids").val();
	var isform = $(".add-task").length;
	if(!isform){
		$("<div/>").dialog({
			title:'新增任务',
			resizable:true,
			width:720,
			height:490,
			href:'__URL__/task/act/add/id/'+pidd+'/tid/'+idd,
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

function getAddWork(dates){
	var idd = $("#ids<?php echo ($uniqid); ?>").val();
	var pidd = $("#pids").val();
	var isform = $(".add-worklog").length;
	if(!isform){
		$("<div/>").dialog({
			title:'新增工作日志',
			resizable:true,
			width:720,
			height:406,
			href:'__URL__/worklog/act/add/id/'+pidd+'/tid/'+idd+'/dates/'+dates,
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

$(function(){
	$("#lastMonth").click(function(){
		var idd = $("#ids<?php echo ($uniqid); ?>").val();
		var pidd = $("#pids").val();
		$("#proDetailCon").panel('refresh','__URL__/content/id/'+pidd+'/tid/'+idd+'/json/1/getmonth/<?php echo ($nowmonth); ?>');
	});
	
	$("#nextMonth").click(function(){
		var idd = $("#ids<?php echo ($uniqid); ?>").val();
		var pidd = $("#pids").val();
		$("#proDetailCon").panel('refresh','__URL__/content/id/'+pidd+'/tid/'+idd+'/json/2/getmonth/<?php echo ($nowmonth); ?>');
	});
});

function toPage(url){
	$("#proDetailCon").panel('refresh',url);
}
</script><table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0" style="margin-bottom:6px;"><tr><td class="rebg" width="12%"><label for="title">任务名称</label><input id="ids<?php echo ($uniqid); ?>" type="hidden" value="<?php echo ($info["id"]); ?>" /><input id="pids" type="hidden" value="<?php echo ($info["main"]["pro_id"]); ?>" /></td><td colspan="5">【<?php echo ($info["typename"]); ?>】<?php echo ($info["title"]); ?></td></tr><tr><td class="rebg" width="12%"><label for="status">任务状态</label></td><td width="21%"><?php echo ($info["statusname"]); ?></td><td class="rebg" width="12%"><label for="level">优先级</label></td><td width="22%"><?php echo ($info["levelname"]); ?></td><td class="rebg" width="12%"><label for="degree">严重程度</label></td><td width="21%"><?php echo ($info["degreename"]); ?></td></tr><tr><td class="rebg" width="12%"><label for="to_id">指派给</label></td><td width="21%"><?php echo ($info["toname"]); ?></td><td class="rebg" width="12%"><label for="views">已使用工时</label></td><td width="22%"><?php echo ($hours); ?> 小时</td><td class="rebg" width="12%"><label for="startdate">计划开始日</label></td><td width="21%"><?php echo ($info["startdate"]); ?></td></tr><tr><td class="rebg" width="12%"><label for="from_id">来自</label></td><td width="21%"><?php echo ($info["fromname"]); ?></td><td class="rebg" width="12%"><label for="plantime">计划使用工时</label></td><td width="22%"><?php echo roundnum($info['plantime']); ?> 小时</td><td class="rebg" width="12%"><label for="enddate">计划完成日</label></td><td width="21%"><?php echo ($info["enddate"]); ?></td></tr><tr><td class="rebg" width="12%"><label for="check">是否审核</label></td><td width="21%"><?php echo ($info["checkinfo"]); if($info['check']){ ?>[<span class="up-font"><?php echo ($info["checkname"]); ?></span>]<?php } ?></td><td class="rebg" width="12%"><label for="shengyu">剩余工时</label></td><td><?php echo roundnum($info['plantime']-$hours); ?> 小时</td><td class="rebg"><label for="remain">任务进度</label></td><td><?php echo ($info["pass"]); ?></td></tr><tr><td height="35" colspan="6"><a href="javascript:void(0);" onclick="javascript:onAddTasks('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-task'">下发任务（分解）</a><?php if($info['check']){ ?><a href="javascript:void(0);" onclick="javascript:onCheck('<?php echo ($uniqid); ?>',0)" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-ok'">反审核</a><?php }else{ ?><a href="javascript:void(0);" onclick="javascript:onCheck('<?php echo ($uniqid); ?>',1)" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-ok'">审核</a><?php } ?><a href="javascript:void(0);" onclick="javascript:onAddTaskReply('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-talk'">发表评论</a><a href="javascript:void(0);" onclick="javascript:onEditTask('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-edit'">编辑</a><a href="javascript:void(0);" onclick="javascript:onDelTask('<?php echo ($uniqid); ?>')" class="easyui-linkbutton ma-right" data-options="iconCls:'icon-cancel'">刪除</a></td></tr></table><?php if($info['baseinfo']['content']){ ?><div><div class="detail-tit">任务详情</div><div class="detail-con"><?php echo ($info["baseinfo"]["content"]); ?></div></div><?php } if($logcount > 0){ ?><div style="margin-top:10px;"><div class="detail-tit">操作日志</div><div class="detail-con"><?php echo ($linfo); ?></div></div><?php } if($rinfo){ ?><div style="margin-top:10px; margin-bottom:20px;"><div class="detail-tit">评论</div><div><table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0"><?php
 foreach($rinfo as $k=>$t){ if($k%2==0){ $cls = 'class="rebg5"'; }else{ $cls = ''; } ?><tr><td height="46" <?php echo ($cls); ?>><div class="tpt"><span class="rpl"><?php echo ($t["username"]); ?> 于	 <?php echo ($t["addtime"]); ?> 发表的评论</span><span class="rpr"><?php if($uid==$t['user_id'] || in_array('a',$role) || $role=='all'){ ?><a href="javascript:onEditTaskReply('<?php echo ($uniqid); ?>','<?php echo ($t["id"]); ?>');">[编辑]</a>&nbsp;&nbsp;<a href="javascript:onDelTaskReply('<?php echo ($uniqid); ?>','<?php echo ($t["id"]); ?>');">[刪除]</a><?php } ?></span></div><div class="tpc"><?php echo ($t["description"]); ?></div></td></tr><?php
 } ?></table><div class="pages"><?php echo ($showpage); ?></div></div></div><?php } ?><div style="margin-top:10px;"><div class="detail-tit">工作日志</div><div class="detail-con"><table width="100%" border="0" cellspacing="0" cellpadding="0"><tr class="topdate"><td width="14%" height="35" valign="top"><span class="lastmon le"><a href="javascript:void(0);" id="lastMonth" class="up-font">上一月</a></span></td><td colspan="5" align="center" valign="top" class="toptit"><?php echo ($nowmonth); ?></td><td width="15%" align="right" valign="top"><span class="nextmon ri"><a href="javascript:void(0);" id="nextMonth" class="up-font">下一月</a></span></td></tr><tr class="titdate"><td width="14%" align="center">星期日</td><td width="14%" align="center">星期一</td><td width="14%" align="center">星期二</td><td width="14%" align="center">星期三</td><td width="14%" align="center">星期四</td><td width="14%" align="center">星期五</td><td width="14%" align="center">星期六</td></tr></table><table class="infobox table-border" width="100%" border="0" cellspacing="0" cellpadding="0"><?php echo ($str); ?></table></div></div><div id="addProject"></div>