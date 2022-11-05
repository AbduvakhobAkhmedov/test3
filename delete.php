<?php 

// HTTP - зашаловок
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");
header("Access-Control-Allow-Methods: POST");
header("Access-Control-Max-Age: 3600");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, Authorization, X-Requested-With");

// подключаем файл для соединения с базой и обЬектом Product
include_once "../config/database.php";
include_once "../objects/product.php";

// получаем соединение с БД
$database = new Database();
$db = $database->getConnection();

//подготовка обЬекта
$product = new Product($bd);

// получаем id товара
$data = json_decode(file_get_contents("php://input"));

// установим id товара для удаления
$product->id=data->id;

// удаление товара
if ($product->delete()) {
	// код ответа - 200 ок
	http_response_code(200);

	// сообщение пользователю
	echo json_encode(array("massage"=> "Товар был удален"), JSON_UNESCAPED_UNICODE);
}

// если не удается удалит товар
else {
	// код ответа - 503 сервис не доступен
	http_response_code(503);

	// сообщим об этом рользователю
	echo json_encode(array("massage" => "Не удалось удалить товар"));
}


 ?>