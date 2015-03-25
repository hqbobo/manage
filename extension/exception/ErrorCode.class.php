<?php
class ErrorCode{
	const E_SUCCESS = 0;
	const E_ERROR = 0x01;
	const E_WARNING = 0x02;
	const E_PERMISSIONS = 0x03;
	const E_WRONG_PWD = 0x04;
	const E_LOGIN_FAIL = 0x05;
	const E_UNKOWN_ACT = 0x06;
	const E_DB_ERR = 0x07;
	const E_DB_DUPLICATE = 0x08;
	const E_UNAUTHORIZED_USER = 0x9;
	const E_PROEJCTNAME_TOO_LONG = 0xa;
	const E_MONTH = 0xb;
	const E_DAY = 0xc;
	const E_INVALID_PRAMETER = 0xd;
	const E_LEVEL_REQUIRED = 0xe;
	const E_DB_EMPTY = 0xf;
	const E_USER__DUPLICATE = 0x10;
	public $err = array (
		self::E_SUCCESS => array('descr' => '成功'),
		self::E_ERROR => array('descr' => 'Error occured'),
		self::E_WARNING => array('descr' => 'Warning'),
		self::E_PERMISSIONS => array('descr' => 'no access permission'),
		self::E_WRONG_PWD => array('descr' => '无效密码'),
		self::E_LOGIN_FAIL => array('descr' => '无效密码或用户名'),
		self::E_UNKOWN_ACT => array('descr' => 'unkown action.'),
		self::E_DB_ERR => array('descr' => 'unkown DB error contact customer service.'),
		self::E_DB_DUPLICATE => array('descr' => 'given message exist.'),
		self::E_UNAUTHORIZED_USER => array('descr' => '非法用户.'),
		self::E_PROEJCTNAME_TOO_LONG => array('descr' => '项目名称太长.'),
		self::E_MONTH => array('descr' => '无效月份  1 - 12.'),
		self::E_DAY => array('descr' => '无效日期  1 - 30.'),
		self::E_INVALID_PRAMETER => array('descr' => '包含无效参数请检查'),
		self::E_LEVEL_REQUIRED => array('descr' => '权限不足'),
		self::E_DB_EMPTY => array('descr' => '空数据'),
		self::E_USER__DUPLICATE => array('descr' => '用户名存在'),
	);
	public static function GetErr($id)
	{		
		$err = new ErrorCode();
		return  $err->err[$id]['descr'];
	}
}
?>