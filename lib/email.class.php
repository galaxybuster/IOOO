<?php
	require_once(__DIR__ . "/config.class.php");

	class Email {

		public function __construct() {

		}

		public function sendEmail($to, $subject, $body, $isHtml) {
			if ($GLOBALS['config']['local'] == true) {
				// Running on a local server, so store emails as HTML files
				$msg = "<p>".$to."</p>";
				$msg .= "<p>".$subject."</p><hr/>";
				$msg .= $body;
				
				file_put_contents('emails/'.date('Y.m.d-H.i.s').'.html', $msg);
			} else {
				// Running on a remote server. Send that email

				$headers  = 'MIME-Version: 1.0' . "\r\n";
				$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";

				// Additional headers
				$headers .= 'To: <'.$to.'>' . "\r\n";
				$headers .= 'From: IOOO <IOOO@mz-80k.com>' . "\r\n";

				mail($to, $subject, $body, $headers);
			}
		}
	}