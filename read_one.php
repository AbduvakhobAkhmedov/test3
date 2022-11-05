<?php 

// необходимо HTTP - загаловок

header("Access-Control-Allow-Origin: *");
header("Access-Control-Allow-Headers: access");
header("Access-Control-Allow-Methods: GET");
header("Access-Control-Allow-Credentials: true");
header("Content-Type: application/json");


// получаем соединение с базой данных
$database = NEW Database();
$db = $database->getConnection();

// подготовка обЬекта

$product=new Product($db);

// установка свойство ID записи для чтения

$product-> id = isset($_GET["id"]) ? $_GET["id"] : die();

// получим детали товара

$product->readOne();

if ($product->name != null) {
	// создание массива
	$product_arr = array(
		"id" => $product->id,
		"name"=> $product->name
		"Description" => $product->description,
		"price"=> $product->price,
		"category_id"=>$product->category_id,
		"category_name"=> $product->category_name
	);
// код ответа - 200 ок
	http_response_code(200);

// вывод в форме json

	echo json_encode($product_arr);
} else {
// код ответа - 404 не найдено

	http_response_code(404);

// сообщим пользователю, что такой товар не существует
	echo json_encode(array("massage"=> "Товар не существует"), JSON_UNESCAPED_UNICODE);
 }


 ?>
