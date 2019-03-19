<?php 
/**
 * PDO Database Class
 * Connect to database
 * Create prepared statements
 * Bind values
 * Return rows and results
 */

//Setting the class namespace
namespace Sabia;
use PDO;

class Database {
	private $host = DB_HOST;
	private $user = DB_USER;
	private $pass = DB_PASS;
	private $dbname = DB_NAME;

	//database handler
	private $dbh;
	//database statement
	private $stmt;
	//database error
	private $error;

	public function __construct(){
		//SET DSN
		$dsn = 'mysql:host='.$this->host.';dbname='.$this->dbname.';charset-utf8';
		$options = array(
      PDO::ATTR_PERSISTENT => true,
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
			PDO::MYSQL_ATTR_INIT_COMMAND => "SET NAMES 'utf8'"
		);

		//CREATE PDO INSTANCE
		try{
			$this->dbh = new PDO($dsn, $this->user, $this->pass, $options);
		}catch(PDOException $e){
			$this->error = $e->getMessage();
			echo $this->error;
		}
	}

	//PREPARE STATEMENT WITH QUERY
	public function query($sql){
		$this->stmt = $this->dbh->prepare($sql);
	}

	//BIND VALUES INTO QUERY
	public function bind($param, $value, $type = NULL){

		if( is_null($type) ){
			switch (true) {
				case is_int($value):
					$type = PDO::PARAM_INT;
					break;

				case is_bool($value):
					$type = PDO::PARAM_BOOL;
					break;

				case is_null($value):
					$type = PDO::PARAM_NULL;
					break;

				default:
					$type = PDO::PARAM_STR;
			}
		}
		$this->stmt->bindValue($param, $value, $type);
	}

	//EXECUTE THE PREPARED STATEMENT
	public function execute(){
		return $this->stmt->execute();
	}

	//GET RESULT SET AS ARRAY OF OBJECT
	public function resultSet(){
		$this->execute();
		return $this->stmt->fetchAll(PDO::FETCH_OBJ);
	}

	//GET SINGLE RECORD AS OBJECT
	public function single(){
		$this->exeute();
		return $this->stmt->fetch(PDO::FETCH_OBJ);
	}

	//GET ROW COUNT
	public function rowCount(){
		return $this->stmt->rowCount();
	}
}