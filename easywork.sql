/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50547
Source Host           : localhost:3306
Source Database       : easywork

Target Server Type    : MYSQL
Target Server Version : 50547
File Encoding         : 65001

Date: 2017-07-07 09:25:11
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dwin_config
-- ----------------------------
DROP TABLE IF EXISTS `dwin_config`;
CREATE TABLE `dwin_config` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `keyword` char(30) NOT NULL COMMENT '变量名',
  `vals` text NOT NULL COMMENT '变量值',
  `opts` text NOT NULL COMMENT 'opt值',
  `types` char(10) NOT NULL COMMENT '类型',
  `name` char(50) NOT NULL COMMENT '说明',
  `notes` varchar(80) NOT NULL DEFAULT '' COMMENT '解释',
  `gid` tinyint(2) NOT NULL COMMENT '所属组别',
  `sys` tinyint(1) NOT NULL DEFAULT '1' COMMENT '是否系统',
  `sort` mediumint(8) NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`),
  UNIQUE KEY `one` (`keyword`),
  KEY `gid` (`gid`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of dwin_config
-- ----------------------------
INSERT INTO `dwin_config` VALUES ('1', 'CFG_NAME', '我的项目', '我的项目', 'char', '项目名称', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('3', 'CFG_HOST', 'http://easywork.com', 'http://easywork.com', 'char', '系统地址', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('6', 'CFG_PHONE', '13802901247', '13802901247', 'char', '公司电话', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('7', 'APP_GROUP_LIST', 'Admin,Public', 'Admin,Public', 'char', '项目分组', '(请以“,”分开)', '4', '1', '50');
INSERT INTO `dwin_config` VALUES ('8', 'DEFAULT_GROUP', 'Admin', 'Admin', 'char', '默认分组', '', '4', '1', '50');
INSERT INTO `dwin_config` VALUES ('9', 'CFG_FAX', '13802901247', '13802901247', 'char', '公司传真', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('10', 'CFG_MAIL', '68058382@qq.com', '68058382@qq.com', 'char', '公司邮箱', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('11', 'CFG_ADDRESS', '广东深圳', '广东深圳', 'char', '公司地址', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('13', 'CFG_APPID', 'CY1O231LTHU3U', 'CY1O231LTHU3U', 'char', '站点识别ID', '', '-1', '1', '50');
INSERT INTO `dwin_config` VALUES ('14', 'CODE_ON', '0', '0', 'bool', '验证码登录', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('15', 'CFG_COPYRIGHT', 'Copyright 2015 九五时代', 'Copyright 2015 九五时代', 'text', '版权设置', '', '1', '1', '50');
INSERT INTO `dwin_config` VALUES ('17', 'DB_FIELDS_CACHE', '1', '1', 'bool', '开启字段缓存', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('18', 'CODE_MODEL', '1', '1=&gt;数字|2=&gt;字母|5=&gt;混合', 'select', '验证码模式', '(需要开启验证码登录)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('19', 'CODE_LEN', '4', '4', 'int', '验证码长度', '(需要开启验证码登录)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('20', 'MAIL_SMTP_SEAVER', 'smtp.qq.com', 'smtp.qq.com', 'char', 'SMTP服务器', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('21', 'MAIL_SMTP_SSL', '', '', 'bool', '安全连接(SSL)', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('22', 'MAIL_SMTP_PORT', '25', '25', 'int', 'SMTP服务器端口', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('23', 'MAIL_SMTP_USER', '68058382@qq.com', '68058382@qq.com', 'char', 'SMTP用户名', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('24', 'MAIL_SMTP_PWD', '123456', '123456', 'char', 'SMTP密码', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('25', 'MAIL_SMTP_NAME', '九五时代', '九五时代', 'char', '发件箱名称', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('32', 'CFG_CHARSET', 'UTF-8', 'UTF-8=&gt;UTF-8|GBK=&gt;GBK', 'select', '编码类型', '', '4', '1', '50');
INSERT INTO `dwin_config` VALUES ('33', 'WALL_ON', '0', '0', 'bool', '开启防火墙', '', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('34', 'WALL_KEY', '', '', 'char', '防火墙密钥', '(6~50个数字或字母)', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('35', 'LOGIN_URL', '', '', 'char', '允许后台登陆的域名', '(如：http://www.piocms.com/index.php/admin)', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('36', 'LOGIN_TIME', '', '', 'more', '允许登陆后台的时间点', '(不选为不限制)', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('37', 'LOGIN_WEEK', '', '', 'more', '允许登陆后台的星期', '(不选为不限制) ', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('39', 'CFG_NUM', '1', '1', 'int', '保留小数位', '(小数点后保留的位数)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('38', 'WALL_SHIELDING', '操你妈|鸡巴|性爱|毛泽东|共产党', '操你妈|鸡巴|性爱|毛泽东|共产党', 'text', '屏蔽敏感字符', '(多个用“|”格开，屏蔽前台所提交的内容)', '52', '1', '50');
INSERT INTO `dwin_config` VALUES ('40', 'DATA_CACHE_TYPE', 'File', 'File|Apachenote|Apc|Eaccelerator|Memcache|Shmop|Sqlite|Db|Redis|Xcache', 'select', '数据缓存方式', '(部分缓存方式需要服务器支持)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('56', 'DATA_NOWRAP', '1', '1', 'bool', '自动截取', '(设置为true时，当表格数据长度超出范围时自动截取)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('55', 'DG_FIT_COLUMNS', '0', '0', 'bool', '自动列适应', '(设置为true时，避免表格出现水平滚动)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('54', 'SEARCH_ADV_ACTION', '0', '0', 'bool', '高級搜索动作', '(控制查询之后窗口是否自动关闭)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('41', 'DATA_CACHE_SUBDIR', '1', '1', 'bool', '哈希子目录缓存', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('42', 'DATA_PATH_LEVEL', '2', '2', 'int', '哈希目录层次', '(需要开启哈希目录缓存)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('46', 'IMG_WIDTH', '180', '180', 'int', '默认缩略图宽度', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('47', 'IMG_HEIGHT', '137', '137', 'int', '默认缩略图高度', '', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('50', 'PAGE_ROW', '50', '0=&gt;0|10=&gt;10|30=&gt;30|50=&gt;50|80=&gt;80|100=&gt;100|1000=&gt;1000', 'select', '每页显示行数', '为\"0\"时表示不显示分页)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('57', 'UPLOAD_SIZE', '52428800', '52428800', 'int', '上传限制', '(单位：字节)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('53', 'SEARCH_ACTION', '0', '0', 'bool', '快速查询动作', '(控制快速查询之后窗口是否自动关闭)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('62', 'SKIN_COOKIE_EXPIRES', '365', '365', 'int', '皮肤过期时间', '(切换皮肤过期时间，单位：天)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('61', 'CFG_OPEN_TABS', '0', '0', 'bool', '选项卡打开方式', '(是否在新的选项卡打开项目)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('63', 'DB_SQL_BUILD_CACHE', '1', '1', 'bool', 'SQL解析缓存', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('64', 'DB_SQL_BUILD_LENGTH', '30', '30', 'int', 'SQL解析缓存长度', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('65', 'DB_SQL_BUILD_QUEUE', 'file', 'file|xcache|apc', 'select', 'SQL解析缓存方式', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('66', 'DATA_CACHE_TIME', '0', '0', 'int', '数据缓存时间', '(“0”表示永久缓存，单位：秒)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('67', 'BROWSER_CACHE', '0', '0', 'bool', '调用浏览器缓存', '(是否调用浏览器缓存)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('68', 'DATAGRID_VIEW', '0', '0=&gt;无视图|scrollview=&gt;scrollview|bufferview=&gt;bufferview', 'select', '开启表格视图', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('76', 'CFG_ON', '1', '1', 'bool', '系统开关', '(关闭时，系统将无法登录)', '4', '1', '50');
INSERT INTO `dwin_config` VALUES ('77', 'BACKUP_SIZE', '500', '500', 'int', '备份文件大小', '(单个备份文件大小限制，单位：KB)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('71', 'SUBMIT_ACTION', '1', '1', 'bool', '提交成功动作', '(提交成功之后窗口是否自动关闭)', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('78', 'USER_TO_MAIL', '0', '0', 'bool', '用户注册提醒', '(为新增的用户发送邮件提醒)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('79', 'MAIL_OF_USER', '0', '0', 'bool', '允许个人邮箱', '(开启后，允许用户更改自己的邮箱)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('81', 'SMS_AUTO_REPORT', '1', '1', 'bool', '信息自动提醒', '', '2', '1', '50');
INSERT INTO `dwin_config` VALUES ('82', 'CFG_CLIENT_PRE', 'D', 'D', 'char', '项目代码前缀', '(设置客户编号前缀)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('84', 'UPLOAD_TYPE', 'jpg,png,gif,doc,xls,docx,xlsx,rar,zip,iso,tar,txt,pdf,apk,ipa', 'jpg,png,gif,doc,xls,docx,xlsx,rar,zip,iso,tar,txt,pdf,apk,ipa', 'text', '上传类型', '(允许上传的文件类型)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('85', 'VIEW_GRESS', '7', '7', 'int', '跟进默认天数', '(首页中客户跟进默认显示天数)', '3', '1', '50');
INSERT INTO `dwin_config` VALUES ('86', 'MORE_COMY', '0', '0', 'bool', '开启子公司', '', '3', '1', '50');

-- ----------------------------
-- Table structure for dwin_files_baseinfo_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_files_baseinfo_table`;
CREATE TABLE `dwin_files_baseinfo_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `files_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `files_id` (`files_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_files_baseinfo_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_files_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_files_main_table`;
CREATE TABLE `dwin_files_main_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `files_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `files_id` (`files_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_files_main_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_files_path_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_files_path_table`;
CREATE TABLE `dwin_files_path_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `files_id` int(11) NOT NULL DEFAULT '0',
  `path` varchar(180) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `files_id` (`files_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_files_path_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_files_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_files_table`;
CREATE TABLE `dwin_files_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `edit_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(65) NOT NULL DEFAULT '',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `title` (`title`) USING BTREE,
  KEY `edit_id` (`edit_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_files_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_linkage
-- ----------------------------
DROP TABLE IF EXISTS `dwin_linkage`;
CREATE TABLE `dwin_linkage` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `_parentId` smallint(4) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `text` char(35) NOT NULL DEFAULT '' COMMENT '名称',
  `val` varchar(120) NOT NULL DEFAULT '' COMMENT '值',
  `code` varchar(60) NOT NULL DEFAULT '' COMMENT '名称拼音',
  `status` tinyint(1) NOT NULL DEFAULT '1' COMMENT '状态',
  `sort` smallint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  `deep` tinyint(1) NOT NULL DEFAULT '0',
  `layer` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=68 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_linkage
-- ----------------------------
INSERT INTO `dwin_linkage` VALUES ('5', '0', '任务类型', '任务类型', 'renwuleixing', '1', '1', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('6', '5', '子项目', '子项目', 'zixiangmu', '1', '1', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('7', '5', '控制账户', '控制账户', 'kongzhizhanghu', '1', '2', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('8', '0', '任务状态', '任务状态', 'renwuzhuangtai', '1', '2', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('9', '8', '未开始', '<div style=\'background-color: #cf86cf; width:100%; text-align:center;\'>未开始</div>', 'weikaishi', '1', '1', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('10', '8', '计划', '<div style=\'background-color: #d2ff00; width:100%; text-align:center;\'>计划</div>', 'jihua', '1', '2', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('11', '8', '进行中20%', '<div style=\'background-color: #9F0; width:100%; text-align:center;\'>进行中20%</div>', 'jinxingzhong20', '1', '3', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('12', '8', '进行中40%', '<div style=\'background-color: #9F0; width:100%; text-align:center;\'>进行中40%</div>', 'jinxingzhong40', '1', '4', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('13', '8', '进行中60%', '<div style=\'background-color: #9F0; width:100%; text-align:center;\'>进行中60%</div>', 'jinxingzhong60', '1', '5', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('14', '0', '查看权限', '查看权限', 'chakanquanxian', '1', '3', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('15', '14', '相关客户', '相关客户', 'gongkai', '1', '3', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('16', '14', '内部所有人', '内部所有人', 'yingcang', '1', '1', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('17', '14', '项目相关人', '项目相关人', 'zhuanan', '1', '2', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('18', '0', '严重程度', '严重程度', 'yanzhongchengdu', '1', '4', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('21', '0', '项目状态', '项目状态', 'xiangmuzhuangtai', '1', '5', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('22', '0', '优先级', '优先级', 'youxianji', '1', '6', '0', '1');
INSERT INTO `dwin_linkage` VALUES ('24', '18', '极低', '极低', 'jidi', '1', '2', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('25', '18', '低', '低', 'di', '1', '3', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('26', '18', '中', '中', 'zhong', '1', '4', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('27', '18', '高', '高', 'gao', '1', '5', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('35', '22', '极低', '极低', 'jidi', '1', '2', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('36', '22', '低', '低', 'di', '1', '3', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('37', '22', '中', '中', 'zhong', '1', '4', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('38', '22', '高', '高', 'gao', '1', '5', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('39', '22', '急紧', '急紧', 'jijin', '1', '6', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('46', '8', '进行中80%', '<div style=\'background-color: #9F0; width:100%; text-align:center;\'>进行中80%</div>', 'jinxingzhong80', '1', '6', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('47', '8', '调试', '<div style=\'background-color: #83a6fe; width:100%; text-align:center;\'>调试</div>', 'jinxingzhong100', '1', '7', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('48', '8', '中断', '<div style=\'background-color: #ccc; width:100%; text-align:center;\'>中断</div>', 'zhongduan', '1', '13', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('49', '8', '推迟', '<div style=\'background-color: #00ffae; width:100%; text-align:center;\'>推迟</div>', 'tuichi', '1', '9', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('51', '8', '完成验收', '<div style=\'background-color: #fb7575; width:100%; text-align:center;\'>完成验收</div>', 'wanchengyanshou', '1', '11', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('52', '8', '驳回', '<div style=\'background-color: #97d38b; width:100%; text-align:center;\'>驳回</div>', 'bohui', '1', '12', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('53', '5', '项目管理', '项目管理', 'xiangmuguanli', '1', '3', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('54', '5', '产品设计', '产品设计', 'chanpinsheji', '1', '4', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('55', '5', '开发', '开发', 'kaifa', '1', '5', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('56', '5', 'Bug', 'Bug', 'bug', '1', '6', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('57', '5', '测试', '测试', 'ceshi', '1', '7', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('58', '5', '撰写文档', '撰写文档', 'zhuanxiewendang', '1', '8', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('59', '5', '需求调研', '需求调研', 'xuqiu', '1', '9', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('60', '5', '会议', '会议', 'huiyi', '1', '10', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('62', '5', '加班', '加班', 'jiaban', '1', '12', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('63', '5', '其它', '其它', 'qita', '1', '13', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('64', '18', '严重', '严重', 'yanzhong', '1', '6', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('65', '21', '已结束', '<div style=\'background-color: #97d38b; width:100%; text-align:center;\'>已结束</div>', 'xmyjs', '1', '51', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('66', '21', '已中断', '<div style=\'background-color: #ccc; width:100%; text-align:center;\'>已中断</div>', 'xmzd', '1', '53', '1', '1');
INSERT INTO `dwin_linkage` VALUES ('67', '21', '已推迟', '<div style=\'background-color: #00ffae; width:100%; text-align:center;\'>已推迟</div>', 'tc', '1', '50', '1', '1');

-- ----------------------------
-- Table structure for dwin_log_destroy_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_log_destroy_table`;
CREATE TABLE `dwin_log_destroy_table` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `usage` char(12) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notes` char(60) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workdate` date NOT NULL DEFAULT '0000-00-00',
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `mode` (`mode`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_log_destroy_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_log_dmain_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_log_dmain_table`;
CREATE TABLE `dwin_log_dmain_table` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL DEFAULT '0',
  `pro_id` int(8) NOT NULL DEFAULT '0',
  `task_id` int(8) NOT NULL DEFAULT '0',
  `worklog_id` int(11) NOT NULL DEFAULT '0',
  `files_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `log_id` (`log_id`) USING BTREE,
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `worklog_id` (`worklog_id`) USING BTREE,
  KEY `files_id` (`files_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_log_dmain_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_log_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_log_main_table`;
CREATE TABLE `dwin_log_main_table` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `log_id` int(11) NOT NULL DEFAULT '0',
  `pro_id` int(8) NOT NULL DEFAULT '0',
  `task_id` int(8) NOT NULL DEFAULT '0',
  `worklog_id` int(11) NOT NULL DEFAULT '0',
  `files_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `log_id` (`log_id`) USING BTREE,
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `worklog_id` (`worklog_id`) USING BTREE,
  KEY `files_id` (`files_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_log_main_table
-- ----------------------------
INSERT INTO `dwin_log_main_table` VALUES ('1', '1', '1', '0', '0', '0');
INSERT INTO `dwin_log_main_table` VALUES ('2', '2', '1', '1', '0', '0');
INSERT INTO `dwin_log_main_table` VALUES ('3', '3', '1', '1', '0', '0');
INSERT INTO `dwin_log_main_table` VALUES ('4', '4', '1', '1', '0', '0');
INSERT INTO `dwin_log_main_table` VALUES ('5', '5', '1', '1', '0', '0');

-- ----------------------------
-- Table structure for dwin_log_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_log_table`;
CREATE TABLE `dwin_log_table` (
  `id` bigint(15) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `mode` tinyint(1) NOT NULL DEFAULT '0',
  `usage` char(12) NOT NULL DEFAULT '',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `notes` char(60) NOT NULL DEFAULT '',
  `description` varchar(200) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `workdate` date NOT NULL DEFAULT '0000-00-00',
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `mode` (`mode`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_log_table
-- ----------------------------
INSERT INTO `dwin_log_table` VALUES ('1', '1', '1', '1', '无', '0', '状态为：', '', '2017-06-05 16:20:25', '0000-00-00', '1');
INSERT INTO `dwin_log_table` VALUES ('2', '1', '2', '1', '无', '10', '状态为：计划', '', '2017-06-05 16:23:34', '0000-00-00', '1');
INSERT INTO `dwin_log_table` VALUES ('3', '3', '2', '4', '无', '0', '审核', '', '2017-06-05 16:30:09', '0000-00-00', '1');
INSERT INTO `dwin_log_table` VALUES ('4', '3', '2', '4', '无', '0', '反审核', '', '2017-06-05 16:30:25', '0000-00-00', '1');
INSERT INTO `dwin_log_table` VALUES ('5', '3', '2', '4', '无', '0', '审核', '', '2017-06-05 16:30:28', '0000-00-00', '1');

-- ----------------------------
-- Table structure for dwin_menu
-- ----------------------------
DROP TABLE IF EXISTS `dwin_menu`;
CREATE TABLE `dwin_menu` (
  `id` smallint(4) NOT NULL AUTO_INCREMENT COMMENT 'ID',
  `_parentId` smallint(4) NOT NULL DEFAULT '0' COMMENT '上级ID',
  `deep` tinyint(1) NOT NULL DEFAULT '0' COMMENT '深度',
  `code` char(20) NOT NULL DEFAULT '' COMMENT '识别码',
  `text` char(35) NOT NULL DEFAULT '' COMMENT '名称',
  `url` varchar(100) NOT NULL DEFAULT '' COMMENT '连接',
  `iconCls` char(50) DEFAULT NULL COMMENT '标题图片',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `state` char(6) NOT NULL DEFAULT 'open' COMMENT '状态',
  `mode` tinyint(1) NOT NULL DEFAULT '1',
  `type` char(5) NOT NULL DEFAULT '' COMMENT '类型',
  `level` char(15) NOT NULL DEFAULT '10' COMMENT '权限',
  `view` text NOT NULL COMMENT '开放用户',
  `sort` smallint(4) NOT NULL DEFAULT '50' COMMENT '排序',
  PRIMARY KEY (`id`),
  KEY `mode` (`mode`) USING BTREE,
  KEY `states` (`state`,`status`) USING BTREE,
  KEY `code` (`code`) USING BTREE,
  KEY `_parentId` (`_parentId`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_menu
-- ----------------------------
INSERT INTO `dwin_menu` VALUES ('1', '0', '0', '', '系统管理', '', 'icon-setting', '1', 'open', '1', '>=', '999', '', '99');
INSERT INTO `dwin_menu` VALUES ('2', '1', '1', '', '基础设置', '', '', '1', 'open', '1', '>=', '999', '', '1');
INSERT INTO `dwin_menu` VALUES ('3', '2', '2', 'User', '用户管理', '/index.php?s=/user/index', '', '1', 'open', '1', '>=', '999', '', '2');
INSERT INTO `dwin_menu` VALUES ('4', '1', '1', '', '系统设置', '', '', '1', 'open', '1', '>=', '999', '', '2');
INSERT INTO `dwin_menu` VALUES ('5', '2', '2', 'Group', '角色管理', '/index.php?s=/group/index', '', '1', 'open', '1', '>=', '999', '', '3');
INSERT INTO `dwin_menu` VALUES ('6', '2', '2', 'Comy', '公司管理', '/index.php?s=/comy/index', '', '0', 'open', '1', '>=', '999', '', '4');
INSERT INTO `dwin_menu` VALUES ('7', '2', '2', 'Linkage', '联动管理', '/index.php?s=/linkage/index', '', '1', 'open', '1', '>=', '999', '', '7');
INSERT INTO `dwin_menu` VALUES ('8', '2', '2', 'Part', '部门管理', '/index.php?s=/part/index', '', '1', 'open', '1', '>=', '999', '', '6');
INSERT INTO `dwin_menu` VALUES ('9', '4', '2', 'Setting', '参数设置', '/index.php?s=/setting/index', '', '1', 'open', '1', '>=', '999', '', '1');
INSERT INTO `dwin_menu` VALUES ('10', '4', '2', 'Menu', '菜单设置', '/index.php?s=/menu/index', '', '1', 'open', '1', '>=', '9999', '', '2');
INSERT INTO `dwin_menu` VALUES ('11', '1', '1', '', '系统工具', '', '', '1', 'open', '1', '>=', '9999', '', '3');
INSERT INTO `dwin_menu` VALUES ('12', '11', '2', 'Backup', '数据备份', '/index.php?s=/backup/index', '', '1', 'open', '1', '>=', '9999', '', '1');
INSERT INTO `dwin_menu` VALUES ('13', '0', '0', '', '工作管理', '', 'icon-project', '1', 'open', '1', '>=', '10', '', '1');
INSERT INTO `dwin_menu` VALUES ('14', '13', '1', '', '项目管理', '', '', '1', 'open', '1', '>=', '10', '', '1');
INSERT INTO `dwin_menu` VALUES ('15', '14', '2', 'Log', '动态列表', '/index.php?s=/log/index', '', '1', 'open', '1', '>=', '10', '', '2');
INSERT INTO `dwin_menu` VALUES ('16', '13', '1', '', '属性管理', '', '', '1', 'open', '1', '>=', '50', '', '2');
INSERT INTO `dwin_menu` VALUES ('18', '16', '2', 'Client', '客户管理', '/index.php?s=/client/index', '', '1', 'open', '1', '>=', '50', '', '2');
INSERT INTO `dwin_menu` VALUES ('19', '14', '2', 'Project', '项目列表', '/index.php?s=/project/index', '', '1', 'open', '1', '>=', '10', '', '3');
INSERT INTO `dwin_menu` VALUES ('20', '14', '2', 'Files', '文档列表', '/index.php?s=/files/index', '', '1', 'open', '1', '>=', '10', '', '4');
INSERT INTO `dwin_menu` VALUES ('21', '14', '2', 'Notice', '公告列表', '/index.php?s=/notice/index', '', '1', 'open', '1', '>=', '30', '', '5');
INSERT INTO `dwin_menu` VALUES ('22', '14', '2', 'Task', '任务列表', '/index.php?s=/task/index', '', '1', 'open', '1', '>=', '10', '', '1');

-- ----------------------------
-- Table structure for dwin_mssage_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_mssage_table`;
CREATE TABLE `dwin_mssage_table` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `label` char(35) NOT NULL DEFAULT '',
  `code` char(15) NOT NULL DEFAULT '',
  `title` varchar(80) DEFAULT NULL,
  `content` text NOT NULL,
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_mssage_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_notice_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_notice_table`;
CREATE TABLE `dwin_notice_table` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(65) NOT NULL DEFAULT '',
  `content` text NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `addtime` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `title` (`title`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_notice_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_project_baseinfo_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_project_baseinfo_table`;
CREATE TABLE `dwin_project_baseinfo_table` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  `startdate` date NOT NULL DEFAULT '0000-00-00',
  `enddate` date NOT NULL DEFAULT '0000-00-00',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_project_baseinfo_table
-- ----------------------------
INSERT INTO `dwin_project_baseinfo_table` VALUES ('1', '1', '2017-06-05', '2017-06-30', '新增模块，需要尽快完成<br />');

-- ----------------------------
-- Table structure for dwin_project_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_project_table`;
CREATE TABLE `dwin_project_table` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `pm_id` int(11) NOT NULL DEFAULT '0',
  `client_id` smallint(5) DEFAULT NULL,
  `status` smallint(4) NOT NULL DEFAULT '0',
  `views` smallint(4) NOT NULL DEFAULT '0',
  `title` varchar(65) NOT NULL DEFAULT '',
  `code` char(12) NOT NULL DEFAULT '',
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  `uptime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `keyword` (`title`,`code`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `uptime` (`uptime`) USING BTREE,
  KEY `title` (`title`) USING BTREE,
  KEY `client_id` (`client_id`) USING BTREE,
  KEY `pm_id` (`pm_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_project_table
-- ----------------------------
INSERT INTO `dwin_project_table` VALUES ('1', '3', '0', '0', '17', '测试项目', '01', '2017-06-05 16:20:25', '2017-06-05 16:20:25');

-- ----------------------------
-- Table structure for dwin_reply_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_reply_main_table`;
CREATE TABLE `dwin_reply_main_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  `task_id` int(11) NOT NULL DEFAULT '0',
  `worklog_id` int(11) NOT NULL DEFAULT '0',
  `reply_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `reply_id` (`reply_id`) USING BTREE,
  KEY `worklog_id` (`worklog_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_reply_main_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_reply_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_reply_table`;
CREATE TABLE `dwin_reply_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `addtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_reply_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_session
-- ----------------------------
DROP TABLE IF EXISTS `dwin_session`;
CREATE TABLE `dwin_session` (
  `session_id` varchar(255) NOT NULL DEFAULT '',
  `session_expire` int(11) NOT NULL DEFAULT '0',
  `session_data` blob NOT NULL,
  UNIQUE KEY `session_id` (`session_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_session
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_sms_baseinfo_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_sms_baseinfo_table`;
CREATE TABLE `dwin_sms_baseinfo_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sms_id` (`sms_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_sms_baseinfo_table
-- ----------------------------
INSERT INTO `dwin_sms_baseinfo_table` VALUES ('1', '1', 'admin设置了您为项目：“<a href=\"javascript:showTab(\'项目-测试项目\',1);\">测试项目</a>” 的项目负责人，点击项目名称查看更多详情。');
INSERT INTO `dwin_sms_baseinfo_table` VALUES ('2', '2', 'admin创建了项目：“<a href=\"javascript:showTab(\'项目-测试项目\',1);\">测试项目</a>”，点击项目名称查看更多详情。');
INSERT INTO `dwin_sms_baseinfo_table` VALUES ('3', '3', 'admin指派了您为项目：“<a href=\"javascript:showTab(\'项目-测试项目\',1,1);\">开发登录模块</a>” -> “开发登录模块” 的任务负责人，点击任务名称查看更多详情。');
INSERT INTO `dwin_sms_baseinfo_table` VALUES ('4', '4', 'admin创建了任务：“<a href=\"javascript:showTab(\'项目-测试项目\',1,1);\">开发登录模块</a>”，点击任务名称查看更多详情。');

-- ----------------------------
-- Table structure for dwin_sms_receive_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_sms_receive_table`;
CREATE TABLE `dwin_sms_receive_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `sms_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `sms_id` (`sms_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_sms_receive_table
-- ----------------------------
INSERT INTO `dwin_sms_receive_table` VALUES ('1', '1', '3', '1');
INSERT INTO `dwin_sms_receive_table` VALUES ('2', '2', '3', '1');
INSERT INTO `dwin_sms_receive_table` VALUES ('3', '3', '4', '1');
INSERT INTO `dwin_sms_receive_table` VALUES ('4', '4', '4', '1');
INSERT INTO `dwin_sms_receive_table` VALUES ('5', '4', '3', '1');

-- ----------------------------
-- Table structure for dwin_sms_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_sms_table`;
CREATE TABLE `dwin_sms_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `title` char(50) NOT NULL DEFAULT '',
  `sendtime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_sms_table
-- ----------------------------
INSERT INTO `dwin_sms_table` VALUES ('1', '1', '1', '项目：测试项目 负责人任命通知', '2017-06-05 16:20:25');
INSERT INTO `dwin_sms_table` VALUES ('2', '1', '1', '项目：测试项目 创建通知', '2017-06-05 16:20:25');
INSERT INTO `dwin_sms_table` VALUES ('3', '1', '1', '项目：测试项目 任务指派通知。', '2017-06-05 16:23:34');
INSERT INTO `dwin_sms_table` VALUES ('4', '1', '1', '项目：测试项目 任务指派通知。', '2017-06-05 16:23:34');

-- ----------------------------
-- Table structure for dwin_task_baseinfo_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_task_baseinfo_table`;
CREATE TABLE `dwin_task_baseinfo_table` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `task_id` mediumint(8) NOT NULL DEFAULT '0',
  `content` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `task_id` (`task_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_task_baseinfo_table
-- ----------------------------
INSERT INTO `dwin_task_baseinfo_table` VALUES ('1', '1', '开发 登录模块<br />');

-- ----------------------------
-- Table structure for dwin_task_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_task_main_table`;
CREATE TABLE `dwin_task_main_table` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  `task_id` mediumint(8) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_task_main_table
-- ----------------------------
INSERT INTO `dwin_task_main_table` VALUES ('1', '1', '1');

-- ----------------------------
-- Table structure for dwin_task_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_task_table`;
CREATE TABLE `dwin_task_table` (
  `id` int(8) NOT NULL AUTO_INCREMENT,
  `_parentId` int(11) NOT NULL DEFAULT '0',
  `pro_id` mediumint(8) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `from_id` int(11) NOT NULL DEFAULT '0',
  `to_id` int(11) NOT NULL DEFAULT '0',
  `title` varchar(65) NOT NULL DEFAULT '',
  `type` smallint(4) NOT NULL DEFAULT '0',
  `status` smallint(4) NOT NULL DEFAULT '0',
  `level` smallint(4) NOT NULL DEFAULT '0',
  `degree` smallint(4) NOT NULL DEFAULT '0',
  `plantime` float NOT NULL DEFAULT '0',
  `startdate` date NOT NULL DEFAULT '0000-00-00',
  `enddate` date NOT NULL DEFAULT '0000-00-00',
  `check` tinyint(1) NOT NULL DEFAULT '0',
  `check_id` int(11) NOT NULL DEFAULT '0',
  `uptime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `title` (`title`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `type` (`type`) USING BTREE,
  KEY `check` (`check`) USING BTREE,
  KEY `level` (`level`) USING BTREE,
  KEY `degree` (`degree`) USING BTREE,
  KEY `_parentId` (`_parentId`) USING BTREE,
  KEY `uptime` (`uptime`) USING BTREE,
  KEY `enddate` (`enddate`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_task_table
-- ----------------------------
INSERT INTO `dwin_task_table` VALUES ('1', '0', '1', '1', '3', '4', '开发登录模块', '55', '10', '37', '26', '16', '2017-06-06', '2017-06-07', '1', '3', '2017-06-05 04:23:34');

-- ----------------------------
-- Table structure for dwin_upload_file
-- ----------------------------
DROP TABLE IF EXISTS `dwin_upload_file`;
CREATE TABLE `dwin_upload_file` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `ModeName` char(20) NOT NULL DEFAULT '',
  `BelongFile` char(30) DEFAULT NULL,
  `FileName` varchar(255) DEFAULT NULL,
  `CreateDate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ModeName` (`ModeName`) USING BTREE,
  KEY `BelongFile` (`BelongFile`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_upload_file
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_user_company_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_user_company_table`;
CREATE TABLE `dwin_user_company_table` (
  `id` smallint(5) unsigned NOT NULL AUTO_INCREMENT,
  `_parentId` smallint(5) unsigned NOT NULL DEFAULT '0',
  `name` varchar(16) NOT NULL,
  `type` tinyint(1) NOT NULL DEFAULT '0',
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `access` smallint(5) unsigned NOT NULL DEFAULT '10',
  `comment` char(15) NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '50',
  `smtp` varchar(100) NOT NULL DEFAULT '',
  `ssl` tinyint(1) NOT NULL DEFAULT '0',
  `port` smallint(6) NOT NULL DEFAULT '25',
  PRIMARY KEY (`id`),
  KEY `status` (`status`) USING BTREE,
  KEY `comment` (`comment`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_user_company_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_user_group_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_user_group_table`;
CREATE TABLE `dwin_user_group_table` (
  `id` int(4) unsigned NOT NULL AUTO_INCREMENT,
  `_parentId` smallint(6) NOT NULL DEFAULT '0',
  `name` varchar(16) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `access` smallint(5) unsigned NOT NULL DEFAULT '10',
  `comment` varchar(128) NOT NULL DEFAULT '',
  `sort` int(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_user_group_table
-- ----------------------------
INSERT INTO `dwin_user_group_table` VALUES ('1', '0', '超级管理员', '0', '9999', '最高权限角色', '0');
INSERT INTO `dwin_user_group_table` VALUES ('2', '0', '管理员', '1', '999', '没有菜单设置与系统工具权限', '0');
INSERT INTO `dwin_user_group_table` VALUES ('3', '0', '项目经理', '1', '50', '没有系统管理权限', '0');
INSERT INTO `dwin_user_group_table` VALUES ('4', '0', '普通用户', '1', '40', '没有项目管理权限', '0');
INSERT INTO `dwin_user_group_table` VALUES ('5', '0', '访客', '1', '30', '只有查看功能', '0');
INSERT INTO `dwin_user_group_table` VALUES ('6', '0', '客户', '1', '10', '只能看到自己所属的项目', '0');
INSERT INTO `dwin_user_group_table` VALUES ('7', '0', '程序员', '1', '10', '', '0');
INSERT INTO `dwin_user_group_table` VALUES ('8', '0', '项目组长', '1', '50', '', '0');

-- ----------------------------
-- Table structure for dwin_user_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_user_main_table`;
CREATE TABLE `dwin_user_main_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `part_id` int(4) unsigned NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL DEFAULT '0',
  `group_id` int(4) unsigned NOT NULL DEFAULT '0',
  `company_id` int(5) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_user_main_table
-- ----------------------------
INSERT INTO `dwin_user_main_table` VALUES ('1', '0', '1', '1', '0');
INSERT INTO `dwin_user_main_table` VALUES ('2', '1', '2', '5', '0');
INSERT INTO `dwin_user_main_table` VALUES ('3', '1', '3', '8', '0');
INSERT INTO `dwin_user_main_table` VALUES ('4', '1', '4', '4', '0');

-- ----------------------------
-- Table structure for dwin_user_part_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_user_part_table`;
CREATE TABLE `dwin_user_part_table` (
  `id` smallint(3) unsigned NOT NULL AUTO_INCREMENT,
  `_parentId` smallint(5) NOT NULL DEFAULT '0',
  `name` varchar(16) NOT NULL,
  `status` tinyint(2) unsigned NOT NULL DEFAULT '1',
  `access` smallint(5) unsigned NOT NULL DEFAULT '10',
  `comment` varchar(128) NOT NULL DEFAULT '',
  `sort` smallint(3) NOT NULL DEFAULT '50',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_user_part_table
-- ----------------------------
INSERT INTO `dwin_user_part_table` VALUES ('1', '0', '实施运维部', '1', '10', '', '50');

-- ----------------------------
-- Table structure for dwin_user_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_user_table`;
CREATE TABLE `dwin_user_table` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(32) NOT NULL DEFAULT '',
  `realname` varchar(64) NOT NULL DEFAULT '',
  `password` varchar(32) NOT NULL DEFAULT '',
  `email` varchar(64) NOT NULL DEFAULT '',
  `status` char(1) NOT NULL DEFAULT '1',
  `access` smallint(6) NOT NULL DEFAULT '10',
  `login_count` int(11) NOT NULL DEFAULT '0',
  `last_visit` int(10) unsigned NOT NULL DEFAULT '0',
  `date_created` int(10) unsigned NOT NULL DEFAULT '0',
  `report` char(1) NOT NULL DEFAULT '0',
  `MailPwd` varchar(30) NOT NULL,
  `smtp` varchar(100) NOT NULL DEFAULT '',
  `ssl` tinyint(1) NOT NULL DEFAULT '0',
  `port` smallint(6) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`) USING BTREE,
  KEY `idx_enable` (`status`) USING BTREE
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_user_table
-- ----------------------------
INSERT INTO `dwin_user_table` VALUES ('1', 'admin', 'admin', 'e10adc3949ba59abbe56e057f20f883e', '97633852@qq.com', '1', '9999', '4', '1499390030', '1496648648', '0', '', '', '0', '0');
INSERT INTO `dwin_user_table` VALUES ('2', 'test', 'test', 'e10adc3949ba59abbe56e057f20f883e', '1234@qq.com', '1', '10', '1', '1496649189', '1496650718', '0', '', '', '0', '0');
INSERT INTO `dwin_user_table` VALUES ('3', 'test2', 'test2', 'e10adc3949ba59abbe56e057f20f883e', '14123423@qq.com', '1', '10', '2', '1496651394', '1496649555', '0', '', '', '0', '0');
INSERT INTO `dwin_user_table` VALUES ('4', 'test3', 'test3', 'e10adc3949ba59abbe56e057f20f883e', '1322343@qq.com', '1', '10', '2', '1496651600', '1496649975', '0', '', '', '0', '0');

-- ----------------------------
-- Table structure for dwin_worklog_main_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_worklog_main_table`;
CREATE TABLE `dwin_worklog_main_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pro_id` mediumint(8) DEFAULT NULL,
  `task_id` int(11) NOT NULL DEFAULT '0',
  `worklog_id` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `pro_id` (`pro_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `worklog_id` (`worklog_id`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_worklog_main_table
-- ----------------------------

-- ----------------------------
-- Table structure for dwin_worklog_table
-- ----------------------------
DROP TABLE IF EXISTS `dwin_worklog_table`;
CREATE TABLE `dwin_worklog_table` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `task_id` int(11) NOT NULL DEFAULT '0',
  `user_id` int(11) NOT NULL DEFAULT '0',
  `status` smallint(4) NOT NULL DEFAULT '0',
  `worktime` float NOT NULL DEFAULT '0',
  `description` text NOT NULL,
  `addtime` date NOT NULL DEFAULT '0000-00-00',
  `uptime` datetime NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`),
  KEY `addtime` (`addtime`) USING BTREE,
  KEY `status` (`status`) USING BTREE,
  KEY `user_id` (`user_id`) USING BTREE,
  KEY `task_id` (`task_id`) USING BTREE,
  KEY `uptime` (`uptime`) USING BTREE
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of dwin_worklog_table
-- ----------------------------
