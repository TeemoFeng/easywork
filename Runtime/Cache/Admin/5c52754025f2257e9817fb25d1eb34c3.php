<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd"><html xmlns="http://www.w3.org/1999/xhtml"><html><head><meta http-equiv="X-UA-Compatible" content="IE=EmulateIE8" content="ie=edge" /><meta http-equiv="Content-Type" content="text/html; charset=UTF-8"><title>EasyWork项目管理系统 - <?php echo C('CFG_NAME') ?></title><script type="text/javascript" src="__ITEM__/__UI__/jquery.js"></script><script type="text/javascript" src="__ITEM__/__JS__/jquery.cookie.js"></script><script language="javascript"> var isskin = $.cookie('easyui')?$.cookie('easyui'):'default';
 document.write('<link id="easySty" rel="stylesheet" type="text/css" href="__ITEM__/__UI__/themes/'+isskin+'/easyui.css">');
 document.write('<link type="text/css" rel="stylesheet" href="__ITEM__/__ADMIN.CSS__/index.css">');
 document.write('<link id="adminSty" type="text/css" rel="stylesheet" href="__ITEM__/__ADMIN.CSS__/'+isskin+'/style.css">');
 </script><link rel="stylesheet" type="text/css" href="__ITEM__/__UI__/themes/icon.css"><link rel="stylesheet" href="__ITEM__/__JS__/kindeditor/themes/default/default.css" /><link rel="stylesheet"  href="__ITEM__/__JS__/datepicker/skin/default/datepicker.css"><script type="text/javascript" src="__ITEM__/__JS__/datepicker/WdatePicker.js"></script><script type="text/javascript" src="__ITEM__/__JS__/datepicker/lang/zh-cn.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/kindeditor-min.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/lang/zh_CN.js"></script><script type="text/javascript" src="__ITEM__/__UI__/jquery.easyui.min.js"></script><script type="text/javascript" src="__ITEM__/__UI__/locale/easyui-lang-zh_CN.js"></script><script type="text/javascript" src="__ITEM__/__UI__/plugins/jquery.kindeditor.js"></script><script type="text/javascript" src="__ITEM__/__UI__/plugins/jquery.datepicker.js"></script><script type="text/javascript" src="__ITEM__/__UI__/view/datagrid-scrollview.js"></script><script type="text/javascript" src="__ITEM__/__UI__/view/datagrid-bufferview.js"></script><script type="text/javascript" src="__ITEM__/__JS__/objFunc.js"></script><script type="text/javascript" src="__ITEM__/__JS__/getPinYin.js"></script><script type="text/javascript" src="__ITEM__/__JS__/objClass.js"></script><script type="text/javascript" src="__ITEM__/__JS__/acrossClass.js"></script><script charset="utf-8" src="__ITEM__/__JS__/kindeditor/plugins/image/image.js"></script><script type="text/javascript" src="__JS__/chart/js/swfobject.js"></script><script language="javascript"> var cancel = new Array();
 
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
 
 function toRepwd(){
	 $(function(){
		var idd = <?php echo $_SESSION['login']['se_id'] ?>;
		$("#repwd").dialog({
			title:'修改密码',
			resizable:true,
			width:400,
			height:230,
			href:'__GROUP__/User/repwd/id/'+idd,
			onOpen:function(){
				cancel['Repwd'] = $(this);
			},
		});	 
	 });
 }
 
 function toShowSms(){
	 $(function(){
		$("#setpwd").dialog({
			title:'我的信息',
			resizable:true,
			width:580,
			height:353,
			href:'__URL__/showsms/act/1',
			onOpen:function(){
				cancel['Sendsms'] = $(this);
			},
			onClose:function(){
				cancel['SmsDetail'].dialog('destroy');
				cancel['SmsDetail'].dialog('close');
				cancel['SmsDetail'] = null;
				cancel['Sendmail'] = null;
			}
		});	 
	 });
 }
 
 function toSetpwd(){
	 $(function(){
		var idd = <?php echo $_SESSION['login']['se_id'] ?>;
		$("#setpwd").dialog({
			title:'邮箱设置',
			resizable:true,
			width:450,
			height:255,
			href:'__GROUP__/User/setpwd/id/'+idd,
			onOpen:function(){
				cancel['Setpwd'] = $(this);
			},
		});	 
	 });
 }
 
 function toSendMail(){
	var idd = <?php echo $_SESSION['login']['se_id'] ?>;
	$("<div />").dialog({
		title:'发邮件',
		resizable:true,
		width:900,
		height:435,
		href:'__APP__/Public/Mail/index/mode/1/id/'+idd,
		onOpen:function(){
			cancel['Sendmail'] = $(this);
		},
		onClose:function(){
			cancel['Sendmail'].dialog('destroy');
			cancel['Sendmail'] = null;
		}
	});
 }
 
 function toClearCache(){
	 $(function(){
		$.get('__URL__/cache', function(data){
			$.messager.alert('提示','所有缓存已被清除！','info');
		}); 
		
	 });
 }
 
 
 
 $(function(){
	$.ajaxSetup({  
		async : false  
	});
	
	var browser_cache = Boolean(Number('<?php echo (C("BROWSER_CACHE")); ?>'));
	jQuery.ajaxSetup ({cache:browser_cache});
	
	$(window).bind('load',function(){
		$.get('__URL__/clear', function(data){});
	});
	
	$.ajaxSetup({  
		async : true  
	});
 });
 </script></head><body class="easyui-layout"><div class="top" id="topBg" data-options="region:'north',border:false"><script language="javascript">$(function(){
	$("body").append("<div class='skin-box'>"
	+"<div class='skin-list' id='default' title='默认蓝'><div class='skin-color' style='background-color:#ddeaff; width:100%; height:100%;'></div></div>"
	+"<div class='skin-list' id='black' title='灰黑色'><div class='skin-color' style='background-color:#3d3d3d; width:100%; height:100%;'></div></div>"
	+"<div class='skin-list' id='metro-gray' title='浅灰色'><div class='skin-color' style='background-color:#c7ccd1; width:100%; height:100%;'></div></div>"
	+"<div class='skin-list' id='grinder' title='土黃色'><div class='skin-color' style='background-color:#e0decb; width:100%; height:100%;'></div></div>"
	+"<div class='skin-list' id='metro-red' title='粉红色'><div class='skin-color' style='background-color:#ebd8da; width:100%; height:100%;'></div></div>"
	+"<div class='skin-list' id='cupertino' title='宝石蓝'><div class='skin-color' style='background-color:#c4e2f7; width:100%; height:100%;'></div></div>"
	+"</div>");
	
	$("#chgSkin img").click(function(){
		var sb = $(".skin-box");
		var x = $(this).offset();
		var xl = x.left;
		var xt = x.top;
		var xw = $(".skin-box").width();
		var sw = $(".show").width();
		//alert(xw);
		sb.css({
			top:xt+15,
			left:xl-xw+22
		});
		sb.fadeToggle();
		return false;
	});
	
	$("body").click(function(){
		$(this).find(".skin-box").click(function(){
			return false;
		});
		var sb = $(".skin-box");
		sb.fadeOut();
	});
	
	$(".skin-list").click(function(){
		$.ajaxSetup({  
			async : false  
		});
	
		var skinid = $(this).attr("id");
		var skinexp = Number('<?php echo (C("SKIN_COOKIE_EXPIRES")); ?>');
		$("#adminSty").attr("href","__ITEM__/__ADMIN.CSS__/"+skinid+"/style.css");
		$("#logoImg").attr("src","__ITEM__/__ADMIN.CSS__/"+skinid+"/logo.png");
		$("#easySty").attr("href","__ITEM__/__UI__/themes/"+skinid+"/easyui.css");
		$.cookie('easyui',skinid, { expires: skinexp });
		$('#layoutBody').layout('resize');
		
		$.ajaxSetup({  
			async : true  
		});
		return false;
	});
	
	$.get('__URL__/getsms',function(data){
		if(data>0){
			$("#smsid").html(data);
			$("#smsid").attr("title","您有"+data+"条未读通知");
		}else{
			$("#smsid").html("0");
			$("#smsid").attr("title","您没有未读通知");
		}
	});
	
	
});

