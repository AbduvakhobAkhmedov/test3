<?php 

// установим НТТР-загаловок
header("Access-Control-Allow-Origin: *");
header("Content-Type: application/json; charset=UTF-8");

// подключение файлов
include_once "../config/core.php";
include_once "../shared/utilities.php";
include_once "../config/database.php";
include_once "../objects/product.php";

// utilities
$utilities = new Utilities();

// создание подключения
$database = new Database();
$db = $database->getConnection();

// инициализация обЬекта
$product = new Product($db);

// запрос товаров
$stmt = $product->readPaging($from_record_num, $record_per_page);
$num = $stmt->rowCount();

// если больше 0 записей
if ($num > 0) {
	// массив товаров
	$product_arr = array();
	$product_arr["records"]= array();
	$product_arr["paging"]= array();

	// получаем содержимое нашей таблицы
	while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){

		// извлечение строки
		extract($row);
		$product_item = array(
			"id" => $id,
			"name" => $name,
			"Description" => html_entity_decode($description),
			"price" => $price,
			"category_id" => $category_id,
			"category_name" => $category_name);
		array_push($product_arr["records"], $product_item);
	}

	// подключаем пагинацию
	$total_rows = $product->count();
	$page_url = "{$shome_url}product/read_paging.php?";
	$paging = $utilities->getPaging($page, $total_rows, $record_per_page, $page_url);
	$product_arr["paging"] = $paging;

	// установим код ответа - 200 ок
	http_response_code(200);

	//вывод в json-формате
	echo json_encode($product_arr);
} else {

	// код ответа - 404 Ничего не найдено
	http_response_code(404);

	// сообщим пользователю, что товар не существует
	echo json_encode(array("massage" => "Товары не найдены"), JSON_UNESCAPED_UNICODE);
}



 ?>