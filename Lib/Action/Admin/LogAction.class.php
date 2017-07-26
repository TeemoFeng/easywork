<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

class LogAction extends Action {
	/**
		* 主方法
		*@param $json    为NULL输出模板。为1时输出列表数据到前端，格式为Json
		*@param $method  为1时，单独输出记录数
		*@examlpe 
	*/
    public function index($json=NULL,$pid=NULL,$method=NULL){
		$Public = A('Index','Public');
		$Public->check('Log',array('r'));
		
		//main
		if(!is_int((int)$json)){
			$json = NULL;
		}
		$view = C('DATAGRID_VIEW');
		$page_row = C('PAGE_ROW');
		$groupid = $_SESSION['login']['se_groupID'];
		$comyid = $_SESSION['login']['se_comyID'];
		$comy = M('User_company_table');
		if($json==1){
			$userid = $_SESSION['login']['se_id'];
			$protype = $comy->where('id='.$comyid)->getField('type');
			if(!$userid){
				echo '';exit;
			}
			$notice = D('Log_table');
			
			/*
			$data = array(
				'user_id'=>1,
				'title'=>'测试数据',
				'content'=>'测试内容',
				'status'=>2,
				'addtime'=>'2014-12-09'
			);
			for($i=0; $i<2000000; $i++){
				$notice->add($data);
			}
			exit;
			*/
			
			$result = M();
			$Log_table = C('DB_PREFIX').'log_table';
			$Log_main = C('DB_PREFIX').'log_main_table';
			$Porject_table = C('DB_PREFIX').'project_table';
			$Task_table = C('DB_PREFIX').'task_table';
			$Linkage = C('DB_PREFIX').'linkage';
			$Reply_main = C('DB_PREFIX').'reply_main_table';
			$User_table = C('DB_PREFIX').'user_table';
			
			$map = array();
			if(cookie('aLog')){
				$str_map = slashes(cookie('aLog'));
				$map = unserialize($str_map);
				unset($str_map);
			}else{
				$map['id'] = 'id>0 and type=3';
			}
			
			if($pid){
				$map['pro_id'] = ' and pro_id='.$pid;
			}
			
			if($protype){
				$map['client_id'] = ' and client_id='.$comyid.' and views=15';
			}
			
			cookie('aTask',serialize($map));
			$map = implode(' ',$map);
			
			$get_page = $this->_get('page');
			$get_rows = $this->_get('rows');
			$page = isset($get_page) ? intval($get_page) : 1;    
			$rows = isset($get_rows) ? intval($get_rows) : $page_row; 
			$now_page = $page-1;
			$offset = $now_page*$rows;
			
			$arr_flelds = array(
				'id' => 't1.id as id',
				'type' => 't1.type as type',
				'user_id' => 't1.user_id as user_id',
				'task_id' => 't2.task_id as task_id',
				'pro_id' => 't2.pro_id as pro_id',
				'title' => 'concat_ws(\'\',t3.username,\' 于 \',t1.workdate,\' 执行了 \',t4.val,\'-\',t5.title) as title',
				'usages' => 't1.usage as usages',
				'status' => 't6.val as status',
				'proname' => 'concat_ws(\'\',\'<a href=javascript:showTab("项目-\',t7.title,\'"\,\',t7.id,\')>\',t7.title,\'</a>\') as proname',
				'client_id' => 't7.client_id as client_id',
				'views' => 't7.views as views',
				'addtime' => 't1.addtime as addtime',
				'workdate' => 't1.workdate as workdate'
			);
			$fields = implode(',',$arr_flelds);
			unset($arr_flelds);
			
			if(!$view){
				$info = $result->table($Log_table.' as t1')->field('SQL_CALC_FOUND_ROWS '.$fields)->join(' '.$Log_main.' as t2 on t2.log_id = t1.id')->join(' '.$User_table.' as t3 on t3.id = t1.user_id')->join(' right join '.$Task_table.' as t5 on t5.id = t2.task_id')->join(' '.$Linkage.' as t4 on t4.id = t5.type')->join(' '.$Linkage.' as t6 on t6.id = t1.status')->join(' right join '.$Porject_table.' as t7 on t7.id = t2.pro_id')->having($map)->order('addtime desc')->limit($offset,$rows)->select();
				$count = $result->query('SELECT FOUND_ROWS() as total');
				$count = $count[0]['total'];
			}else{
				$info = $result->table($Log_table.' as t1')->field($fields)->join(' '.$Log_main.' as t2 on t2.log_id = t1.id')->join(' '.$User_table.' as t3 on t3.id = t1.user_id')->join(' '.$Task_table.' as t5 on t5.id = t2.task_id')->join(' '.$Linkage.' as t4 on t4.id = t5.type')->join(' '.$Linkage.' as t6 on t6.id = t1.status')->join(' '.$Porject_table.' as t7 on t7.id = t2.pro_id')->having($map)->order('addtime desc')->select();
				$count = count($info);
			}
			//dump($info);exit;
			$new_info = array();
			$items = array();
			$new_info['total'] = $count;
			if($method=='total'){
				echo  json_encode($new_info); exit;
			}elseif($method=='excel'){
				if(!$view){
					$info = $result->table($Log_table.' as t1')->field($fields)->join(' '.$Log_main.' as t2 on t2.log_id = t1.id')->join(' '.$User_table.' as t3 on t3.id = t1.user_id')->join(' '.$Task_table.' as t5 on t5.id = t2.task_id')->join(' '.$Linkage.' as t4 on t4.id = t5.type')->join(' '.$Linkage.' as t6 on t6.id = t1.status')->join(' '.$Porject_table.' as t7 on t7.id = t2.pro_id')->having($map)->order('addtime desc')->select();
				}
				$char = C('CFG_CHARSET');	
				$filename = '项目：'.strip_tags($info[0]['proname']).' 操作记录';
				
				
				header("Content-type:application/octet-stream");
				header("Accept-Ranges:bytes");
				header("Content-type:application/vnd.ms-excel");  
				header("Content-Disposition:attachment;filename=".$filename.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
				//导出xls 开始
				$title = array('动态','耗时','状态','更新于');
				$title = array_iconv("UTF-8",NULL,$title);
				$title= implode("\t", $title);
				echo "$title\n";
				foreach($info as $key=>$t){
					$item = array(
						"title" => $t['title'],
						"usages" => $t['usages'],
						"status" => strip_tags($t['status']),
						"addtime" => $t['addtime'],
					);
					$data[$key]=implode("\t", array_iconv("UTF-8",NULL,$item));
				}
				echo implode("\n",$data);
				exit;
			}
			
			$new_info['rows'] = $info?$info:array();
			//dump($new_info);
			echo json_encode($new_info);
			unset($new_info,$info,$order,$sort,$count,$items);
		}else{
			$this->assign('page_row',$page_row);
			$this->display();
			unset($Public);
		}
    }
	
	/**
		* 操作日誌詳情
		*@param $id    傳入的ID
		*@examlpe 
	*/
	function logdetail($id){
		$Public = A('Index','Public');
		$Public->check('Log',array('r'));
		
		//main
		$id = intval($id);
		$Log = M('Log_table');
		$map['id'] = array('eq',$id);
		$info = $Log->field('id,description')->where($map)->find();
		$this->assign('info',$info);
		$this->assign('uniqid',uniqid());
		$this->display();
	}
	
	
	/**
		* 清除缓存
		*@examlpe 
	*/
	public function clear(){
    	cookie('aLog',NULL);
	}
	
	/**
		* 搜索
		*@examlpe 
	*/
	
	public function search(){
		$data = I();
		$map = array(
			$map['id'] = 'id>0 and type=3',
		);
		if($data['year']){
			$map['year'] = ' and YEAR(addtime)=\''.$data['year'].'\'';
		}
		if($data['month']){
			$map['month'] = ' and MONTH(addtime)=\''.$data['month'].'\'';
		}
		if($data['day']){
			$map['day'] = ' and DAY(addtime)=\''.$data['day'].'\'';
		}
		cookie('aLog',serialize($map));
	}
}