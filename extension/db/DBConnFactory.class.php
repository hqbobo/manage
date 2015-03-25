<?php

class DBConnFactory
{
	const DB_INFO = 'mysql5.3.8';
	const DB_HOST = '127.0.0.1';
	const DB_USER = 'root';
	const DB_PWD = '123456';
	const DB_NAME = 'admin';

	private static $_connection = null;

	public static function instance()
	{
		if (empty(self::$_connection)) {
			self::$_connection = @new mysqli(self::DB_HOST,self::DB_USER,self::DB_PWD,self::DB_NAME);
			if (mysqli_connect_errno()) {
				//printf("</br>Connect failed: %s\n", mysqli_connect_error());
				return false;
			}
		}

		return self::$_connection;
	}
}
?>