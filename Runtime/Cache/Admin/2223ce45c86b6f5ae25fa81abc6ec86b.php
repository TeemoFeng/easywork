<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">var role = '<?php echo ($role); ?>';
var act = '<?php echo ($act); ?>';
if(role==-2){
	$.messager.alert('提示','您没有新增权限！','warning');
	cancel['Project'].dialog('close');
	cancel['Project'] = null;
}else if(role==-3){
	$.messager.alert('提示','您没有编辑权限！','warning');
	cancel['Project'].dialog('close');
	cancel['Project'] = null;
}
$(function(){
	$("#addFormProject<?php echo ($uniqid); ?>").form('load',{
		'title':'<?php echo $info["title"] ?>',
		'status':'<?php echo $info["status"] ?>',
		'startdate':'<?php echo $info["baseinfo"]["startdate"] ?>',
		'enddate':'<?php echo $info["baseinfo"]["enddate"] ?>',
		'views':'<?php echo $info["views"] ?>',
		'pm_id':'<?php echo $info["pm_id"] ?>',
		'client_id':'<?php echo $info["client_id"] ?>',
		'code':'<?php echo $info["code"] ?>'
	});
	$("#views<?php echo ($uniqid); ?>").combobox({
		url:'__ITEM__/__RUNTIME__/Data/Json/Linkage/chakanquanxian_data.json',
		editable:false,
		method:'get',
		required:true,
		valueField:'id',
		textField:'text',
		onLoadSuccess:function(){
			if(act=='add'){
				$("#views<?php echo ($uniqid); ?>").combobox('setValue',16);
			}
		}
	});
	$("#client_id<?php echo ($uniqid); ?>").combobox({
		url:'__ITEM__/__RUNTIME__/Data/Json/Client_data.json',
		editable:true,
		method:'get',
		required:false,
		valueField:'id',
		textField:'text'
	});
	$("#status<?php echo ($uniqid); ?>").combobox({
		url:'__ITEM__/__RUNTIME__/Data/Json/Linkage/xiangmuzhuangtai_notit_data.json',
		editable:false,
		method:'get',
		required:false,
		valueField:'id',
		textField:'text'
	});
	$("#pm_id<?php echo ($uniqid); ?>").combotree({
		required:true,
		url:'__ITEM__/__RUNTIME__/Data/Json/User_tree_data.json',
		editable:true,
		method:'get',
		required:true,
		valueField:'id',
		textField:'text',
		keyHandler: {
			query : function(q) {
				queryComboTree(q, "pm_id<?php echo ($uniqid); ?>", 0);
			}
		},
		onBeforeSelect:function(node){
			if(isset(node.children)){
				$("#pm_id<?php echo ($uniqid); ?>").tree("unselect");
			}
		}
	});
});

var idd = '';
function onSubmitProject(idd){
	$.messager.progress();
	$("#addFormProject"+idd).form('submit',{
		url:'__URL__/add/act/add/go/1',
		onSubmit: function(){
			var isValid = $(this).form('validate');
			if (!isValid){
				$.messager.progress('close');
			}
			return isValid;
		},
		success:function(data){
			$.messager.progress('close');
			if(data==1){
				$.messager.alert('提示','新增数据成功！','info',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					cancel['ProjectName'].datagrid('reload');
					if(sa==1){
						cancel['Project'].dialog('close');
						cancel['Project'] = null;
					}
				});
			}else if(data==0){
				$.messager.alert('提示','新增数据失败！','warning');
			}else{
				$.messager.alert('提示','您没有新增权限！','warning',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					if(sa==1){
						cancel['Project'].dialog('close');
						cancel['Project'] = null;
					}
				});
			}
		}
	});
}

