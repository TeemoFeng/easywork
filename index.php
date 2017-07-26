<?php
/*
 * @varsion		EasyWork系统
 * @package		程序设计深圳市九五时代科技有限公司设计开发
 * @copyright	Copyright (c) 2010 - 2015, 95era, Inc.
 * @link		http://www.d-winner.com
 */

if(!file_exists(dirname(__FILE__).'/Conf/conn.php')){
    header('Location:Install/index.php');
}else{
	define('APP_DEBUG',true);
	require('Sys/ThinkPHP/ThinkPHP.php');
}
