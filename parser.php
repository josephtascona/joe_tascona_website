<?php
ini_set("include_path", '/home1/joetascona/php:' . ini_get("include_path") );
if( isset($_POST['n']) && isset($_POST['e']) && isset($_POST['m']) ){
  require_once "environment.php";
  require_once "../php/Mail.php";
  include('../php/Mail/mime.php');
  $n = $_POST['n'];
	$e = $_POST['e'];
  $s = $_POST['s'];
	$m = nl2br($_POST['m']);
  $from = $e;
  $to = $_ENV["MAIL_TO"];
  $subject = $s;
  $host = $_ENV["MAIL_HOST"];
  $port = "465";
  $username = $_ENV["MAIL_USER"];
  $password = $_ENV["MAIL_PASS"];
  $html = '<b>Name:</b> '.$n.' <br><b>Email:</b> '.$e.' <p>'.$m.'</p>';
  $crlf = "\n";
  $headers = array ('From' => $from,
    'To' => $to,
    'Subject' => $subject);
  $mime = new Mail_mime($crlf);
  $mime->setHTMLBody($html);
  $body = $mime->get();
  $headers = $mime->headers($headers);
  $smtp = Mail::factory('smtp',
    array ('host' => $host,
      'port' => $port,
      'auth' => true,
      'username' => $username,
      'password' => $password));
  $mail = $smtp->send($to, $headers, $body);
  if (PEAR::isError($mail)) {
    echo("The message failed to send. Please try again.");
   } else {
    echo("success");
   }
}
?>