function showTab(tit,pid){
	var ishas = $("#rightTabs").tabs('exists',tit);
	if(!ishas){
		$("#rightTabs").tabs('add',{
			id : -4,
			title : tit,
			href : '__GROUP__/Project/detail/id/'+pid,
			closable : true,
		});
	}else{
		$("#rightTabs").tabs('select',tit);
	}
}
</script><div class="logo"><script language="javascript">   document.write('<img id="logoImg" src="__ITEM__/__ADMIN.CSS__/'+isskin+'/logo.png" /></div>');
  </script><div class="show"><div class="l2"><span id="localtime" style="margin-right:18px"></span><a style="margin-right:2px;" href="#" id="chgSkin" title="切换皮肤"><img src="__ITEM__/__IMG__/skin.png" /></a><span class="hi">您好：<strong><?php echo $_SESSION['login']['se_user'] ?></strong> 您有<span id="smsid" class="margin_lr bgcolor_bolck bgcolor_cs" style="cursor:pointer;" onclick="toShowSms()"></span>条通知 - <?php echo $_SESSION['login']['se_group'] ?> &nbsp;[<a href="javascript:toSendMail();">发邮件</a>] <?php if($group_access>=9999){ ?>[<a href="javascript:toClearCache();">清除缓存</a>]<?php } ?> [<a href="javascript:toRepwd();">修改密码</a>] [<a href="javascript:toSetpwd();">邮箱设置</a>] [<a target="_top" href="__APP__?g=<?php echo GROUP_NAME; ?>&m=Index&a=safe">注销</a>] [<a href="http://www.d-winner.com/" target="_blank">帮助</a>]</span></div></div><script runat="server" language="javascript">function tick(){  
    var today;  
    today = new Date();
    document.getElementById("localtime").innerHTML = showLocale(today);  
    window.setTimeout("tick()", 1000);  
}
tick();
</script></div><div data-options="region:'west',split:true,title:'菜单'" style="width:165px;"><script language="javascript">	function onClickTree(node){
		var id = node.id;
		var tit = node.text;
		var url = node.url;
		var icon = node.iconCls;
		//alert(url);
		if(url){
			addTabs(id,tit,url,icon);
		}
	}
	
	var idd = '';
	var tit = '';
	var url = '';
	var icon = '';
	function addTabs(id,tit,url,icon){
		$(function(){
			var mod = '<?php echo (C("CFG_OPEN_TABS")); ?>';
			//alert(mod);
			if(mod==1){
				var ishas = $("#rightTabs").tabs('exists',tit);
				if(!ishas){
					$("#rightTabs").tabs('add',{
						id : idd,
						title : tit,
						href : '__ITEM__'+url,
						closable : true,
						iconCls : icon
					});
				}else{
					$("#rightTabs").tabs('select',tit);
				}
			}else{
				var ishas = $("#rightTabs").tabs('exists',tit);
				if(!ishas){
					var tab = $("#rightTabs").tabs('getTab',0);
					$.get('__GROUP__/index/clear', function(data){});
					$("#rightTabs").tabs('update',{
						tab:tab,
						options:{
							id:-1,
							title : tit,
							href : '__ITEM__'+url,
							closable : false,
							iconCls : icon
						} 
					});
				}else{
					$("#rightTabs").tabs('select',tit);
				}
			}
		});
	}
