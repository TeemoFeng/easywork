<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

class UserAction extends Action {
	/**
		* 用户列表
		*@param $json    为NULL输出模板。为1时输出列表数据到前端，格式为Json
		*@param $method  为1时，单独输出记录数
		*@examlpe 
	*/
    public function index($json=NULL,$method=NULL){
		$Public = A('Index','Public');		//加载IndexPublic类
		$Public->check('User',array('r'));	//用户检查
		
		//main
		if(!is_int((int)$json)){
			$json = NULL;
		}
		$view = C('DATAGRID_VIEW');		//获取试图状态
		$page_row = C('PAGE_ROW');		//获取默认显示条数
		if($json==1){
			$get_sort = $this->_get('sort');
			$get_order = $this->_get('order');
			$sort = isset($get_sort) ? strval($get_sort) :  'username'; //，默认排序字段
			$sort = str_replace('_new_','_old_',$sort);  
			$order = isset($get_order) ? strval($get_order) : 'asc';  //默认排序
			$result = M();
			$user_table = C('DB_PREFIX').'user_table';
			$user_main = C('DB_PREFIX').'user_main_table';
			$part_table = C('DB_PREFIX').'user_part_table';
			$comy_table = C('DB_PREFIX').'user_company_table';
			$group_table = C('DB_PREFIX').'user_group_table';
			
			$map = array();
			if(cookie('user') || cookie('auser')){
				if(cookie('user')){
					$str_map = cookie('user');
					$map = unserialize($str_map);
				}else{
					$str_map = cookie('auser');
					$map = unserialize($str_map);
				}
				unset($str_map);
			}else{
				$map['id'] ="id>0";
				cookie('user',serialize($map));
			}
			
			//dump(unserialize(cookie('user')));
			$map = implode($map,' ');
			
			$get_page = $this->_get('page');
			$get_rows = $this->_get('rows');
			$page = isset($get_page) ? intval($get_page) : 1;    
			$rows = isset($get_rows) ? intval($get_rows) : $page_row; 
			$now_page = $page-1;
			$offset = $now_page*$rows;
			
			if(strstr($sort,'login_count') || strstr($sort,'id')){
				$new_order = $sort.' '.$order;
			}else{
				$new_order = 'convert('.$sort.' using gbk) '.$order;
			}
			
			$arr_flelds = array(
				'id' => 't1.id as id',
				'name' => 't1.username as username',
				'email' => 't1.email as email',
				'login_count' => 't1.login_count as login_count',
				'last_visit' => 't1.last_visit as last_visit',
				'status' => 't1.status as t1_old_status',
				'status2' => 'IF(t1.status=1,\'开启\',\'关闭\') as t1_new_status',
				'group_id' => 't5.group_id as group_id',
				'group' => 't2.name as group_name',
				'part' => 't3.name as part_name',
				'comy' => 't4.name as comy_name',
				'type' => 't4.type as type',
			);
			
			
			$fields = implode(',',$arr_flelds);
			if(!$view){//不开启视图 $view 默认为0
				$info = $result->table($user_table.' as t1')->field('SQL_CALC_FOUND_ROWS '.$fields)->join(' '.$user_main.' as t5 on t5.user_id = t1.id')->join(' '.$group_table.' as t2 on t2.id = t5.group_id')->join(' '.$part_table.' as t3 on t3.id = t5.part_id')->join(' '.$comy_table.' as t4 on t4.id = t5.company_id')->having($map)->order($new_order)->limit($offset,$rows)->select();
				$count = $result->query('SELECT FOUND_ROWS() as total');
				$count = $count[0]['total'];
			}else{//开启视图
				$info = $result->table($user_table.' as t1')->field($fields)->join(' '.$user_main.' as t5 on t5.user_id = t1.id')->join(' '.$group_table.' as t2 on t2.id = t5.group_id')->join(' '.$part_table.' as t3 on t3.id = t5.part_id')->join(' '.$comy_table.' as t4 on t4.id = t5.company_id')->having($map)->order($new_order)->select();
				$count = count($info);
			}
			//dump($info);exit;
			$new_info = array();
			$items = array();
			$new_info['total'] = $count;
			if($method=='total'){
				echo  json_encode($new_info); exit;
			}
			foreach($info as $t){
				if($t['last_visit']==0){
					$t['last_visit'] = '0000-00-00 00:00:00';
				}else{
					$t['last_visit'] = date("Y-m-d H:i:s",$t['last_visit']);
				}
				
				if($t['type']==1 && !C('MORE_COMY')){
					$t['part_name'] = $t['comy_name'].'（客户）';
				}
				
				if($t['status']==1){
					$t['status'] = '开启';
				}else{
					$t['status'] = '关闭';
				}
				
				if($t['report']==1){
					$t['report'] = '否';
				}else{
					$t['report'] = '是';
				}
				//$t['detail'] = '<a href="Admin/Task/index/'.$t["id"].'" id="detail">任务详情</a>';
				$t['detail'] = '<input type="button" id="detail" onclick="detail('.$t['id'].')" style="width:80px;height:19px;font-size:11px" id="detail" value="任务详情">';
//				$t['detail'] = '<input type="button"   style="width:80px;height:19px;font-size:11px" id="detail" value="任务详情">';
				$items[] = $t;
			}
			
			//$items = array_sort($items,$sort,$mode='nokeep',$type=$order);
			
			$new_info['rows'] = $items;
			//dump($new_info);
			echo json_encode($new_info);

			unset($new_info,$info,$comy,$order,$sort,$count,$items);
		}else{
			$this->assign('page_row',$page_row);
			$this->display();
			unset($Public);
		}
    }


	
	/**
		* 新增与更新数据
		*@param $act add为新增、edit为编辑
		*@param $go  为1时，获取post
		*@param $id  传人数据id
		*@examlpe 
	*/
	public function add($act=NULL,$go=false,$id=NULL){		
		//main
		$user = D('User_table');
		if($go==false){
			$this->assign('uniqid',uniqid());
			if($act=='add'){
				$this->assign('act','add');
				$this->display();
			}else{
				$userid = $_SESSION['login']['se_id'];
				$userid = intval($userid);
				if(!is_int((int)$id)){
					$id = NULL;
					$this->show('无法获取ID');
				}else{
					$map['id'] = array('eq',$id);
					$info = $user->relation('user_main')->where($map)->find();
					$comy = D('User_company_table');
					$type = $comy->where('id='.$info['user_main']['company_id'])->getField('type');
					if($type==1 && !C('MORE_COMY')){
						$info['user_main']['part_id'] = '100'.$info['user_main']['company_id'];
					}
					unset($map);
					//dump($info);
					$this->assign('userid',$userid);
					$this->assign('id',$id);
					$this->assign('act','edit');
					$this->assign('info',$info);
					$this->display();
					unset($info);
				}
			}	
		}else{
			$data = $user->create();
			$data['date_created'] = time();
			if($data['realname']==''){
				$data['realname'] = $data['username'];
			}
			$data['user_main'] = array(
				'part_id'=>I('part_id'),
				'company_id'=>I('company_id'),
				'group_id'=>I('group_id'),
			);
			//dump($data);exit;
			if($act=='add'){
				$Public = A('Index','Public');
				$role = $Public->check('User',array('c'));
				if($role<0){
					echo $role; exit;
				}
				
				if($data['password']){
					$oldpwd = $data['password'];
					$data['password'] = md5($data['password']);
				}else{
					$rand_pwd = randnum(6);
					$oldpwd = $rand_pwd;
					$data['password'] = md5($rand_pwd);
				}
				
				if(strstr($data['user_main']['part_id'],'100')){
					$data['user_main']['company_id'] = substr($data['user_main']['part_id'],2,strlen($data['user_main']['part_id']));
					$data['user_main']['part_id'] = 0;
				}
				
				if(C('USER_TO_MAIL')){
					$Mailer = A('Mail','Public');
					$to = $data['email'];
					$title = '号码分派通知';
					$name = $data['username'];
					$notes = $data['username'];
					$mail_cfg = $Public->MC('sys');
					$host = C('CFG_HOST');
					$contents = '<p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">您好：</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">管理員已为你分派了一个新的账号</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">账号：'.$name.' &nbsp; &nbsp; &nbsp; &nbsp;密码：'.$oldpwd.'</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">登录地址：</span><a target="_blank" href="'.$host.'">'.$host.'</a></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">此邮件由系統自动发送，请不要回复，如有问题，请联系系統管理员！</span></p>';
					$send = $Mailer->set($title,$contents,$mail_cfg);
					$Mailer->mailObj->AddAddress($to, $notes);
					$send = $Mailer->mailObj->send();
					$Mailer->mailObj->ClearAddresses();
					if($send==1){
						$mail = 1;
					}else{
						$mail = $Mailer->mailObj->ErrorInfo;
					}
					$Mailer->mailObj->ClearAddresses();
				}else{
					$mail = 1;
				}
				if($mail==1){
					$add = $user->relation(true)->add($data);
					if($add>0){
						echo 1;
						$this->json(NULL);
					}else{
						echo 0;
					}
				}else{
					echo 2;
				}
				unset($data,$Public);
			}elseif($act=='edit'){
				$Public = A('Index','Public');
				$role = $Public->check('User',array('u'));
				if($role<0){
					echo $role; exit;
				}
				
				if(!is_int((int)$id)){
					echo 0;
				}else{
					if($data['password']){
						$data['password'] = md5($data['password']);
					}else{
						unset($data['password']);
					}
					
					if(strstr($data['user_main']['part_id'],'100')){
						$data['user_main']['company_id'] = substr($data['user_main']['part_id'],2,strlen($data['user_main']['part_id']));
						$data['user_main']['part_id'] = 0;
					}
					
					$map['id'] = array('eq',$id);
					$edit = $user->relation(true)->where($map)->save($data);
					unset($map);
					if($edit !== false){
						$this->json(NULL);
						echo 1;
					}else{
						echo 0;
					}
					unset($data,$Public);
				}
			}
		}
		unset($user);
	}
	
	
	/**
		* 删除数据
		*@examlpe 
	*/
	public function del(){
		$Public = A('Index','Public');
		$role = $Public->check('User',array('d'));
		if($role<0){
			echo $role; exit;
		}
		
		//main
		$str_id = I('id');
		$str_id = strval($str_id);
		$str_id = substr($str_id,0,-1);
		$arr_id = explode(',',$str_id);
		$user = M('User_table');
		$pass = 0;$fail = 0;
		foreach($arr_id as $id){
			$map['id'] = array('eq',$id);
			$del = $user->where($map)->delete();
			if($del){
				$pass++;
			}else{
				$fail++;
			}
		}
		unset($map,$str_id,$arr_id);
		if($pass==0){
			echo 0;
		}else{
			$this->json(NULL);
			echo 1;
		}
		$pass = 0; $fail = 0;
		unset($user,$Public);
	}
	
