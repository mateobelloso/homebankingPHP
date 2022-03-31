<?php
	class Db
	{

		function __construct()
		{
		}
		public static function connect()
		{
			$link= mysqli_connect('localhost','root','','sqlhb') or die("Error".mysqli_error($link));
			return $link;
		}
	}
?>