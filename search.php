<?php 

// HTTP - загаловки 
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение необходимых файлов
include_once "../config/core.php";
include_once "../config/database.php";
include_once "../objects/product.php";

// создание подключения к БД
$database= new Database();
$db = $database->getConnection();

// инициализируем обЬект
$product=new Product($db);

// получаем ключевые слова
$keywords = isset($_GET["s"]) ? $_GET["s"] : "";

// запрос товара
$stmt = $product->seach($keywords);
$num = $stmt->rowCount();

// проверяем, найдено ли больше 0 записей
if ($num > 0) {
	// массив товара
	$product_arr=array();
	$product_arr["records"] = array();

	//получаем содержимое нашей таблицы
	// fetch() быстрее чем fetchAll()
	while ($row = $stmt ->fetch(PDO::FETCH_ASSOC)) {
		// извлечем строку
		extract("$row");
		$product_item = array(
			"id"=>$id,
			"name"=> $name,
			"Description"=>html_entity_decode($description),
			"price"=>$price,
			"category_id"=>$category_id,
			"category_name"=>$category_name);
		array_push($product_arr["records"], $product_item)
	}
	// код ответа - 200 ок
	http_response_code(200);

	// покажем товары
	echo json_encode($product_arr);
} else {

	// код ответа - 404 ничего не найдено
	http_response_code(404);

	// скажем пользователю, что товары не найдены
	echo json_encode(array("massage" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);
}

 ?>