	/**
		* 更改用户密码
		*@param $go  为1时，获取post
		*@param $id  传人数据id
		*@examlpe 
	*/
	public function repwd($id,$go=false){		
		//main
		$user = D('User_table');
		if(!$go){
			if(!is_int((int)$id)){
				$id = NULL;
				$this->show('无法获取ID');
			}else{
				$map['id'] = array('eq',$id);
				$info = $user->relation(true)->where($map)->find();
				unset($map);
				$this->assign('id',$id);
				$this->assign('info',$info);
				$this->display();
				unset($info);
			}		
		}else{
			$data = $user->create();
			if(!is_int((int)$id)){
				echo 0;
			}else{
				$pwd2 = I('password2');
				if($data['password']!=$pwd2){
					echo -1;
				}else{
					$data['password'] = md5($data['password']);
					$map['id'] = array('eq',$id);
					$edit = $user->where($map)->save($data);
					unset($map);
					if($edit !== false){
						echo 1;
					}else{
						echo 0;
					}
				}
			}
			unset($data);
		}
		unset($user);	
	}
	
	/**
		* 设置邮箱密码
		*@param $go  为1时，获取post
		*@param $id  传人数据id
		*@examlpe 
	*/
	public function setpwd($id,$go=false){		
		//main
		$user = D('User_table');
		$comy = D('User_company_table');
		if(!$go){
			if(!is_int((int)$id)){
				$id = NULL;
				$this->show('无法获取ID');
			}else{
				$map['id'] = array('eq',$id);
				$info = $user->relation(true)->where($map)->find();
				$cinfo = $comy->where('id='.$info['user_main']['company_id'])->find();
				if(C('MAIL_OF_USER') || $cinfo['type']==1){
					if(!$info['smtp']){
						if(C('MORE_COMY')){
							$info['smtp'] = $cinfo['smtp'];
							$info['ssl'] = $cinfo['ssl'];
							$info['port'] = $cinfo['port'];
						}else{
							$info['smtp'] = C('MAIL_SMTP_SEAVER');
							$info['ssl'] = C('MAIL_SMTP_SSL');
							$info['port'] = C('MAIL_SMTP_PORT');
						}
					}
				}else{
					if($id>1 || ($id==1 && !$info['smtp'])){
						if(C('MORE_COMY')){
							$info['smtp'] = $cinfo['smtp'];
							$info['ssl'] = $cinfo['ssl'];
							$info['port'] = $cinfo['port'];
						}else{
							$info['smtp'] = C('MAIL_SMTP_SEAVER');
							$info['ssl'] = C('MAIL_SMTP_SSL');
							$info['port'] = C('MAIL_SMTP_PORT');
						}
					}
				}
				unset($map);
				$this->assign('id',$id);
				$this->assign('info',$info);
				$this->display();
				unset($info);
			}		
		}else{
			if(!is_int((int)$id)){
				echo 0;
			}else{
				$map['id'] = array('eq',$id);
				$info = $user->relation(true)->where($map)->find();
				$cinfo = $comy->where('id='.$info['user_main']['company_id'])->find();
				//dump($cinfo);
				$email = I('email');
				if(C('MAIL_OF_USER') || $cinfo['type']==1){
					$smtp = I('smtp');
					$ssl = I('ssl');
					$port = I('port');
				}
				$MailPwd2 = I('MailPwd2');
				$MailPwd = I('MailPwd');
				if($MailPwd!=$MailPwd2){
					echo -1;
				}else{
					$data['email'] = $email;
					$data['MailPwd'] = $MailPwd;
					if(C('MAIL_OF_USER') || $cinfo['type']==1){			
						$data['smtp'] = $smtp;
						$data['ssl'] = $ssl;
						$data['port'] = $port;
					}else{
						if($id==1){
							$data['smtp'] = $smtp;
							$data['ssl'] = $ssl;
							$data['port'] = $port;
						}
					}
					//dump($data);
					$edit = $user->where($map)->save($data);
					unset($map);
					if($edit !== false){
						echo 1;
					}else{
						echo 0;
					}
				}
			}
			unset($data);
		}
		unset($user);	
	}
	
