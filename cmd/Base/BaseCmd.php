<?php

namespace Cmd\Base;



trait BaseCmd{

	private static $one_minuse_arrays;
	private static $two_minuse_arrays;

	private static $name;


	public function getParams($name,$params){

		static::$one_minuse_arrays["-name"] = $name;

		static::$name = $name;
		
			for ($i=0; $i<count($params); $i++) { 
				if($params[$i][0]==='-'&&$params[$i][1]!='-'){

					if(array_key_exists($i+1, $params)&&$params[$i+1][0]!=="-")
						static::$one_minuse_arrays[$params[$i]]=$params[$i+1];
					else 
						static::$one_minuse_arrays[$params[$i]] = "";
				}

				if($params[$i][0]==='-'&&$params[$i][1]==='-'){
					static::$two_minuse_arrays[$params[$i]] = null;
				}
			}

	}

	public static function call_all_functions($handler){

		$filename = self::modifyClassName(self::$name);

		foreach (self::$one_minuse_arrays as $key => $value) {
			$result = $handler->handle($key,$value,$filename);
			if($result){
				echo $result;
			}
			else
				echo "Undefined key: ".$key;
		}

		if(!empty(self::$two_minuse_arrays)){
			foreach(self::$two_minuse_arrays as $key => $value) {
				$result = $handler->handle($key,$value,$filename);
				if($result){
					echo $result;
				}
				else
					echo "Undefined key: ".$key;
			}
		}
		
	}


	private static function modifyClassName($filename){
		$array = [];

		$array['for_open_file'] = $filename;

		// Api/ArticleController for example
		if(preg_match("~/~", $filename)){
			$value2 = explode("/", $filename);

			$count = count($value2);
			$new_array = array_slice($value2, 0,$count-1);

			if(!empty($new_array)){
				$namespaceName = implode($new_array,"\\");
				$array['namespace'] = "\\".$namespaceName;
			}

			$value3 = $value2[$count-1];
			$array['classname'] = $value3;
		}else{
			$array['namespace'] = "";
			$array['classname'] = $filename;
		}

		// 

		return $array;
	}
   


}
