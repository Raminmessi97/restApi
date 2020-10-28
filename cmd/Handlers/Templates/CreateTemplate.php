<?php  

namespace Cmd\Handlers\Templates;
use Cmd\Handlers\Handler;

class CreateTemplate extends Handler{

		public function handle($key,$value,$filename){
			if($value!==""){
				if($key=="-name"){
					
					if(file_exists("resources/views/".$value.".php")){
						echo "\033[31m"; //for color
						return "This Template was already created"."\033[33m \n\r";
					}
					else{

						$ff = explode("/", $value);
						$folder_name =$ff[0];
						$filename= $ff[1];


						mkdir("resources/views/".$folder_name);

						$fh = fopen("resources/views/".$folder_name."/".$filename.".php", "w") or die("Создать файл не удалось");
						$text = <<<_END
						<!DOCTYPE html>
						<html>
						<head>
						    <title>title</title>
						    <meta charset="utf-8">
						</head>
						<body>
						</body>
						</html>
						_END;

						fwrite($fh,$text);
						fclose($fh);
						echo "\033[32m";

						return "Template: ".$value." was created successfully"."\033[33m \n";
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