<?php

namespace App\Http;

class Request {

	/**
     *Получает данные и преобразовавыет их
     *
     * @param string $data
     */
	public static function getData($data){
      	$data = explode("&", $data);

      	$result = [];

      	foreach ($data as $key) {
      		$del = explode("=", $key);
      		$result[$del[0]] = urldecode($del[1]);
      	}

      	$object = new Request();
    		foreach ($result as $key => $value)
    		{
    		    $object->$key = $value;
    		}

      	return $object;

	}
}