<?php 

class Category
{
	// соединяем с БД и таблицей "categories"
	private $conn;
	private $table_name = "Categories";

	// свойства обЬекта
	public $id;
	private $name;
	public $description;
	public $created;

	public function __construct($db)
	{
		$this->conn = $db;
	}

	// метов для получения всех категори товаров
	public function readAll()
	{
		$query = "SELECT
				id, name, description
			FROM
				".$this->table_name."
			ORDER BY
				name";

		$stmt = $this->conn->prepare($query);
		$stmt->execute();

		return $stmt;
	}
}



 ?>