	//无效方法
	public function setmail(){		
		//main
		$user = D('User_table');
		$mailpwd = I('mailpwd');
		$userid = I('id');
		$mailpwd = strval($mailpwd);
		$data = array(
			'MailPwd'=>$mailpwd
		);
		$edit = $user->where('id='.$userid)->save($data);
		if($edit==1){
			echo 1;
		}else{
			echo 0;
		}
		unset($user,$data);	
	}
	
	
	/**
		* 重置用户密码
		*@param $id  传人数据id
		*@examlpe 
	*/
	public function rspwd($id){
		$Public = 	A('Index','Public');
		$Mailer = A('Mail','Public');
			
		//main
		$user = D('User_table');
		if(!is_int((int)$id)){
			echo 0;
		}else{
			$rand_pwd = randnum(6);
			$data['password'] = md5($rand_pwd);
			$map['id'] = array('eq',$id);
			$info = $user->where($map)->find();
			$edit = $user->where($map)->save($data);
			
			if($edit !== false){
				$to = $info['email'];
				$title = '重置密码通知';
				$name = $info['username'];
				$notes = 'Dear '.$info['username'];
				$mail_cfg = $Public->MC('sys');
				$host = C('CFG_HOST');
				$contents = '<p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">您好：</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">您在项目管理系統的密码已被重置</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">账号：'.$name.' &nbsp; &nbsp; &nbsp; &nbsp;密码：'.$rand_pwd.'</span></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">登錄地址：</span><a target="_blank" href="'.$host.'">'.$host.'</a></p><p><span style="color: rgb(51, 51, 51); font-family: verdana, Tahoma, Arial, 宋体, sans-serif; font-size: 14px; ">此邮件由系统自动发送，请不要回复，如有问题请联系系统管理员！</span></p>';
				$send = $Mailer->set($title,$contents,$mail_cfg);
				$Mailer->mailObj->AddAddress($to, $notes);
				$send = $Mailer->mailObj->send();
				$Mailer->mailObj->ClearAddresses();
				unset($Mailer,$m_cfg,$notes,$name,$to,$title,$contents,$data);
				if($send==1){
					echo 1;
				}else{
					$data['password'] = $info['password'];
					$map['id'] = array('eq',$id);
					$edit = $user->where($map)->save($data);
					echo 2;
				}
			}else{
				echo 0;
			}
		}
		unset($data,$user,$map,$info);
	}
	
