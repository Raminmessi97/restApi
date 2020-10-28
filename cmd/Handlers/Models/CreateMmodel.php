<?php 

namespace Cmd\Handlers\Models;
use Cmd\Handlers\Handler;


class CreateMmodel extends Handler{

public function handle($key,$value,$filename){
	if($value!==""){
		if($key=="-name"){

			$tableName = strtolower($value);
			$tableName.="s";

		if(file_exists("app/Models/".$value.".php")){
			echo "\033[31m"; //for color
			return "This Model was already created"."\033[33m  \n\r";
		}
		else{
			$fh = fopen("app/Models/".$value.".php", "w") or die("Создать файл не удалось");
			$text = <<<_END
			<?php
			namespace App\Models;	\n\r
			class $value extends ActiveRecord {
				//body of controller\n\r
				protected static function getTableName(){
					return "{$tableName}";
				}
			}
			_END;

			fwrite($fh,$text);
			fclose($fh);

			echo "\033[32m";
			return "Model: ".$value." was created successfully"."\033[33m \n";
		}

			
		}
		else
			return parent::handle($key,$value,$filename);
	}
	else{
		return "Enter value for the key:".$key;
	}

}

}