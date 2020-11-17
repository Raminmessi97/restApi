<?php  

namespace Cmd\Handlers\Controllers;
use Cmd\Handlers\Handler;

class CreateController extends Handler{
	
		public function handle($key,$value,$filename){
			if($value!==""){
				if($key=="-name"){
					
					if(file_exists("app/Http/Controllers/".$value.".php")){
						echo "\033[31m"; //for color
						return "This controller was already created"."\033[33m  \n\r";
					}
					else{

						$fh = fopen("app/Http/Controllers/".$value.".php", "w") or die("Создать файл не удалось");


						$namespaceName = "App\Http\Controllers".$filename['namespace'];
						$className = $filename['classname'];

						$text = <<<_END
						<?php
						namespace $namespaceName;	\n\r
						class $className  {
							//body of controller
						}
						_END;

						fwrite($fh,$text);
						fclose($fh);
						echo "\033[32m";

						return "Controller: ".$value." was created successfully"."\033[33m \n\r";
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