<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require('/home/test1/git/490/PHPMailer-master/src/Exception.php');
require('/home/test1/git/490/PHPMailer-master/src/PHPMailer.php');
require('/home/test1/git/490/PHPMailer-master/src/SMTP.php');

class emailer
{
	function welcome_email($username, $address, $make, $model, $year)
	{

		$email = new PHPMailer();
		$email->isSMTP();
		$email->SMTPAuth = true;
		$email->Host = 'smtp.gmail.com';
		$email->Port = '587';
		$email->isHTML();
		$email->Username = 'qwertypies490@gmail.com';
		$email->Password = 'cVlQr2w90M';
		$email->SetFrom('qwertypies490@gmail.com');
		$email->Subject = 'Welcome '. $username;
		$email->Body = 'You have signed up for email updates for your '.$year.' '.$make.' '.$model;
		$email->AddAddress($address);

		$email->Send();
	}
}
?>