function onUploadProject(idd){
	$.messager.progress();
	var ids = $("#ids"+idd).val();
	$("#addFormProject"+idd).form('submit',{
		url:'__URL__/add/act/edit/go/1/id/'+ids,
		onSubmit: function(){
			var isValid = $(this).form('validate');
			if (!isValid){
				$.messager.progress('close');
			}
			return isValid;
		},
		success:function(data){
			$.messager.progress('close');
			if(data==1){
				$.messager.alert('提示','更新数据成功！','info',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					cancel['ProjectName'].datagrid('reload');
					$("#proDetailCon").panel('refresh');
					if(sa==1){
						cancel['Project'].dialog('close');
						cancel['Project'] = null;
					}
				});
				$("#add").dialog('refresh');
			}else if(data==0){
				$.messager.alert('提示','更新数据失败！','warning');
			}else{
				$.messager.alert('提示','您没有更新权限！','warning',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					if(sa==1){
						cancel['Project'].dialog('close');
						cancel['Project'] = null;
					}
				});
			}
		}
	});
}

function onResetProject(idd){
	cancel['Project'].dialog('close');
	cancel['ProjectName'] = null;
	cancel['Project'] = null;
}
</script><div class="con-tb"><form class="projecr-form" id="addFormProject<?php echo ($uniqid); ?>" method="post"><table class="infobox" width="100%" border="0" cellspacing="0" cellpadding="0"><tr><td width="13%"><label for="title">项目名称</label><input id="ids<?php echo ($uniqid); ?>" type="hidden" value="<?php echo ($id); ?>" /></td><td><input name="title" type="text" class="easyui-validatebox" value="" style="width:99%;" data-options="required:true,validType:'ptext'" /></td><td><label for="status">项目状态</label></td><td><input name="status" id="status<?php echo ($uniqid); ?>" class="relo" size="10" /><span>(选择后，将强制改变项目进度)</span></td></tr><tr><td width="13%"><label for="startdate">计划开始日</label></td><td width="37%"><input name="startdate" id="startdate<?php echo ($uniqid); ?>" class="easyui-datepicker" data-options="required:true" size="28" autocomplete="off" /></td><td width="13%"><label for="enddate">计划完成日</label></td><td width="37%"><input name="enddate" id="enddate<?php echo ($uniqid); ?>" class="easyui-datepicker" data-options="required:true" size="28" autocomplete="off" /></td></tr><tr><td width="13%"><label for="code">项目代码</label></td><td width="37%"><input name="code" id="code<?php echo ($uniqid); ?>" class="easyui-validatebox" size="12" data-options="validType:'ptext'" /> (留空时，自动生成) </td><td width="13%"><label for="views">查看权限</label></td><td width="37%"><input name="views" id="views<?php echo ($uniqid); ?>" class="relo" size="28" /></td></tr><tr><td width="13%"><label for="client_id">所属客户</label></td><td width="37%"><input name="client_id" id="client_id<?php echo ($uniqid); ?>" size="28" class="relo" /></td><td width="13%"><label for="pm_id">项目负责人</label></td><td width="37%"><input name="pm_id" id="pm_id<?php echo ($uniqid); ?>" class="relo" size="28" /></td></tr><tr><td width="13%"><label for="contents">项目详情</label></td><td colspan="3"><textarea name="content" id="contentID<?php echo ($uniqid); ?>"  rows="18" class="easyui-kindeditor" style="width:99%; height:295px" data-options="uploadJson:'__APP__/Public/Upload/save/act/project'"><?php echo ($info["baseinfo"]["content"]); ?></textarea></td></tr><tr><td height="38" colspan="4" align="center"><?php if($act=='add'){ ?><a href="javascript:void(0);" onclick="javascript:onSubmitProject('<?php echo ($uniqid); ?>')" id="su" class="easyui-linkbutton" data-options="iconCls:'icon-save'">保存</a><?php }else{ ?><a href="javascript:void(0);" onclick="javascript:return onUploadProject('<?php echo ($uniqid); ?>')" id="sue" class="easyui-linkbutton" data-options="iconCls:'icon-save'">保存</a><?php } ?> &nbsp; <a href="javascript:void(0);" onclick="javascript:onResetProject('<?php echo ($uniqid); ?>')" id="re" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">关闭</a></td></tr></table></form></div>