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
		$email->Body = 'You have signed up for email updates for your '.$year.' '.$make.' '.$model.'.';
		$email->AddAddress($address);

		$email->Send();
	}

	function recall_email($address,$username,$make,$model,$year,$summary)
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
                $email->Subject = 'New recall on your '.$year.' '.$make.' '.$model;
                $email->Body = 'Hello '.$username.','."<br>".'A new recall has been found for your '.$year.' '.$make.' '.$model.'. Here is the summary of the recall:'."<br>".$summary;
                $email->AddAddress($address);

		$email->Send();
	}
}
?>
