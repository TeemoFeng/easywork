<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">$(function(){
	var th = $(".top").height();
	th = 111-th
	var wh = $(window).height()-th;
	$("#projectUserTabs").height(wh);
});
</script><div class="con" id="ProjectIndexCon"><div id="projectUserTabs" class="easyui-tabs"><?php if($protype==0){ ?><div title="我负责的项目" data-options="href:'__URL__/projectlist/type/1',cache:false"></div><div title="我参与的项目" data-options="href:'__URL__/projectlist/type/2',cache:false"></div><div title="所有项目" data-options="href:'__URL__/projectlist/type/3',cache:false"></div><?php }else{ ?><div title="相关项目" data-options="href:'__URL__/projectlist/type/3',cache:false"></div><?php } ?></div></div>