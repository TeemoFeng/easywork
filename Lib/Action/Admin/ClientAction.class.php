<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */
 
class ClientAction extends Action {
    public function index($json=NULL){
		$Public = A('Index','Public');
		$Public->check('Client',array('r'));
		
		//main
		if(!is_int((int)$json)){
			$json = NULL;
		}
		if($json==1){
			$comy = M('User_company_table');
			$map['type'] = array('eq','1');
			$info = $comy->order('id asc')->where($map)->select();
			$new_info = array();
			unset($map);
			foreach($info as $t){
				if($t['status']==1){
					$t['status'] = '开启';
				}else{
					$t['status'] = '关闭';
				}
				if($t['ssl']==1){
					$t['ssl'] = '开启';
				}else{
					$t['ssl'] = '关闭';
				}
				$new_info[] = $t;
			}
			echo json_encode($new_info);
			unset($new_info,$info,$comy);
		}else{
			$this->display();
			unset($Public);
		}
    }
	
	public function add($act=NULL,$go=false,$id=NULL){		
		//main
		$comy = M('User_company_table');
		if($go==false){
			$this->assign('uniqid',uniqid());
			if($act=='add'){
				$this->assign('act','add');
				$this->display();
			}else{
				if(!is_int((int)$id)){
					$id = NULL;
					$this->show('无法获取ID');
				}else{
					$map['id'] = array('eq',$id);
					$info = $comy->where($map)->find();
					$this->assign('id',$id);
					$this->assign('act','edit');
					$this->assign('info',$info);
					$this->display();
					unset($info);
				}
			}	
		}else{
			$data = $comy->create();
			$data['type'] = 1;
			if($act=='add'){
				$Public = A('Index','Public');
				$role = $Public->check('Client',array('c'));
				if($role<0){
					echo $role; exit;
				}
				
				$add = $comy->add($data);
				if($add>0){
					$this->json(NULL);
					echo 1;
				}else{
					echo 0;
				}
				unset($data);
			}elseif($act=='edit'){
				$Public = A('Index','Public');
				$role = $Public->check('Client',array('u'));
				if($role<0){
					echo $role; exit;
				}
				
				if(!is_int((int)$id)){
					echo 0;
				}else{
					$map['id'] = array('eq',$id);
					$edit = $comy->where($map)->save($data);
					unset($map);
					if($edit !== false){
						$this->json(NULL);
						echo 1;
					}else{
						echo 0;
					}
					unset($data);
				}
			}
		}
		unset($comy);
	}
	
	public function del($id){
		$Public = A('Index','Public');
		$role = $Public->check('Client',array('d'));
		if($role<0){
			echo $role; exit;
		}
		
		//main
		if(!is_int((int)$id)){
			echo 0;
		}else{
			$comy = M('User_company_table');
			$map['id'] = array('eq',$id);
			$del = $comy->where($map)->delete();
			unset($map);
			if($del){
				$this->json(NULL);
				echo 1;
			}else{
				echo 0;
			}
			unset($comy,$Public);
		}
	}
	
	public function json($back=1){
		$Loop = A('Loop','Public');
		$Loop->table = 'User_company_table';
		$Loop->field = 'id,name as text';
		$Loop->where = '`status`=1 and `type`=1';
		$Loop->mode = 'noson';
		$Loop->order = 'id';
		$Write = A('Write','Public');
		import('ORG.Net.FileSystem');
		$sys = new FileSystem();
	
		//main
    	$temp_path = RUNTIME_PATH.'/Temp/';
		if(file_exists($temp_path)){
			$dt = $sys->delFile($temp_path);
		}
		$path = RUNTIME_PATH.'Data/Json';
		$info = $Loop->rowLevel();
		array_unshift($info,array(
			'id'=>0,
			'text'=>'无',
		));
		$json_data = json_encode($info);
		$put_json = $Write->write($path,$json_data,'Client_data');
		
		
		if($back==1){
			if($put_json){
				echo 1;
			}else{
				echo 0;
			}
		}
		
		R(GROUP_NAME.'/Comy/json',array(NULL));
		//R(GROUP_NAME.'/Part/json',array(NULL));
	}
}