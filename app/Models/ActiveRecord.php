<?php

namespace App\Models;
use Database\Database;

abstract class ActiveRecord {
	/**
     * 
     * Чтобы  создавать объект один раз (Singleton Pattern)
     */
	private static $instance=null;

	/**
     * 
     * Переменная, которая хранит sql запрос
     */
	private $sql;

	/**
     * 
     * Переменная, которая хранит параметры
     */
	private $params=[];

	/**
     * 
     * Переменная, которая хранит подключение к базе данных
     */
	private $databaseConnect;

	/**
     * 
     * Переменная, используемые для параметров sql запросов
     */
	private $for_pdo_params = 1;

	// Не позволяем клонировать
	private function __clone () {} 
	private function __wakeup () {}


	/**
     * Create singleton instance 
     */


	public static function getInstance(){
		if(self::$instance==null){
			return self::$instance = new static();
		}
		return self::$instance;
	}



	private function __construct(){
		$this->databaseConnect = Database::getInstance();
	}



	/**
     * Метод для получения всех данных (например всех статей)
     */

	public function findAll(){
		$sql = "SELECT * FROM ".static::getTableName();

		$this->params = [];
		$this->sql = $sql;

		return $this;
	}



	/**
     * Метод для получение одной записи
     */
	public function findById($id){
		$sql = "SELECT * FROM ".static::getTableName()." WHERE id=:id";
		$params = ["id"=>$id];

		$this->params = $params;
		$this->sql = $sql;

		return $this;
	}

	/**
     * Метод для получение одной записи
     *@param int $id
     */

	public static function find($id){
		$connect =  Database::getInstance();

		$sql = "SELECT * FROM ".static::getTableName()." WHERE id=:id";
		$params = ["id"=>$id];

		$result = $connect->query($sql,$params,static::class);
		if($result)
			return $result[0];
		else 
			return false;

	}



	/**
     * Задаем дополнительные условия
     */
	public function where($propertyName,$operator,$propertyValue){
		$pdo_name = ":".$propertyName."".$this->for_pdo_params++;
		$this->params[$pdo_name] = $propertyValue;
		$this->sql .= " WHERE ".$propertyName."$operator".$pdo_name;
		return $this;
	}

	/**
     * Задаем дополнительные условия
     */
	public function AndWhere($propertyName,$operator,$propertyValue){
		$pdo_name = ":".$propertyName.$this->for_pdo_params++;
		$this->params[$pdo_name] = $propertyValue;
		$this->sql .= " AND  ".$propertyName.$operator.$pdo_name;
		return $this;
	}

	/**
     * Метод для получения всех данных (например всех статей)
     */
	private function reflection(){
		$reflector  = new \ReflectionObject($this);
		$properties = $reflector->getProperties();
		$mapProperties = [];

		foreach ($properties as $property) {
			$propertyName = $property->getName();
			$mapProperties[$propertyName] = $this->$propertyName;
		}

		return $mapProperties;

	}

	/**
     * Метод создания записи в БД
     */

	public function create(){
		$mapProperties = array_filter($this->reflection()); // delete null values
		$columns = [];
		$values = [];

		foreach($mapProperties as $columnName => $columnValue){
				$columns[] = $columnName;
				$values[] = ":".$columnName;
			}

		$columns = implode(",",$columns);
		$values = implode(",",$values);

		$sql = "INSERT INTO ".static::getTableName()."(".$columns.") VALUES(".$values.")";
		$result = $this->databaseConnect->create($sql,$mapProperties,static::class);

		return $result;
	}

	/**
     * Метод создания записи в БД
     *@param array $data
     */
	public function update($data){
		$id = $this->id;
		$columns = [];
		$values = [];

		$res = "";

		foreach ($data as $column => $value) {
			$res.=$column."=:".$column.",";
			// $values[] = ":".$column;
		}
		$res = trim($res,',');
		$params = $data;

		$sql = "UPDATE ".static::getTableName()." SET ".$res." WHERE id=:id";
		$data['id'] = $id;
		$result = $this->databaseConnect->crud($sql,$data,static::class);
		return $result;
	}



	/**
     * Метод удалание записи из БД
     *@param int $id
     */
	public function delete(){
		$id =  $this->id;
		$sql = "DELETE FROM ".static::getTableName()." WHERE id=:id";

		$array = [":id"=>$id];
		$result = $this->databaseConnect->crud($sql,$array,static::class);
		return $result;
	}

	// 

	// Pagination

	public function get_pag_data($current_page,$limit){
		$offset = ($current_page-1)*$limit;

		$sql = " LIMIT ".$limit." OFFSET ".$offset;
		$this->sql.= $sql;

		return $this;

	}



	/**
     * Конечный метод
     */
	public function get(){
		$sql = $this->sql;
		$params = $this->params;

		$result = $this->databaseConnect->query($sql,$params,static::class);
		return $result;
	}



}

