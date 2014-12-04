<?php

require '/mysql.php';

class membership {
	function validateUser($un, $pw){
		$mysql = New mysqlObject();
		$ensure_credentials = $mysql->verify_usernam_and_password($un, $pw);

		if($ensure_credentials){
			$_SESSION['status'] = 'authorized';
			header('location: index.php');
		} else return "please enter correct details";
	}

	function log_user_out(){
		if(isset($_SESSION['status'])){
			unset($_SESSION['status']);	
			if(isset($_COOKIE[session_name()])) setcookie(session_name(),'',time() - 10000);
			session_destroy();
		}
	}

	function confirm_member(){
		if($_SESSION['status'] != 'authorized') header("location: login.php");
	}
}

?>