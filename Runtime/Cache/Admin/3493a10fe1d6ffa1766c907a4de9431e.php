<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">function onSubmitReply(idd){
	var ids = $("#ids"+idd).val();
	var dc = $("#description"+idd).val();
	if(dc){
		$.messager.progress();
		$("#addFormReply"+idd).form('submit',{
			url:'__URL__/reply/act/add/go/1/tid/'+ids,
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
						$("#proDetailCon").panel('refresh');
						if(sa==1){
							cancel['ReplyAdd'].dialog('destroy');
							cancel['ReplyAdd'].dialog('close');
							cancel['ReplyAdd'] = null;
						}
					});
				}else if(data==0){
					$.messager.alert('提示','新增数据失败！','warning');
				}else{
					//alert(data);
					$.messager.alert('提示','您没有新增权限！','warning',function(){
						var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
						if(sa==1){
							cancel['ReplyAdd'].dialog('destroy');
							cancel['Replyadd'].dialog('close');
							cancel['Replyadd'] = null;
						}
					});
				}
			}
		});
	}
}

function onUploadReply(idd){
	$.messager.progress();
	var ids = $("#ids"+idd).val();
	$("#addFormReply"+idd).form('submit',{
		url:'__URL__/reply/act/edit/go/1/tid/'+ids,
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
					$("#proDetailCon").panel('refresh');
					if(sa==1){
						cancel['ReplyAdd'].dialog('destroy');
						cancel['ReplyAdd'].dialog('close');
						cancel['ReplyAdd'] = null;
					}
				});
			}else if(data==0){
				$.messager.alert('提示','更新数据失败！','warning');
			}else{
				//alert(data);
				$.messager.alert('提示','您没有更新权限！','warning',function(){
					var sa = '<?php echo (C("SUBMIT_ACTION")); ?>';
					if(sa==1){
						cancel['ReplyAdd'].dialog('destroy');
						cancel['ReplyAdd'].dialog('close');
						cancel['ReplyAdd'] = null;
					}
				});
			}
		}
	});
}

function onResetReply(idd){
	cancel['ReplyAdd'].dialog('destroy');
	cancel['ReplyAdd'].dialog('close');
	cancel['ReplyAdd'] = null;
}
</script><div class="con-tb"><form class="add-reply" id="addFormReply<?php echo ($uniqid); ?>" method="post"><table width="100%" class="infobox linebox reportbox" border="0" cellspacing="0" cellpadding="0" style="border-collapse: collapse;"><tr><td width="10%" class="rebg"><label>內容</label><input name="pro_id" type="hidden" value="<?php echo ($id); ?>" /><input id="ids<?php echo ($uniqid); ?>" name="task_id" type="hidden" value="<?php echo ($tid); ?>" /><input name="reply_id" type="hidden" value="<?php echo ($info["id"]); ?>" /></td><td><textarea name="description" id="description<?php echo ($uniqid); ?>"  rows="18" class="easyui-kindeditor" style="width:99%; height:283px" data-options="uploadJson:'__APP__/Public/Upload/save/'"><?php echo ($info["description"]); ?></textarea></td></tr><tr><td height="38" colspan="2" align="center"><?php if($act=='add'){ ?><a href="javascript:void(0);" onclick="javascript:onSubmitReply('<?php echo ($uniqid); ?>')" class="easyui-linkbutton" data-options="iconCls:'icon-save'">保存</a><?php }else{ ?><a href="javascript:void(0);" onclick="javascript:return onUploadReply('<?php echo ($uniqid); ?>')" class="easyui-linkbutton" data-options="iconCls:'icon-save'">保存</a><?php } ?> &nbsp; <a href="javascript:void(0);" onclick="javascript:onResetReply('<?php echo ($uniqid); ?>')" class="easyui-linkbutton" data-options="iconCls:'icon-cancel'">关闭</a></td></tr></table></form></div>