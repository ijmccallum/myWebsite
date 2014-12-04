<?php

//require_once 'C:\Users\IJ\Projects\myWebsite\Repo\www\experiments\login\constants.php';
require_once '/constants.php';

class mysqlObject {
	private $connection;

	function __construct(){
		$this->connection = new mysqli(DB_SERVER, DB_USER, DB_PASSWORD, DB_NAME) or die('There was a problem connecting to the database');
	}

	function verify_usernam_and_password($un, $pw){
		$query = "	SELECT * 
					FROM users
					WHERE username = ? AND password = ?
					LIMIT 1";
		if($statement = $this->connection->prepare($query)) {
			$statement->bind_param('ss', $un, $pw);
			$statement->execute();

			if($statement->fetch()){
				$statement->close();
				return true;
			}
		}
	}
}

?>