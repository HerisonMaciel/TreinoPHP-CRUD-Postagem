<?php


	abstract class 	Connection
	{

		public static $conn;

		public static function getConn()
		{

			if(self::$conn!=null){
				return self::$conn;
			}	

			self::$conn = new PDO('mysql: host=localhost; dbname=treino-php;', 'root','');

			return self::$conn;

		}
	}