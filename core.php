<?php 

// показывать сообщения об ошибках
ini_set("display_errors", 1);
error_log(E_ALL);

//URL домашней страницы
$home_url = "http://localhost/api/";

// страница указана в параметры URL, страница по умолчанию одна
$page = isset($_GET["pahe"]) ? $_GET["page"] : 1;

// установим количество записей на странице
$record_per_page = 5;

// расчет для запроса предела записей
$from_record_num = ($record_per_page * $page) - $records_per_page;


 ?>