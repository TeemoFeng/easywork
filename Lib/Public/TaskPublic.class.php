<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

//转换任務栏树形列表所需数据格式
class TaskPublic extends Action {
	private $arr_pa;
	private $new_info;
	public function rowTask($id){
		$Public = A('Index','Public');
		$obj = M('Task_table');
		$task = C('DB_PREFIX').'task_table';
		$linkage = C('DB_PREFIX').'linkage';
		$result = M();
		$proobj = M('Project_table');
		$top = $proobj->field('id,title as text')->where('id='.$id)->find();
		$sele = $result->table($task.' as t1')->field('t1.id as id,t1._parentId as _parentId ,concat_ws(\'\',\' <span class=\"up-font-over\">[\',t2.val,\']<\/span> \',t1.title) as text')->join(' '.$linkage.' as t2 on t2.id=t1.type')->where('t1.pro_id='.$id)->select();
		$this->arr_pa = array();
		$this->new_info = array();
		$num = count($sele);
		foreach($sele as $t){
			if($t['_parentId']!=0){
				$this->arr_pa[$t['id']] = $t['_parentId'];
			}
			$t['text'] = $num--.''.$t['text'];
			$this->new_info[$t['id']] = $t;
		}
		//dump($this->arr_pa);exit;
		while(true){
			if(count($this->arr_pa)>0){
				$this->getLoop($id);
			}else{
				break;
			}
		}
		$info = array_reverse($this->new_info);
		$infos[$id] = $top;
		$infos[$id]['children'] = $info;
		$info = array_reverse($infos);
		//dump($info);exit;
		//$info = array_sort($info,'sort');
		return $info;
	}
	
	private function getLoop($id){
		foreach($this->new_info as $key=>$val){
			if($val['_parentId']!=0){
				$idd = array_search($key,$this->arr_pa);
				if(!$idd){
					$this->new_info[$val['_parentId']]['children'][] = $val;
					unset($this->new_info[$key],$this->arr_pa[$key]);
				}
			}
		}	
	}
}