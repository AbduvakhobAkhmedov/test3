<?php 

// НТТР - загаловок

header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключения файл для работы с БД и обЬектом Product

include_once "../config/database.php";
include_once "../objects/product.php";

// получаем соединение с бд

$database = new Database();
$db = $database->getConnection;

// подготовка обЬекта

$product= new Product($db);

// получаем id  товара для редактирования

$data = json_decode(file_get_contents("php://input"));

// установим id товара для редактирования

$product->id = $data->id;

// установка значения свойства товара

$product->name=$data->name;
$product->price=$data->price;
$product->description=$data->description;
$product->category_id=$data->category_id;

// обновление товара

if ($product->update()) {
	// установим код ответа- 200 ок

	http_response_code(200);

	// сообщим пользователю
	echo json_encode(array("massage"=> "Товарбыл обновлён"), JSON_UNESCAPED_UNICODE);
}

// если не удается обновить товар, сообщим пользователю
else {
	// код ответа - 503 Сервис не доступен
	http_response_code(503);

	// сообщение пользователю
	echo json_encode(array("massage"=>"Невозможно обновить товар"), JSON_UNESCAPED_UNICODE);
}

 ?>