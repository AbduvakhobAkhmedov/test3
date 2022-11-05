<?php 

	header("access-Control-Allow-Origin:*");
	header("Content-Type: application/json; charset=UTF-8");

	

// подключение базы данных и файл, содержащий объекты
	include_once "../config/database.php";
	include_once "../objects/product.php";

// получаем соединение с базой данных

	$Database =new Database();
	$db = $Database->getConnection();

// инициализируем объект

	$product = new Product($db);

	// чтение товаров будет здесь


	$stmt = $product->read();
	$num = $stmt->rowCount();

	// проверка, найдено ли больше 0 записей

	if ($num>0) {
		$product_arr = array();
		$product_arr["records"] = array();

		   // получаем содержимое нашей таблицы
    // fetch() быстрее, чем fetchAll()

		while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

			//Извлекаем строку

			extract($row);
			$product_item =array(
	"id"=> $id;
	"ФИО"=> $ФИО;
	"Компания"=> $Компания;
	"Датарождения"=> $Датарождения;
	"Телефон"=> $Телефон;
	"email"=> $email;
			);
			array_push($product_arr["records"], $product_item);
		}

		 // устанавливаем код ответа - 200 OK

		http_response_code(200);

		// выводим данные о товаре в формате JSON

		echo json_encode($product_arr);
	}
		else {
			http_response_code(404);
			echo json_encode(array("massage"=> "Товар не найдены.")JSON_UNESCAPED_UNICODE);
		}

 ?>