<?php 
class product

function readOne()
{

// запрос для читение одной записи (товара)
	$query = "SELECT
		c.name as category_name, p.id, p.name, p.description, p.category_id, p.created
		FROM 
			".$this->table_name." p
			LEFT JOIN
				categories c
					On p.category_id=c.id
		WHERE
			p.id=?
		LIMIT
		  	0,1";

// подготовка запроса
	$stmt->bindParam(1, $this->id);

// выполняем запрос
	$stmt->execute();

// получаем изслеченую строку
	$row=$stmt->fetch(PDO::FETCH_ASSOC);

//Установим значения свойств обЬекта

	$this->name=$row["name"];
	$this->price=$row["price"];
	$this->description=$row["description"];
	$this->category_id=$row["category_id"];
	$this->category_name=$row["category_name"];
}

function create(){

// запрос для вставки (создания) записей

	$query="INSERT INTO
		".$this->table_name."
	SET
		name=:name, price=:price, description=:description, category_id=:category_id, created=:created";

// подготовка запроса
	$stmt=$this->conn->prepare($query);

// очистка

	$this-> name=htmlspecialchars(strip_tags($this->name));
	$this->price=htmlspecialchars(strip_tags($this->price));
	$this->description=htmlspecialchars(strip_tags($this->description));
	$this->category_id=htmlspecialchars(strip_tags($this->category_id));
	$this->created=htmlspecialchars(strip_tags($this->created));

// привязка значений

	$stmt->bindParam(":name", $this->name);
	$stmt->bindParam(":price", $this->price);
	$stmt->bindParam(":description", $this->description);
	$stmt->bindParam(":category_id", $this->category_id);
	$stmt->bindParam(":created", $this->created);

// выполняем запрос

	if ($stmt->execute()) {
		return true;
	}
	return false;
}
{
	private $conn;
	private $table_name = "products";

	public $id;
	public $ФИО;
	public $Компания;
	public $Датарождения;
	public $Телефон;
	public $email;

	public function__construct($db)

	{
		$this->conn = $db;
	}

	// метод обновление товара

	function update()
	{
		// запрос для обновления записи(товара)
		$query="UPDATE 
			".$this->table_name."
		SET 
			mame=:name,
			price=:price,
			description=:description,
			category_id=:category_id
		WHERE
			id=:id";

	// подготовка запроса
	$stmt=$this->conn->prepare($query);

	// очистка
	$this->name=htmlspecialchars(strip_tags($this->name));
	$this->price=htmlspecialchars(strip_tags($this->price));
	$this->description=htmlspecialchars(strip_tags($this->description));
	$this->category_id=htmlspecialchars(strip_tags($this->category_id));
	$this->id=htmlspecialchars(strip_tags($this->id));

	// привязываем значения

	$stmt->bindParam(":name", $this->name);
	$stmt->bindParam(":price", $this->price);
	$stmt->bindParam(":description", $this->description);
	$stmt->bindParam(":category_id", this->category_id);
	$stmt->bindParam(":id", $this->id);

	// выполняем запрос
	if ($stmt->execute) {
		return true;
	}
	return false;
}

// метод для удаление товара
function delete()
{
	// запрос для удаления записи (товара)
	$query= "DELETE FROM" .$this->table_name. "WHERE id = ?";

	// подготовка запроса
	$stmt=$this->conn->prepare($query);

	// очистка

	$this ->id= htmlspecialchars(strip_tags($this->id));

	// привязываем id записи для удаления
	$stmt->bindParam(1, $this->id);

	// выполняем запрос
	if ($stmt->execute()) {
		return true;
	}
	return false;
}

function search($keywords)
{
	// поиск записей (товаров) по "названию товара", "описанию товара", "названию категории"
	$query = "SELECT
		c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
	FROM
		".$this->table_name." p
		LEFT JOIN
			categories c
				ON p.category_id=c.id
	WHERE
		p.name LIKE ? OR p.description LIKE ? OR c.name LIKE ?
	ORDER BY
		p.created DESC";

	// подготовка запроса
	$stmt = this->conn->prepare($query);

	// очистка
	$keywords = htmlspecialchars(strip_tags($keywords));
	$keywords = "%{$keywords}%";


	// привязка
	$stmt->bindParam(1, $keywords);
	$stmt->bindParam(2, $keywords);
	$stmt->bindParam(3, $keywords);

	// выполняем запрос
	$stmt->execute();

	return $stmt;
}


// получение товаров с пагинацией
public function readPaging($from_record_num, $record_per_page)
{
	// выборка
	$query = "SELECT
		c.name as category_name, p.id, p.name, p.description, p.price, p.category_id, p.created
	FROM
		".$this->table_name." p
		LEFT JOIN
			categories c
				ON p.category_id = c.id
	ORDER BY p.created DESC
	LIMIT ?, ?"

	// подготовка запроса
	$stmt->bindParam(1, $from_record_num, PDO::PARAM_INT);
	$stmt->bindParam(2, $record_per_page, PDO::PARAM_INT);

	// выполняем запрос
	$stmt->execute();

	// вернем значения из БД
	return $stmt;
}


// данные метода возвращает количествово товаров
public function count()
{
	$query = "SELECT COUNT(*) as total_rows" .$this->table_name. "";
	
	$stmt = $this->conn->prepare($query);
	$stmt->execute();

	$row = $stmt->fetch(PDO::FETCH_ASSOC);

	return $row["total_rows"];
}


function read()
	{
		 // выбираем все записи
		$query= "SELECT
		c.name as category_name, p.id, p.ФИО, p.Компания, p.Датарождения, p.Телефон, p.email FROM
	FROM
		".$this->table_name ." p 
		LEFT JOIN
			categories c 
				ON p.category_id=c.id
	ORDER BY
		p.created DESC";

	// подготовка запроса

	$stmt->execute();
	return $stmt;
}

}










 ?>