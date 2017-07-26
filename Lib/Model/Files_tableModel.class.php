<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */ 

class Files_tableModel extends RelationModel{
	protected $_link = array(
		'user'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'user',
			'class_name'=>'user_table',
			'foreign_key'=>'user_id',
			'as_fields'=>'username:username',
		),
		'baseinfo'=>array(
			'mapping_type'=>HAS_ONE,
			'mapping_name'=>'baseinfo',
			'class_name'=>'files_baseinfo_table',
			'foreign_key'=>'files_id',
			'as_fields'=>'description:description',
		),
		'path'=>array(
			'mapping_type'=>HAS_ONE,
			'mapping_name'=>'path',
			'class_name'=>'files_path_table',
			'foreign_key'=>'files_id',
			'as_fields'=>'path:path',
		),
	);
}