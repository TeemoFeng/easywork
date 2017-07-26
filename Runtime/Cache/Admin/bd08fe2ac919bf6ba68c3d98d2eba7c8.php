<?php if (!defined('THINK_PATH')) exit();?><script language="javascript">var ptit = new Array();
$(function(){
	var th = $(".top").height();
	th = 111-th;
	var wh = $(window).height()-th;
	var cw = $("#Project<?php echo ($uniqid); ?>Con").width();
	var ch = $("body").height();
	var pr = '<?php echo $page_row ?>';
	var pn = false;
	var whs = (wh-39);
	if(pr>0){
		pn = true;
	}
	$("#Project<?php echo ($uniqid); ?>").datagrid({
		//title:'项目列表',	
		height:whs,
		autoRowHeight:true,
		singleSelect:true,
		striped:true,
		rownumbers:true,
		pagination:pn,
		pageSize:pr,
		pageList:[30,50,80,100,1000],
		method:'get',
		sortName:'t1_new_pass',
		sortOrder:'asc',
		url:'__URL__/projectlist/type/<?php echo ($type); ?>/json/1',
		fitColumns:false,
		nowrap:Number('<?php echo (C("DATA_NOWRAP")); ?>'),
		selectOnCheck:false,
		checkOnSelect:true,
		onBeforeLoad: function () {  
			 if($("#ProjectCon<?php echo ($uniqid); ?> .datagrid-toolbar table tr #sersSearchProject<?php echo ($uniqid); ?>").length==0){
				 var grid = $("#ProjectCon<?php echo ($uniqid); ?> .datagrid-toolbar table tr");  
				 var date = '<td>'+$("#selectInputProject<?php echo ($uniqid); ?>").html()+'</td>';    
				 grid.append(date); 
				 $("#sersSearchProject<?php echo ($uniqid); ?>").combobox({
					 editable:false,
					 onSelect:function(q){
						$.post('__URL__/change/act/pass', {val:q.value}, function(data){
							$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
							//alert(data);
						});
					}
				 });
				 
				 $("#sersSearchClient<?php echo ($uniqid); ?>").combobox({
					url:'__ITEM__/__RUNTIME__/Data/Json/Client_data.json',
					editable:true,
					method:'get',
					valueField:'id',
					textField:'text',
					filter: function(q,r){
						var opts = $(this).combobox('options');
						var v = r[opts.textField];
						var vp = ','+String(getPinYin(v));
						var qp = ','+q.toUpperCase();
						if(vp.indexOf(qp)>=0 || v.indexOf(q) == 0){
							return r[opts.textField];
						}
					},
					onSelect:function(q){
						$.post('__URL__/change/act/client', {val:q.id}, function(data){
							$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
						});
					}
				 });
				 
				 $('#ProjectSearch<?php echo ($uniqid); ?>').searchbox({   
					searcher:function(value,name){
						$.post('__URL__/change/act/'+name+'/mode/like', {val:value}, function(data){
							$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
						});
					},   
					menu:'#ProjectSearchSon<?php echo ($uniqid); ?>',   
					prompt:'请输入关键字'  
				 }); 
			 }
		},
		/*
		onHeaderContextMenu:function(e,f){
			if(f!='contents'){
				$("#searchProject").dialog({
					title:'快速搜索',
					resizable:true,
					width:430,
					height:80,
					href:'__URL__/search/field/'+f
				});
			}
			
			e.preventDefault();
		},
		*/
		//双击点击项目列表中的一个项目
		onDblClickRow:function(e,rowIndex,rowData){
			//var se = $("#Project<?php echo ($uniqid); ?>").datagrid('getSelected')
			var se = $("#Project<?php echo ($uniqid); ?>").datagrid('getChecked');
			var se_len = se.length;
			var idd = se[0]['id'];   //项目id
			var idn = se[0]['t1_old_title']; //项目名称
			var url = '__URL__/detail1/id/'+idd;
			//alert(idd);
			var ishas = $("#rightTabs").tabs('exists',ptit[idd]); //tabs中是否存在已经打开的该项目详情页
			if(!ishas){
				$("#rightTabs").tabs('add',{
//					id : -4,
					id : idd,
					title : '项目-'+idn,
					content:'<iframe  src="' + url + '" height="100%" width="100%" frameborder="0" />',
					//href : '__URL__/detail/id/'+idd, //项目详情
					closable : true,  //详情页tabs 关闭按钮开启
				});
				//ptit = '项目-'+idn;
				ptit[idd] = '项目-'+idn;
			}else{
				//如果存在详情页，且项目详情页不等于之前打开的
				//if('项目-'+idn!=ptit){
				  if(!$.inArray('项目-'+idn, ptit)){
//					var tab = $("#rightTabs").tabs('getTab',ptit);
//					$("#rightTabs").tabs('update',{
//						tab:tab,
//						options:{
//							title : '项目-'+idn,
//							href : '__URL__/detail/id/'+idd,
//							closable : true,
//						}
//					});
//					ptit = '项目-'+idn;
//					$("#rightTabs").tabs('select',ptit);
					$("#rightTabs").tabs('add',{
						id : idd,
						title : '项目-'+idn,
						content:'<iframe src="' + url + '" height="100%" width="100%" class="easyui-tabs"  class="center-wd" />',
						//href : '__URL__/detail/id/'+idd,  //项目详情
						closable : true,  //详情页tabs 关闭按钮开启
					});
//					ptit = '项目-'+idn;
					ptit[idd] = '项目-'+idn;
				}else{
					$("#rightTabs").tabs('select',ptit[idd]);
				}
			}
		},

		onUncheck:function(i,d){
			$("#Project<?php echo ($uniqid); ?>").datagrid('unselectRow',i);
		},
		toolbar:[{
		iconCls: 'icon-add',
			text : '新增',
			handler: function(){
				$("#addProject<?php echo ($uniqid); ?>").dialog({
					title:'新增项目',
					resizable:true,
					width:850,
					height:480,
					href:'__URL__/add/act/add',
					onOpen:function(){
						cancel['Project'] = $(this);
						cancel['ProjectName'] = $("#Project<?php echo ($uniqid); ?>");
					},
					onClose:function(){
						//$(this).dialog('destroy');
						//$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
						cancel['Project'] = null;
						cancel['ProjectName'] = null;
					}
				});
			}
		},'-',{
			iconCls: 'icon-edit',
			text : '编辑',
			handler: function(){
				//var se = $("#Project<?php echo ($uniqid); ?>").datagrid('getSelected');
				var se = $("#Project<?php echo ($uniqid); ?>").datagrid('getChecked');
				var se_len = se.length;
				var idd = se[0]['id'];
				if(se_len==1){
					$("#addProject<?php echo ($uniqid); ?>").dialog({
						title:'编辑项目',
						resizable:true,
						width:850,
						height:480,
						href:'__URL__/add/act/edit/id/'+idd,
						onOpen:function(){
							cancel['Project'] = $(this);
							cancel['ProjectName'] = $("#Project<?php echo ($uniqid); ?>");
						},
						onClose:function(){
						//	$(this).dialog('destroy');
							//$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
							cancel['Project'] = null;
							cancel['ProjectName'] = null;
						}
					});
				}else if(se_len>1){
					$.messager.alert('提示','不能同时编辑两个数据！','warning');
				}
			}
		},'-',{
			iconCls: 'icon-cancel',
			text : '删除',
			handler: function(){
				var se = $("#Project<?php echo ($uniqid); ?>").datagrid('getChecked');
				var s = "";  
				for (var property in se) {  
					s = s + se[property]['id']+',' ;  
				}
				if(s){
					$.messager.confirm('提示','确定删除该项目吗！',function(r){
						if(r==true){
							$.messager.progress();
							$.post('__URL__/del', {id:s}, function(data){
								$.messager.progress('close');
								if(data==1){
									$.messager.alert('提示','删除项目成功！','info',function(){
										$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
									});
								}else if(data==0){
									$.messager.alert('提示','删除项目失败！','warning');
								}else{
									$.messager.alert('提示','您没有刪除的权限！','warning');
								}
							});
						}
					}); 	
				}
			}
		},'-',{
			iconCls: 'icon-search',
			text : '高級搜索',
			handler: function(){
				$("#searchProject<?php echo ($uniqid); ?>").dialog({
					title:'高級搜索',
					resizable:true,
					width:500,
					height:220,
					href:'__URL__/advsearch',
					onOpen:function(){
						cancel['ProjectNames'] = $("#Project<?php echo ($uniqid); ?>");
					},
					onClose:function(){
						cancel['ProjectNames'] = null;
					}
				});
			}
		},'-',{
			iconCls: 'icon-reload',
			text : '重载',
			handler: function(){
				$.get('__URL__/clear', function(data){
					$("#Project<?php echo ($uniqid); ?>Search<?php echo ($uniqid); ?>").searchbox('setValue','');
					$("#sersSearchProject<?php echo ($uniqid); ?>").combobox('setValue','');
					$("#sersSearchClient<?php echo ($uniqid); ?>").combobox('setValue','');
					$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
				});
			}
		}],
		frozenColumns:[[
			{field:'id',checkbox:true,rowspan:2},
			{field:'t1_old_code',title:'项目代码',width:70,sortable:true,rowspan:2},
			{field:'t1_old_title',title:'项目名称',width:350,sortable:true,rowspan:2}
		]],
		columns:[[ 
			{field:'t2_old_startdate',title:'计划开始日',width:90,sortable:true,rowspan:2},
			{field:'t2_old_enddate',title:'计划完成日',width:90,sortable:true,rowspan:2},
			{field:'t3_old_username',title:'负责人',width:65,sortable:true,rowspan:2},
			{field:'t1_old_uptime',title:'更新时间',width:155,sortable:true,rowspan:2},
			{field:'t1_new_pass',title:'项目进度',width:100,sortable:true,rowspan:2},
			{field:'t1_old_comple',title:'完成率',width:60,sortable:true,rowspan:2},
			{title:'<?php echo $month[13]; ?>',width:576,colspan:12,align:'center',resizable:false}
		],[
			{field:'m1',title:'<?php echo $month[1]; ?>',width:48,align:'center',resizable:false},
			{field:'m2',title:'<?php echo $month[2]; ?>',width:48,align:'center',resizable:false},
			{field:'m3',title:'<?php echo $month[3]; ?>',width:48,align:'center',resizable:false},
			{field:'m4',title:'<?php echo $month[4]; ?>',width:48,align:'center',resizable:false},
			{field:'m5',title:'<?php echo $month[5]; ?>',width:48,align:'center',resizable:false},
			{field:'m6',title:'<?php echo $month[6]; ?>',width:48,align:'center',resizable:false},
			{field:'m7',title:'<?php echo $month[7]; ?>',width:48,align:'center',resizable:false},
			{field:'m8',title:'<?php echo $month[8]; ?>',width:48,align:'center',resizable:false},
			{field:'m9',title:'<?php echo $month[9]; ?>',width:48,align:'center',resizable:false},
			{field:'m10',title:'<?php echo $month[10]; ?>',width:48,align:'center',resizable:false},
			{field:'m11',title:'<?php echo $month[11]; ?>',width:48,align:'center',resizable:false},
			{field:'m12',title:'<?php echo $month[12]; ?>',width:48,align:'center',resizable:false},
		]]
	});
	
	 var dataview = '<?php echo C("DATAGRID_VIEW") ?>';
	 if(dataview!='0'){
		var pager = $('#Project<?php echo ($uniqid); ?>').datagrid('getPager');
		pager.pagination({
			layout: 'list,sep,first,prev,sep,manual,sep,next,last,sep,refresh',
			displayMsg: '共{total}记录'
		});
	 }
	
	$("#rightTabs").tabs({
		onClose:function(t,i){
			$.ajaxSetup({  
				async : false  
			});
			if(t=='项目列表'){
				$.get('__URL__/clear', function(data){});
			}
			$.ajaxSetup({  
				async : true  
			});
		}
	});
	
	$("#rightTabs").tabs('select','项目列表');
});

