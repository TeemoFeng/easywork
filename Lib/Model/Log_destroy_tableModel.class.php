<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

class Log_destroy_tableModel extends RelationModel{
	protected $_link = array(
		'user'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'user',
			'class_name'=>'user_table',
			'foreign_key'=>'user_id',
			'as_fields'=>'username:username',
		),
		'logmain'=>array(
			'mapping_type'=>HAS_ONE,
			'mapping_name'=>'logmain',
			'class_name'=>'log_dmain_table',
			'foreign_key'=>'log_id',
		),
	);
}