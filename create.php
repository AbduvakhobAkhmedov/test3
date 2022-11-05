<?php 

// необходимые HTTP-заголовки

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// получаем соединение с базой данных

include_once "../config/database.php";

// создание объекта товара

include_once "../objects/product.php"
$database = new Database();
$db = $database->getContents();
$product = new Product($db);

// получаем отправленные данные

$data = json_decode(file_get_contents("php://input"));

// убеждаемся, что данные не пусты

if (
	!empty($data->name) &&
	!empty($data->price) &&
	!empty($data->description) &&
	!empty($data->category_id)

) {
	// устанавливаем значения свойств товара

	$product->name = $data->name;
	$product->price=$data->price;
	$product->description=$data->description;
	$product->category_id=$data->category_id;
	$product->created(date("Y-m-d"));

// создание товара

	if ($product->create) {
		// установим Код ответа - 201 создано
		http_response_code(201);

//сообщим пользователю

		echo json_encode(array("message" => "Товар был созданю"), JSON_UNESCAPED_UNICODE);
	}
//если не удается создать товар, сообщим пользователю

	else json_encode(array("message"=> "Невозможно создать товарю") JSON_UNESCAPED_UNICODE);
	}
}
// сообщаем пользователю что данные неполные

	else {
		// установка код ответа - 400 неверный запрос

		http_response_code(400);

		//сообщим пользователю

		echo json_encode(array("message"=> "Невозможно создать товар. Данные неполные.") JSON_UNESCAPED_UNICODE);
	}






 ?>