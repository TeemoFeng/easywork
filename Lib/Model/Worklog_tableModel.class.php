<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

class Worklog_tableModel extends RelationModel{
	protected $_link = array(
		'user'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'user',
			'class_name'=>'user_table',
			'foreign_key'=>'user_id',
			'as_fields'=>'username:username',
		),
		'main'=>array(
			'mapping_type'=>HAS_ONE,
			'mapping_name'=>'main',
			'class_name'=>'worklog_main_table',
			'foreign_key'=>'worklog_id',
		),
		'status'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'status',
			'class_name'=>'linkage',
			'foreign_key'=>'status',
			'as_fields'=>'val:statusname',
		),
	);
}