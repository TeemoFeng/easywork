<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><html><head><script type="text/javascript" src="__ITEM__/__UI__/jquery.js"></script><script type="text/javascript" src="__ITEM__/__JS__/jquery.cookie.js"></script><script language="javascript">    var isskin = $.cookie('easyui')?$.cookie('easyui'):'default';
    document.write('<link id="easySty" rel="stylesheet" type="text/css" href="__ITEM__/__UI__/themes/'+isskin+'/easyui.css">');
    document.write('<link type="text/css" rel="stylesheet" href="__ITEM__/__ADMIN.CSS__/index.css">');
    document.write('<link id="adminSty" type="text/css" rel="stylesheet" href="__ITEM__/__ADMIN.CSS__/'+isskin+'/style.css">');
</script><link rel="stylesheet" type="text/css" href="__ITEM__/__UI__/themes/icon.css"><link rel="stylesheet" href="__ITEM__/__JS__/kindeditor/themes/default/default.css" /><link rel="stylesheet"  href="__ITEM__/__JS__/datepicker/skin/default/datepicker.css"><script type="text/javascript" src="__ITEM__/__JS__/datepicker/WdatePicker.js"></script><script type="text/javascript" src="__ITEM__/__JS__/datepicker/lang/zh-cn.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/kindeditor-min.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/lang/zh_CN.js"></script><script type="text/javascript" src="__ITEM__/__UI__/jquery.easyui.min.js"></script><script type="text/javascript" src="__ITEM__/__UI__/locale/easyui-lang-zh_CN.js"></script><script type="text/javascript" src="__ITEM__/__UI__/plugins/jquery.kindeditor.js"></script><script type="text/javascript" src="__ITEM__/__UI__/plugins/jquery.datepicker.js"></script><script type="text/javascript" src="__ITEM__/__UI__/view/datagrid-scrollview.js"></script><script type="text/javascript" src="__ITEM__/__UI__/view/datagrid-bufferview.js"></script><script type="text/javascript" src="__ITEM__/__JS__/objFunc.js"></script><script type="text/javascript" src="__ITEM__/__JS__/getPinYin.js"></script><script type="text/javascript" src="__ITEM__/__JS__/objClass.js"></script><script type="text/javascript" src="__ITEM__/__JS__/acrossClass.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/plugins/image/image.js"></script><script type="text/javascript" src="__JS__/chart/js/swfobject.js"></script><script language="javascript">var cancel = new Array();
$.extend($.fn.datagrid.methods, {
    setColumnTitle: function(jq, option){
        if(option.field){
            return jq.each(function(){
                var $panel = $(this).datagrid("getPanel");
                var $field = $('td[field='+option.field+']',$panel);
                if($field.length){
                    var $span = $("span",$field).eq(0);
                    $span.html(option.text);
                }
            });
        }
        return jq;
    }
});

$(function(){
	//var th = $(".top").height();
    var th = 15;
	thh = 111-th;
	var wh = $(window).height()-th;
	$("#ProjectDetail").width();
    $("#leftTask").height(wh); //左侧任务栏的高
	$(".panelson").height(wh);
	$(".accordion-body").height(wh-25);

});

function onClickTask(node){
	var idpa = isset(node._parentId);
	var id = node.id;
	if(idpa){
		$("#proDetailCon").panel('refresh','__URL__/content/id/<?php echo ($id); ?>/tid/'+id);
	}else{
		$("#proDetailCon").panel('refresh','__URL__/content/id/'+id);
	}
}

function onCheckTree(){
	var tid = '<?php echo ($tid); ?>';
	if(tid){
		var node = $('#taskTree').tree('find',tid);
		$('#taskTree').tree('check', node.target);
	}
}
</script></head><body class="easyui-layout"><div class="easyui-layout" data-options="fit:true" style="height: 100%"><!--layout布局--><div data-options="region:'west',border:false" style="width:248px"><!--西区显示项目列表--><div id="leftTask" class="easyui-accordion" style="width:238px;"><div title="项目任务分解" data-options="selected:true"><ul id="taskTree" class="easyui-tree left-tree" data-options="url:'__URL__/getTask/pid/<?php echo ($id); ?>',editable:false,lines:true,method:'get',onClick:function(node){onClickTask(node);},onLoadSuccess:function(node){onCheckTree();}"></ul></div></div></div><div data-options="region:'center',border:false"><div class="task-right"><?php if($tid){ ?><div id="proDetailCon" class="easyui-panel panelson" data-options="href:'__URL__/content/id/<?php echo ($id); ?>/tid/<?php echo ($tid); ?>',border:false"></div><?php }else{ ?><div id="proDetailCon" class="easyui-panel panelson" data-options="href:'__URL__/content/id/<?php echo ($id); ?>',border:false"></div><?php } ?></div></div></div></body></html>