	/**
		* 高级搜索
		*@param $act   为1时，获取post
		*@examlpe 
	*/
	public function advsearch($act=NULL){
		$App = A('App','Public');
			
		//main
		$field = strval($field);
		if($act==1){
			$field = I('field');
			$mod = I('mod');
			$keyword = I('keys');	
			$type = I('type');
			array_pop($field); array_pop($mod); array_pop($keyword); array_pop($type);
			
			$del = array_pop($type);
			
			$arr = array();
			$num = 0;
			$map['id'] ='id>0';
			foreach($field as $key=>$val){
				if($mod[$key]=='like' || $mod[$key]=='notlike'){
					$keyword[$key] = '%'.$keyword[$key].'%';
				}
				$tt = trim($type[$key]);
				$n = $key+1;
				$l = $key-1;
				$nt = trim($type[$n]);
				$lt = trim($type[$l]);
				$lf = $field[$l];
				$step = 1;
				
				if($val==$lf){
					$str = $val.$step;
					$step++;
				}else{
					$str = $val;
				}
				
				if($tt=='OR'){
					if($keyword[$key]){
						$mod[$key] = htmlspecialchars_decode($mod[$key]);
						$arr[$num]['k'][] = $val;
						$arr[$num]['v'][] = $val." ".$mod[$key]." '".$keyword[$key]."'";
					}
					if($nt=='AND'){
						$mod[$n] = htmlspecialchars_decode($mod[$n]);
						if($mod[$n]=='like' || $mod[$n]=='notlike'){
							$keyword[$n] = '%'.$keyword[$n].'%';
						}
						if($keyword[$n]){
							$arr[$num]['k'][] = $val;
							$arr[$num]['v'][] = $val." ".$mod[$n]." '".$keyword[$n]."'";
						}
						$num++;
					}
				}else{
					if($lt!='OR' && $tt=='AND'){
						$mod[$key] = htmlspecialchars_decode($mod[$key]);
						if($keyword[$key]){
							$map[$str] = ' and '.$val." ".$mod[$key]." '".$keyword[$key]."'";
						}
					}
				}
				
				if(!isset($type[$key]) && $lt=='OR'){
					$mod[$key] = htmlspecialchars_decode($mod[$key]);
					if($keyword[$key]){
						$arr[$num]['k'][] = $val;
						$arr[$num]['v'][] = $val." ".$mod[$key]." '".$keyword[$key]."'";
					}
				}else{
					if(!isset($type[$key]) && $lt!='OR'){
						$mod[$key] = htmlspecialchars_decode($mod[$key]);
						if($keyword[$key]){
							$map[$str] = ' and '.$val." ".$mod[$key]." '".$keyword[$key]."'";
						}
					}
				}
			}
			$num = 0;
			unset($key,$val,$ntable,$table,$field,$mod,$type,$keyword);
			
			foreach($arr as $key=>$val){
				$str = $val['k'][0];
				for($i=0;$i<count($val['v']);$i++){
					if($i==0){
						$map[$str] .= ' and ('.$val['v'][$i];
					}elseif($i==count($val['v'])-1){
						$map[$str] .= ' or '.$val['v'][$i].')';
					}else{
						$map[$str] .= ' or '.$val['v'][$i];
					}
				}	
			}
			unset($arr);
			
			cookie('user',NULL);
			cookie('auser',serialize($map));
			echo 1;
			unset($map);
		}else{
			$this->assign('uniqid',uniqid());
			$this->assign('field',$field);
			$this->display();
		}	
	}
	
	
	/**
		* 清空所以搜索产生的cookies
		*@examlpe 
	*/
	public function clear(){
    	cookie('user',NULL);
		cookie('auser',NULL);
	}
	
	/**
		* 生成json文件
		*@param $back  为1时，返回数据
		*@examlpe 
	*/
	public function json($back=1){
		$Write = A('Write','Public');
		import('ORG.Net.FileSystem');
		$sys = new FileSystem();
	
		//main
    	$temp_path = RUNTIME_PATH.'/Temp/';
		if(file_exists($temp_path)){
			$dt = $sys->delFile($temp_path);
		}
		$result = M();
		$user = M('User_table');
		$group = M('User_group_table');
		$user_table = C('DB_PREFIX').'user_table';
		$main_table = C('DB_PREFIX').'user_main_table';
		$path = RUNTIME_PATH.'Data/Json';
		
		$ginfo = $group->field('CONCAT(\'top_\',id) as id,name as text,\'open\' as state')->where('status=1 or id=1')->order('access desc')->select();
		$infos = $result->table($user_table.' as t1')->field('t1.id,t1.username as text,t2.group_id')->join(' join '.$main_table.' as t2 on t1.id=t2.user_id')->where('t1.status=1')->order('convert(text using gbk) asc')->select();
		$new_info = array();
		foreach($ginfo as $k=>$t){
			$gid = str_replace('top_','',$t['id']);
			$infos = $result->table($user_table.' as t1')->field('t1.id,t1.username as text,t2.group_id')->join(' join '.$main_table.' as t2 on t1.id=t2.user_id')->where('t1.status=1 and t2.group_id='.$gid)->order('convert(text using gbk) asc')->select();
			$ginfo[$k]['children'] = $infos;
		}
		$json_data = json_encode($ginfo);
		$put_json5 = $Write->write($path,$json_data,'User_tree_data');
		
		$info = $user->field('id,username as text')->where('status=1')->order('convert(text using gbk) asc')->select();
		//array_unshift($info,$head);
		$json_data = json_encode($info);
		//dump($info);
		$path = RUNTIME_PATH.'Data/Json';
		$put_json = $Write->write($path,$json_data,'User_data');
		
		$info = $user->field('id as id,username as text')->where('status=1')->order('convert(text using gbk) asc')->select();
		$head = array(
			'id'=>0,
			'text'=>'无'
		);
		array_unshift($info,$head);
		$json_data = json_encode($info);
		$put_json2 = $Write->write($path,$json_data,'User_2_data');
		
		$info = $user->field('username as id,username as text')->where('status=1')->order('convert(text using gbk) asc')->select();
		$json_data = json_encode($info);
		$put_json4 = $Write->write($path,$json_data,'User_name_data');
		
		$info = $user->field('id,username as text')->where('status=1 and id<>1')->order('convert(text using gbk) asc')->select();
		//array_unshift($info,$head);
		$json_data = json_encode($info);
		$put_json3 = $Write->write($path,$json_data,'User_noadmin_data');
		
		if($back==1){
			if($put_json){
				echo 1;
			}else{
				echo 0;
			}
		}
		unset($info,$json_data,$path,$Loop,$Write,$sys);
	}
	
