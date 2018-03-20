<?php
	$msg_box = ""; // в этой переменной будем хранить сообщения формы
	$errors = array(); // контейнер для ошибок
	// проверяем корректность полей
	if($_POST['user_name'] == "") 	 $errors[] = "Поле 'Имя' не заполнено!";
	if($_POST['user_phone'] == "") 	 $errors[] = "Поле 'Телефон' не заполнено!";

	// если форма без ошибок
	if(empty($errors)){		
		// собираем данные из формы
		$message  = "Имя: " . $_POST['user_name'] . "<br/>";
		$message .= "Номер: " . $_POST['user_phone'] . "<br/>";	
		send_mail($message); // отправим письмо
		// выведем сообщение об успехе
		$msg_box = "<div style='text-align: center;'><span style='color: #543D6A; background-color: #B9E740'>Сообщение успешно отправлено!</span></div>";
	}else{
		// если были ошибки, то выводим их
		$msg_box = "";
		foreach($errors as $one_error){
			$msg_box .= "<span style='color: red;'>$one_error</span><br/>";
		}
	}

	// делаем ответ на клиентскую часть в формате JSON
	echo json_encode(array(
		'result' => $msg_box
	));
	
	
	// функция отправки письма
	function send_mail($message){
		// почта, на которую придет письмо
		$mail_to = "dverprofi@gmail.com"; 
		// тема письма
		$subject = "Заявка на звонок";
		
		// заголовок письма
		$headers= "MIME-Version: 1.0\r\n";
		$headers .= "Content-type: text/html; charset=utf-8\r\n"; // кодировка письма
		$headers .= "From: DverProfi <no-reply@test.com>\r\n"; // от кого письмо
		
		// отправляем письмо 
		mail($mail_to, $subject, $message, $headers);
	}
	
