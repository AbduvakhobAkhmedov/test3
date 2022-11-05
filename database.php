<?php 
class Database
{

	  private $host = "localhost";
    private $db_name = "api_db";
    private $username = "root";
    private $password = "";
    public $conn;


    public function getConnection()
    {
    	$this->conn=null;

    	try {
    		$this->conn = new PDO("mysql:host=" .$this->host. ";dbname=" .$this->db_name, $this->username, $this->$this->conn->exec("set names utf8"));
    	} catch (PDOException $exception){
    		echo "Ошибка ПОДКЛЮЧЕНИЯ:" .$exception->getMessage();
    	}
    	return $this->conn;
    	
    }
}




 ?>