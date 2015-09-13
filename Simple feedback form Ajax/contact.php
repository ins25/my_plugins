<?php
$post = (!empty($_POST)) ? true : false;
if($post) {
	$email = trim($_POST["email"]);
	$name = htmlspecialchars($_POST["name"]);
	$email = htmlspecialchars($_POST["email"]);
	$tel = htmlspecialchars($_POST["tel"]);
	$error = "";

	if(!$name) {
		$error .= "<p>Пожалуйста, введите ваше имя.</p>";
	}
	if(!$email)	{
		$error .= "<p>Пожалуйста, введите e-mail.</p>";
	}
	if(!$tel){
		$error .= "<p>Пожалуйста, введите телефон.</p>";
	}

	// Проверка поля e-mail
	function ValidateEmail($value){
		$regex = "/^([a-zA-Z0-9])+([\.a-zA-Z0-9_-])*@([a-zA-Z0-9_-])+(\.[a-zA-Z0-9_-]+)*\.([a-zA-Z]{2,6})$/";
		if($value == "") {
			return false;
		} else {
			$string = preg_replace($regex, "", $value);
		}
		return empty($string) ? true : false;
	}	
	if($email && !ValidateEmail($email)) {
		$error .= "Введите корректный e-mail.";
	}

	if(!$error)	{
		$subject ="Новое сообщение от клиента!";
		$message ="Новый заказ!\n\nE-mail: ".$email."\n\nИмя: " .$name."\n\nТелефон:".$tel."\n\n";
		$mail = mail("konyulichalex@gmail.com", $subject, $message,
		"From: ".$name." <".$email."> "."Reply-To: ".$email." "." X-Mailer: PHP/" . phpversion());
		if($mail) {
			echo 'OK';
		}
	}
	else{
		echo '<div class="notification_error">'.$error.'</div>';
	}
}
?>