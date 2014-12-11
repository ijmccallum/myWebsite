<?php


class sendMessage {
	function sendEmail($from, $message){
		//$fromClean = sanitizeInput($from);
		//$messageclean = sanitizeInput($message);
		
		//Wrap the message if it's longer than 70 chars
		$msg = "From: " . $from . "\nMessage: " . wordwrap($message,70);
		$subjectLine = "iainjmccallum.com: " . $from;

		mail("ijmccallum@hotmail.co.uk", $subjectLine, $msg);
		mail("iainjmccallum@gmail.com", $subjectLine, $msg);
	}

}

?>