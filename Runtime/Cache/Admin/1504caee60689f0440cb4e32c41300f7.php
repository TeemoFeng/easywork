<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">var se = Array();
$(function(){
	var th = $(".top").height();
	th = 111-th
	var wh = $(window).height()-th;
	var cw = $(window).width()-177;
	$("#info").panel({
		//title:'信息統計',
		doSize:true,
		height:219,
		collapsible:true
	});
	whs = (wh-249);
	$("#taskUserTabs").height(whs);
});

$(function(){ 
var $this = $(".renav"); 
var scrollTimer; 
$this.hover(function(){ 
clearInterval(scrollTimer); 
},function(){ 
scrollTimer = setInterval(function(){ 
scrollNews( $this ); 
}, 3800 ); 
}).trigger("mouseout"); 
}); 
function scrollNews(obj){ 
var $self = obj.find("ul:first"); 
var lineHeight = $self.find("li:first").height(); 
$self.animate({ "margin-top" : -lineHeight +"px" },600 , function(){ 
$self.css({"margin-top":"0px"}).find("li:first").appendTo($self); 
});
}

function toShowNotice(id){
	var has = $("#detailFormNotice").length;
	if(!has){
		$("<div/>").dialog({
			title:'公告详情',
			resizable:true,
			width:720,
			height:480,
			href:'__GROUP__/Notice/detail/id/'+id,
			onOpen:function(){
				cancel['NoticeDetail'] = $(this);
			},
			onClose:function(){
				$(this).dialog('destroy');
				cancel['NoticeDetail'] = null;
			}
		});
	}
}

function onCheckVer(){
	var url = 'http://'+window.location.host;
	var x = $.getJSON("http://server.piocms.com/dwuss/index.php/Admin/project/upload?callback=?",{mode:'EasyWork', serial:'<?php echo $serial ?>', ver:'<?php echo $ver[0] ?>' ,domain:url, key:'e1a111321d2cc0c2ba779e7ccd43994d'}, function(data){
		$.get('__URL__/upver');
		return;
	});
}
</script><div class="con" id="TaskIndexCon"><div id="info" style="margin-bottom:5px; padding:3px;"><table class="infobox table-border linebox" width="100%" border="0" cellspacing="0" cellpadding="0"><tr style="height:25px;"><td><span class="vol up-font-over"><div class="renav_tit">公告：</div><div class="renav"><ul style="margin-top: 0px;"><?php if(is_array($ninfo)): foreach($ninfo as $key=>$t): ?><li><a href="javascript:toShowNotice('<?php echo ($t["id"]); ?>')"><?php echo ($t["title"]); ?>&nbsp;/&nbsp;<?php echo ($t["addtime"]); ?></a></li><?php endforeach; endif; ?></ul></div></span></td></tr><tr style="height:23px; line-height:23px;"><td height="28" class="rebg"><label>项目状态统计</label></td></tr><tr style="height:35px; line-height:35px;"><td><span style="margin-right:25px;">项目总数量：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('Project_table'); ?></span></span><span style="margin-right:25px;">项目已完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $comple; ?></span></span><span style="margin-right:25px;">项目未完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $un_comple; ?></span></span><span style="margin-right:25px;">项目延误数：<span class="up-font-over" style="font-weight:bold;"><?php echo $old; ?></span></span><span style="margin-right:25px;">任务总数量：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table'); ?></span></span><span style="margin-right:25px;">任务已完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','`status`=51'); ?></span></span><span style="margin-right:25px;">任务未完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','`status`<>51'); ?></span></span><span style="margin-right:25px;">任务延误数：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','TO_DAYS(NOW())>TO_DAYS(`enddate`) and `status`<>51'); ?></span></span></td></tr><tr style="height:23px; line-height:23px;" class="rebg5"><td><?php
 foreach($task_status as $k=>$t){ ?><span class="total_box"><div style="font-weight:bold; line-height:20px; font-size:19px; color:#5B83B9"><?php echo $app->getTotal('Task_table','`status`='.$t['id']); ?></div><div><?php echo ($t["text"]); ?></div></span><?php
 } ?></td></tr><tr style="height:23px; line-height:23px;"><td height="28" class="rebg"><label>我的任务统计</label></td></tr><tr style="height:35px; line-height:35px;"><td><span style="margin-right:25px;">任务总数量：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','`to_id`='.$userid); ?></span></span><span style="margin-right:25px;">任务已完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','`status`=51 and `to_id`='.$userid); ?></span></span><span style="margin-right:25px;">任务未完成：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','`status`<>51 and `to_id`='.$userid); ?></span></span><span style="margin-right:25px;">任务延误数：<span class="up-font-over" style="font-weight:bold;"><?php echo $app->getTotal('task_table','TO_DAYS(NOW())>TO_DAYS(`enddate`) and `status`<>51 and `to_id`='.$userid); ?></span></span></td></tr></table></div><div id="taskUserTabs" class="easyui-tabs"><?php if($protype==0){ ?><div title="指派給我的任务" data-options="href:'__URL__/tasklist/type/1',cache:false"></div><div title="来自我的任务" data-options="href:'__URL__/tasklist/type/2',cache:false"></div><div title="待我审核的任务" data-options="href:'__URL__/tasklist/type/3',cache:false"></div><div title="所有任务" data-options="href:'__URL__/tasklist/type/0',cache:false"></div><?php }else{ ?><div title="相关任务" data-options="href:'__URL__/tasklist/type/0',cache:false"></div><?php } ?></div><div align="center" style="line-height:26px; color:#A7A7A7;">Copyright © 2010-2015 程序由 <a style="line-height:26px; color:#A7A7A7;" href="http://www.95era.com/" target="_blank">九五时代</a> 设计开发 &nbsp; <span><a class="up-font-over" onclick="onCheckVer()" href="http://www.d-winner.com/html/download/easyworkapp/" target="_blank">版本号：<?php echo ($ver["0"]); ?></a></span></div></div>