function proLastMonth(){
	$(function(){
		$.get('__URL__/chgmonth/act/1', function(data){
			$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
			$.getJSON('__ACTION__/type/<?php echo ($type); ?>/json/1/method/month',function(data){
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m1',text:data[1]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m2',text:data[2]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m3',text:data[3]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m4',text:data[4]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m5',text:data[5]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m6',text:data[6]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m7',text:data[7]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m8',text:data[8]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m9',text:data[9]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m10',text:data[10]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m11',text:data[11]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m12',text:data[12]});
				$("#midMonth").html(data[14]);
			});
		});
	});
}
	
function proNextMonth(){
	$(function(){
		$.get('__URL__/chgmonth/act/2', function(data){
			$("#Project<?php echo ($uniqid); ?>").datagrid('reload');
			$.getJSON('__ACTION__/type/<?php echo ($type); ?>/json/1/method/month',function(data){
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m1',text:data[1]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m2',text:data[2]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m3',text:data[3]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m4',text:data[4]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m5',text:data[5]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m6',text:data[6]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m7',text:data[7]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m8',text:data[8]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m9',text:data[9]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m10',text:data[10]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m11',text:data[11]});
				$("#Project<?php echo ($uniqid); ?>").datagrid("setColumnTitle",{field:'m12',text:data[12]});
				$("#midMonth").html(data[14]);
			});
		});
	});
}
</script><div class="con" id="ProjectCon<?php echo ($uniqid); ?>" onselectstart="return false;" style="-moz-user-select:none;"><?php if(C('DATAGRID_VIEW')!='0'){ ?><table id="Project<?php echo ($uniqid); ?>" data-options="view:<?php echo C("DATAGRID_VIEW") ?>"></table><?php }else{ ?><table id="Project<?php echo ($uniqid); ?>"></table><?php } ?></div><div id="searchProject<?php echo ($uniqid); ?>"></div><div id="addProject<?php echo ($uniqid); ?>"></div><div id="selectInputProject<?php echo ($uniqid); ?>" style="display:none"><span class="datagrid-btn-separator-nofloat" style="margin-right:2px;"></span><select id="sersSearchProject<?php echo ($uniqid); ?>" style="margin-left:3px" ><option value="0">&nbsp;</option><option value="2">待进行</option><option value="4">进行中</option><option value="3">延误</option><option value="1">已完成</option></select><?php if($groupid != 6){ ?><span class="datagrid-btn-separator-nofloat" style="margin-right:2px;"></span><input id="sersSearchClient<?php echo ($uniqid); ?>" style="width:120px; margin-left:3px" /><?php } ?><span class="datagrid-btn-separator-nofloat"  style="margin-right:2px;"></span><input id="ProjectSearch<?php echo ($uniqid); ?>" AUTOCOMPLETE="off"></input><div id="ProjectSearchSon<?php echo ($uniqid); ?>" style="width:80px;"><div data-options="name:'t1_old_title'">项目名称</div><div data-options="name:'t1_old_code'">项目代码</div><div data-options="name:'t1_new_pass'">项目进度</div><div data-options="name:'t3_old_username'">负责人</div></div></div>