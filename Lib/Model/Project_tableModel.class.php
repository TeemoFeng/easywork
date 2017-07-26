<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

class Project_tableModel extends RelationModel{
	protected $_link = array(
		'baseinfo'=>array(
			'mapping_type'=>HAS_ONE,
			'mapping_name'=>'baseinfo',
			'class_name'=>'project_baseinfo_table',
			'foreign_key'=>'pro_id',
		),
		'pm'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'pm',
			'class_name'=>'user_table',
			'foreign_key'=>'pm_id',
			'as_fields'=>'username:pmname',
		),
		'views'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'views',
			'class_name'=>'linkage',
			'foreign_key'=>'views',
			'as_fields'=>'val:viewname',
		),
		'client'=>array(
			'mapping_type'=>BELONGS_TO,
			'mapping_name'=>'client',
			'class_name'=>'user_company_table',
			'foreign_key'=>'client_id',
			'as_fields'=>'name:client',
		),
	);
}