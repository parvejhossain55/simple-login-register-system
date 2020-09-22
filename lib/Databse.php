<?php 

class Database{

	private $dbhost = 'localhost';
	private $dbuser = 'root';
	private $dbpass = '';
	private $dbname = 'lr';
	public  $pdo;

	function __construct(){
		if (!isset($this->pdo)) {
			try {
				$this->pdo = new PDO("mysql:host=".$this->dbhost.";dbname=".$this->dbname, $this->dbuser, $this->dbpass);
				$this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
			} catch (PDOException $e) {
				echo "Connection error...".$e->getMessage();
			}
		}
	}
}


?>