</script><div id="leftMenu" data-options="fit:true,border:false" class="easyui-accordion"><?php if(is_array($info)): foreach($info as $key=>$t): if($t['mode']==1){ $access = IndexPublic::GS('User_group_table',$gid); }elseif($t['mode']==2){ $access = IndexPublic::GS('User_company_table',$cid); }elseif($t['mode']==3){ $access = IndexPublic::GS('User_part_table',$pid); } if($t['type']=='='){ $view = unserialize($t['view']); if(strstr($t['level'],$access) || ($group_access>=999 && $t['level']<9999) || in_array($uid,$view)){ ?><div title="<?php echo ($t["text"]); ?>" data-options="iconCls:'<?php echo ($t["iconCls"]); ?>'"><ul class="easyui-tree left-tree" data-options="url:'__GROUP__/Index/json/mid/<?php echo ($t["id"]); ?>',editable:false,lines:true,method:'get',onClick:function(node){onClickTree(node);}"></ul></div><?php
 } }else{ $view = unserialize($t['view']); if($access>=$t['level'] || in_array($uid,$view)){ ?><div title="<?php echo ($t["text"]); ?>" data-options="iconCls:'<?php echo ($t["iconCls"]); ?>'"><ul class="easyui-tree left-tree" data-options="url:'__GROUP__/Index/json/mid/<?php echo ($t["id"]); ?>',editable:false,lines:true,method:'get',onClick:function(node){onClickTree(node);}"></ul></div><?php
 } } endforeach; endif; ?><!--
 <div title="系统管理" data-options="iconCls:'icon-setting'"><ul class="easyui-tree left-tree",editable:false,lines:true"><li data-options="text:'菜单管理',url:'__GROUP_/Menu/index'">菜单管理</li></ul></div>--></div></div><div data-options="region:'center',split:true" class="center-wd"><div id="rightTabs" class="easyui-tabs" data-options="fit:true,border:false"><div title="任务列表" data-options="closable:false,id:-1,href:'__GROUP__/Task/index'"></div></div></div><div id="repwd"></div><div id="setpwd"></div></body></html>