	/**
		* 工具栏搜索控制
		*@param $act  传入的字段名
		*@examlpe 
	*/
	public function change($act){
		$val = I('val');
		
		if(strstr($val,'top_')){
			$val = str_replace('top_','',$val);
			$map['id'] ="id>0";
			$map['group_id'] = ' and group_id='.$val;
		}else{
			$map['id'] = 'id='.$val;
		}
		cookie('user',serialize($map));
	}
	
	/**
	 *新增点击任务详情 显示当前用户的任务进度情况
	 * @param $id 所传递的用户id 
	 */
	public function tasklist($id,$type=0,$json=NULL,$method=NULL){
		$Public = A('Index','Public');
		$role = $Public->check('Task',array('r'));
		$App = A('App','Public');

		//main
		if(!is_int((int)$json)){
			$json = NULL;
		}

//		$userid = $_SESSION['login']['se_id'];
		$userid = $id; //用户id
		//dump($type);exit;
//		$groupid = $_SESSION['login']['se_groupID'];
		$users = D('User_table');
		$fields = array(
			'id'=>$userid,

		);
		$info = $users->relation(true)->where($fields)->find();
//		dump($info);exit;
		$groupid = $info['user_main']['group_id'];
//		$comyid = $_SESSION['login']['se_comyID'];
		$comyid = $info['user_main']['company_id'];
		$comy = M('User_company_table');
		$protype = $comy->where('id='.$comyid)->getField('type');
//		if(cookie('proWeek') && cookie('nowweek')){
//			$nowweeks = cookie('nowweek');
//			if(cookie('proWeek')==1){
//				$nowweeks = strtotime("-1 week",$nowweeks);
//			}elseif(cookie('proWeek')==2){
//				$nowweeks = strtotime("+1 week",$nowweeks);
//			}
//			cookie('nowweek',$nowweeks);
//		}else{
//			$nowweeks = time();
//			cookie('nowweek',$nowweeks);   //如果cookie中没有存入时间将当前时间存入cookie
//		}

		if(cookie('tWeek') && cookie('nowweeks')){
			$nowweeks = cookie('nowweeks');
			if(cookie('tWeek')==1){
				$nowweeks = strtotime("-1 week",$nowweeks);
			}elseif(cookie('tWeek')==2){
				$nowweeks = strtotime("+1 week",$nowweeks);
			}
			cookie('nowweeks',$nowweeks);
		}else{
			$nowweeks = time();
			cookie('nowweeks',$nowweeks); //第一次没有存储nowweeks的时候 存储当前时间
		}

		$nowweek = date("w");  //今天是周几
		if($nowweek>0){
			$minweek = date("Y-m-d",strtotime("last week sunday",$nowweeks));
			$maxweek = date("Y-m-d",strtotime("this week saturday",$nowweeks));
			$mintime = strtotime("last week sunday",$nowweeks);
		}else{
			$minweek = date("Y-m-d",strtotime("this week sunday",$nowweeks));
			$maxweek = date("Y-m-d",strtotime("this week saturday",$nowweeks));
			$mintime = strtotime("this week sunday",$nowweeks);
		}

		$zh_week = array(
			0=>'星期日',1=>'星期一',2=>'星期二',3=>'星期三',4=>'星期四',5=>'星期五',6=>'星期六'
		);

		$arr_week = array(1=>date("Y-m-d",strtotime("this week sunday",$mintime)),2=>date("Y-m-d",strtotime("this week monday",$mintime)),3=>date("Y-m-d",strtotime("this week tuesday",$mintime)),4=>date("Y-m-d",strtotime("this week wednesday",$mintime)),5=>date("Y-m-d",strtotime("this week thursday",$mintime)),6=>date("Y-m-d",strtotime("this week friday",$mintime)),7=>date("Y-m-d",strtotime("this week saturday",$mintime)));
		$arr_w = array(1=>strtotime("this week sunday",$mintime),2=>strtotime("this week monday",$mintime),3=>strtotime("this week tuesday",$mintime),4=>strtotime("this week wednesday",$mintime),5=>strtotime("this week thursday",$mintime),6=>strtotime("this week friday",$mintime),7=>strtotime("this week saturday",$mintime)); //算出当前本周7天时间

		//dump($arr_week);
		$week[1] = $zh_week['0'].' '.date("m/d",$arr_w[1]);
		$week[2] = $zh_week['1'].' '.date("m/d",$arr_w[2]);
		$week[3] = $zh_week['2'].' '.date("m/d",$arr_w[3]);
		$week[4] = $zh_week['3'].' '.date("m/d",$arr_w[4]);
		$week[5] = $zh_week['4'].' '.date("m/d",$arr_w[5]);
		$week[6] = $zh_week['5'].' '.date("m/d",$arr_w[6]);
		$week[7] = $zh_week['6'].' '.date("m/d",$arr_w[7]);
		$week[8] = '<span class="lastmon1"><a href="javascript:void(0);" id="workToLasts" class="font1_color">上一周</a></span><span class="minmon" id="midWeeks">'.$minweek.' 至 '.$maxweek.'</span><span class="nextmon1"><a href="javascript:void(0);" id="workToNexts" class="font1_color">下一周</a></span>';
		$week[9] = $minweek.' 至 '.$maxweek;

		if($method=='week'){
			echo  json_encode($week); exit; //如果是选择上下周 返回json数据
		}

		//dump($week);
		$view = C('DATAGRID_VIEW'); //默认为0
		$page_row = C('PAGE_ROW');
		if($json==1){
			$userid = $id;

			$userid = intval($userid);
			if(!$userid){
				echo '';exit;
			}
			$task = D('Task_table');

			/*
			$data = array(
				'user_id'=>1,
				'title'=>'测试数据',
				'content'=>'测试内容',
				'status'=>2,
				'addtime'=>'2014-12-09'
			);
			for($i=0; $i<2000000; $i++){
				$project->add($data);
			}
			exit;
			*/

			$get_sort = $this->_get('sort');
			$get_order = $this->_get('order');
			$sort = isset($get_sort) ? strval($get_sort) : 't1_old_uptime';
			$sort = str_replace('_new_','_old_',$sort);
			$order = isset($get_order) ? strval($get_order) : 'desc';
			$result = M();
			$Task_main = M('task_main_table');
			$Task_table = C('DB_PREFIX').'task_table';
			$Worklog_table = C('DB_PREFIX').'worklog_table';
			$user_table = C('DB_PREFIX').'user_table';
			$project_table = C('DB_PREFIX').'project_table';
			$linkage = C('DB_PREFIX').'linkage';

			$map = array();


				$map['id'] = 'id>0';
				//$map['uptime'] = ' and YEAR(t1_old_uptime)=\''.date("Y").'\' and MONTH(t1_old_uptime)=\''.date("m").'\'';


			if($protype){ //如果是user_company_table 公司表
				$map['client_id'] = ' and client_id='.$comyid.' and views=15';
			}else{
				if($type==1){
					//指派给该用户的任务
					$map['type_id'] = ' and t1_old_to_id='.$userid;
				}elseif($type==2){
					//该用户派发的任务
					$map['type_id'] = ' and t1_old_from_id='.$userid;
				}elseif($type==3){
					$map['type_id'] = ' and t1_old_from_id='.$userid.' and `check`=0';
				}else{
					//这个查的是所有任务
					if($role=='all' || in_array('a',$role)){
						unset($map['type_id']);
					}else{
						$map['type_id'] = ' and (t1_old_to_id='.$userid.' or t1_old_from_id='.$userid.' or t1_old_pm_id='.$userid.')';
					}
				}
			}

			cookie('type',$type);
			$map = implode(' ',$map);

			//dump(unserialize(cookie('aTask')));exit;
			$get_page = $this->_get('page');
			$get_rows = $this->_get('rows');
			$page = isset($get_page) ? intval($get_page) : 1;
			$rows = isset($get_rows) ? intval($get_rows) : $page_row;
			$now_page = $page-1;
			$offset = $now_page*$rows;

			$sql1 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[1].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql2 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[2].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql3 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[3].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql4 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[4].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql5 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[5].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql6 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[6].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql7 = $result->table($Worklog_table.' as tt1')->field('concat_ws(\'\',\'<div class=\"wt\" onclick=\"getDetailWork(\',tt1.id,\')\"><span class=\"wl\">\',tt2.val,\'</span><span class=\"wr\">\',ROUND(tt1.worktime,'.C('CFG_NUM').'),\'<span></div>\')')->where('tt1.task_id=t1.id and tt1.addtime=\''.$arr_week[7].'\'')->join(' '.$linkage.' as tt2 on tt2.id = tt1.status')->select(false);
			$sql_time = $result->table($Worklog_table.' as tt1')->field('ROUND(SUM(tt1.worktime),'.C('CFG_NUM').')')->where('tt1.task_id=t1.id')->select(false);

			$arr_flelds = array(
				'id' => 't1.id as id',
				'title' => 't1.title as t1_old_title',
				'pro_id' => 't1.pro_id as t1_old_pro_id',
				'proname' => 't6.title as t1_old_proname',
				'client_id' => 't6.client_id as client_id',
				'views' => 't6.views as views',
				'pm_id' => 't6.pm_id as t1_old_pm_id',
				'to_id' => 't1.to_id as t1_old_to_id',
				'from_id' => 't1.from_id as t1_old_from_id',
				'check' => 't1.check as t1_old_check',
				'username1'=>'t7.username as t7_old_fromname',
				'username' => 't2.username as t2_old_username',
				'type' => 't1.type as t1_old_type',
				'level' => 't4.sort as t1_old_level',
				'level2' => 't4.val as t1_new_level',
				'level3' => 't1.level as level',
				'degree' => 't5.sort as t1_old_degree',
				'degree2' => 't5.val as t1_new_degree',
				'degree3' => 't1.degree as degree',
				'status' => 't3.sort as t1_old_status',
				'status2' => 't3.val as t1_new_status',
				'status3' => 't1.status as status',
				'startdate' => 't1.startdate as t1_old_startdate',
				'enddate' => 't1.enddate as t1_old_enddate',
				'plantime' => 'round(t1.plantime,'.C('CFG_NUM').') as t1_old_plantime',
				'realtime' => $sql_time.' as t1_new_realtime',
				'uptime' => 't1.uptime as t1_old_uptime',
				'concat' => 'CONCAT_WS(\' \',coalesce('.$sql1.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[1].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w1,(coalesce('.$sql2.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[2].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w2,(coalesce('.$sql3.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[3].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w3,(coalesce('.$sql4.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[4].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w4,(coalesce('.$sql5.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[5].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w5,(coalesce('.$sql6.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[6].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w6,(coalesce('.$sql7.',concat(\'<div class=\"wt\" onclick=getAddWork(\"'.$arr_week[7].'\"\,\',t1.id,\'\,\',t6.id,\')>&nbsp;</div>\'))) as w7',
				'pass' => 'CASE WHEN t1.status=51 THEN \'<div style="background-color: #83a6fe; width:100%; text-align:center;">已完成</div>\' WHEN t1.status=9 THEN \'<div style="background-color: #ab4cab; width:100%; text-align:center;">待进行</div>\' WHEN TO_DAYS(NOW())>TO_DAYS(t1.enddate) THEN \'<div style="background-color: #FE4B3D; width:100%; text-align:center;">延误</div>\' ELSE \'<div style="background-color: #3DFE42; width:100%; text-align:center;">进行中</div>\' END as t1_old_pass',
			);
			$fields = implode(',',$arr_flelds);
			unset($arr_flelds);
			/**
			 * t1 task_table 任务表
			 * t2 user_table 用户表
			 * t3 linkage    联动表 t3的id 对应 任务表的 status (任务状态)
			 *               t3的id 对应 任务表的 level (优先级)
			 * 				 t3的id 对应 任务表的 degree (严重程度)
			 * t6 project_table id对应任务表的pro_id
			 */
			if(!$view){
				$info = $result->table($Task_table.' as t1')->field('SQL_CALC_FOUND_ROWS '.$fields)->join(' '.$user_table.' as t2 on t2.id = t1.to_id')->join(' '.$linkage.' as t3 on t3.id = t1.status')->join(' '.$linkage.' as t4 on t4.id = t1.level')->join(' '.$linkage.' as t5 on t5.id = t1.degree')->join(' '.$project_table.' as t6 on t6.id = t1.pro_id')->join(' '.$user_table.' as t7 on t7.id = t1.from_id')->having($map)->order($sort.' '.$order)->limit($offset,$rows)->select();
				$count = $result->query('SELECT FOUND_ROWS() as total');
				$count = $count[0]['total'];
			}else{
				$info = $result->table($Task_table.' as t1')->field($fields)->join(' '.$user_table.' as t2 on t2.id = t1.to_id')->join(' '.$linkage.' as t3 on t3.id = t1.status')->join(' '.$linkage.' as t4 on t4.id = t1.level')->join(' '.$linkage.' as t5 on t5.id = t1.degree')->join(' '.$project_table.' as t6 on t6.id = t1.pro_id')->join(' '.$user_table.' as t7 on t7.id = t1.from_id')->having($map)->order($sort.' '.$order)->select();
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
					$info = $result->table($Task_table.' as t1')->field($fields)->join(' '.$user_table.' as t2 on t2.id = t1.to_id')->join(' '.$linkage.' as t3 on t3.id = t1.status')->join(' '.$linkage.' as t4 on t4.id = t1.level')->join(' '.$linkage.' as t5 on t5.id = t1.degree')->join(' '.$project_table.' as t6 on t6.id = t1.pro_id')->having($map)->order($sort.' '.$order)->select();
				}
				$char = C('CFG_CHARSET');
				if($type==1){
					$filename = '指派給我的任务-'.date("Ymd",time());
				}elseif($type==2){
					$filename = '来自我的任务-'.date("Ymd",time());
				}elseif($type==3){
					$filename = '待我审核的任务-'.date("Ymd",time());
				}else{
					$filename = '所有任务-'.date("Ymd",time());
				}


				header("Content-type:application/octet-stream");
				header("Accept-Ranges:bytes");
				header("Content-type:application/vnd.ms-excel");
				header("Content-Disposition:attachment;filename=".$filename.".xls");
				header("Pragma: no-cache");
				header("Expires: 0");
				//导出xls 开始
				$title = array('任务名称','指派给','任务状态','优先级','严重程度','计划开始','计划完成','任务进度','计划用时','已用工时','所属项目','更新时间');
				$title = array_iconv("UTF-8",NULL,$title);
				$title= implode("\t", $title);
				echo "$title\n";
				foreach($info as $key=>$t){
					$item = array(
						"t1_old_title" => $t['t1_old_title'],
						"t2_old_username" => $t['t2_old_username'],
						"t1_new_status" => strip_tags($t['t1_new_status']),
						"t1_new_level" => $t['t1_new_level'],
						"t1_new_degree" => $t['t1_new_degree'],
						"t1_old_startdate" => $t['t1_old_startdate'],
						"t1_old_enddate" => $t['t1_old_enddate'],
						"t1_old_pass" => strip_tags($t['t1_old_pass']),
						"t1_old_plantime" => $t['t1_old_plantime'],
						"t1_new_realtime" => $t['t1_new_realtime'],
						"t1_old_proname" => $t['t1_old_proname'],
						"t1_old_uptime" =>  $t['t1_old_uptime'],
					);
					$data[$key]=implode("\t", array_iconv("UTF-8",NULL,$item));
				}
				echo implode("\n",$data);
				exit;
			}

			$new_info['rows'] = $info?$info:array();
			//dump($new_info);exit;
			echo json_encode($new_info);
			unset($new_info,$info,$order,$sort,$count,$items);
		}else{
			$year = array(
				date("Y",strtotime("-5 year")),date("Y",strtotime("-4 year")),date("Y",strtotime("-3 year")),date("Y",strtotime("-2 year")),date("Y",strtotime("-1 year")),date("Y"),date("Y",strtotime("+1 year")),date("Y",strtotime("+2 year")),date("Y",strtotime("+3 year")),date("Y",strtotime("+4 year")),date("Y",strtotime("+5 year")),date("Y",strtotime("+6 year")),
			);

			$status = $App->getJson('renwuzhuangtai','/Linkage');
			$types = $App->getJson('renwuleixing','/Linkage');
			$level = $App->getJson('youxianji','/Linkage');
			$degree = $App->getJson('yanzhongchengdu','/Linkage');

			$this->assign('nowyear',date("Y"));
			$this->assign('nowmonth',date("m"));
			$this->assign('year',$year);
			$this->assign('protype',$protype);
			$this->assign('status',$status);
			$this->assign('types',$types);
			$this->assign('level',$level);
			$this->assign('degree',$degree);
			$this->assign('week',$week);
			$this->assign('type',$type);
			$this->assign('uniqid',uniqid());
			$this->assign('page_row',$page_row);
			$this->assign('id',$id);
			$this->display();  //展示模板传递参数
			unset($Public);
		}
	}

	/**
	 * 任务列表首页
	 */
	public function taskindex($id){
		$Public = A('Index','Public');
		$Public->check('Task',array('r'));
		$App = A('App','Public');
		import('ORG.Net.FileSystem');
		$sys = new FileSystem();
		$sys->root = ITEM;
		$sys->charset = C('CFG_CHARSET');

		//main
		$path = CONF_PATH.'version.txt';
		$ver = $sys->getFile($path);
		$ver = preg_replace("/;[\r\n]/iu",";\n",$ver);
		$arr_ver = explode(";\n",$ver);
		$arr_ver = array_filter($arr_ver);
		$result = M();
		$notice = M('Notice_table');
		$Project_table = C('DB_PREFIX').'project_table';
		$Task_table = C('DB_PREFIX').'task_table';
		$Task_main = C('DB_PREFIX').'task_main_table';
		$Project_baseinfo = C('DB_PREFIX').'project_baseinfo_table';
		$userid = $id;
		$users = D('User_table');
		$fields = array(
			'id'=>$userid,

		);
		$info = $users->relation(true)->where($fields)->find();
//		dump($info);exit;
		$groupid = $info['user_main']['group_id'];
//		$comyid = $_SESSION['login']['se_comyID'];
		$comyid = $info['user_main']['company_id'];
		$username = $info['username'];

		$comy = M('User_company_table');
		$protype = $comy->where('id='.$comyid)->getField('type');

		$sql = $result->table($Task_main.' as tt1')->field('tt1.task_id as id')->where('tt1.pro_id=t1.id')->select(false);
		$count = $result->table($Task_main.' as tt5')->field('count(tt5.id) as total')->where('tt5.pro_id=t1.id')->select(false);
		$comple = $result->table($Task_table.' as tt4')->field('count(tt4.id) as comple')->where('tt4.id IN('.$sql.') and tt4.status=51')->select(false);
		$ids = $result->table($Task_table.' as tt3')->field('pro_id as id')->where('TO_DAYS(NOW())>TO_DAYS(tt3.enddate)')->select(false);
		$cinfo = $result->table($Project_table.' as t1')->where('round('.$comple.'/'.$count.'*100,0)=100')->getField('count(id)');
		$uinfo = $result->table($Project_table.' as t1')->where('round('.$comple.'/'.$count.'*100,0)<100')->getField('count(id)');
		$tinfo = $result->table($Project_table.' as t1')->where('id in ('.$ids.') and round('.$comple.'/'.$count.'*100,0)<100')->getField('count(id)');
		$ninfo = $notice->where('status>0')->order('status asc,addtime desc')->select();
		$task_status = $App->getJson('renwuzhuangtai','/Linkage');
		$this->assign('userid',$userid);
		$this->assign('ninfo',$ninfo);
		$this->assign('protype',$protype);
		$this->assign('comple',$cinfo);
		$this->assign('un_comple',$uinfo);
		$this->assign('old',$tinfo);
		$this->assign('ver',$arr_ver);
		$this->assign('task_status',$task_status);
		$this->assign('username',$username);
		$this->assign('app',$App);
		$this->display();
		unset($Public);
	}

//	public function search(){
//		$data = I();
//		$map = array(
//			'id'=>'id>0'
//		);
//		if($data['year']){
//			$map['year'] = ' and YEAR(t1_old_uptime)=\''.$data['year'].'\'';
//		}
//		if($data['month']){
//			$map['month'] = ' and MONTH(t1_old_uptime)=\''.$data['month'].'\'';
//		}
//		if($data['type']){
//			$map['type'] = ' and t1_old_type=\''.$data['type'].'\'';
//		}
//		if($data['status']){
//			$map['status'] = ' and status=\''.$data['status'].'\'';
//		}
//		if($data['level']){
//			$map['level'] = ' and level=\''.$data['level'].'\'';
//		}
//		if($data['degree']){
//			$map['degree'] = ' and degree=\''.$data['degree'].'\'';
//		}
//		if($data['pro_id']){
//			$map['pro_id'] = ' and t1_old_pro_id=\''.$data['pro_id'].'\'';
//		}
//		cookie('aTask',serialize($map));
//	}

	public function getProject($mode=1){
		$project = M('Project_table');
		$groupid = $_SESSION['login']['se_groupID'];
		if($groupid==6){
			$partid = substr($_SESSION['login']['se_partID'],3);
		}else{
			$partid = $_SESSION['login']['se_partID'];
		}
		if($groupid==6){
			$info = $project->field('id,title as text')->where('`status`<>65 and `client_id`='.$partid)->select();
		}else{
			$info = $project->field('id,title as text')->where('`status`<>65')->select();
		}

		array_unshift($info,array('id'=>0,'text'=>''));
		if($mode==1){
			echo json_encode($info);
		}elseif($mode==2){
			return $info;
		}
	}

	/**
	 * 清除缓存
	 *@examlpe
	 */
	public function clear1(){
		cookie('type',NULL);
		cookie('aTask',NULL);
		cookie('tWeek',NULL);
		cookie('nowweeks',NULL);
		cookie('taskData',NULL);
	}

	public function chgweek($act){
		if($act==1){
			cookie('tWeek',1);
		}elseif($act==2){
			cookie('tWeek',2);
		}
	}
	
}