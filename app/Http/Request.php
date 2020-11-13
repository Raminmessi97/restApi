<?php

namespace App\Http;

class Request {

	/**
     *Получает данные и преобразовавыет их
     *
     * @param string $data
     */
	public static function getData($data){
      	 
        $new_data = explode("&", $data['request_data']);
      	$result = [];

      	foreach ($new_data as $key) {
      		$del = explode("=", $key);
      		$result[$del[0]] = urldecode($del[1]);
      	}

      	$object = new Request();
    		foreach ($result as $key => $value)
    		{
    		    $object->$key = $value;
    		}

        if($data['fileData']){
          $object->files = $data['fileData'];
        }



      	return $object;

	}


  /**
     *Получает данные и преобразовавыет их
     *
     * @param array $data
  */
  public static function getRequestData($data){
       
        $new_data = $data['request_data'];

        $object = new Request();
        foreach ($new_data as $key => $value)
        {
            $object->$key = $value;
        }

        if($data['fileData']){
          $object->files = $data['fileData'];
        }


        return $object;

  }
}