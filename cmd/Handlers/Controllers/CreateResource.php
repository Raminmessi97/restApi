<?php


namespace Cmd\Handlers\Controllers;
use Cmd\Handlers\Handler;

	class CreateResource extends Handler{

		public function handle($key,$value,$filename){
			if($value!==""){
				if($key=="--r"){

						
						$lines = file('app/Http/Controllers/'.$filename.".php");
					for($i=count($lines)-1;$i>=0;$i--)
						{
							if(preg_match("/\}/", $lines[$i]))
								unset($lines[$i]);
								break;
						}


					$arrays_of_method = ['index','create','show','insert'];



					//delete existed methods

					$classname = "\App\Http\Controllers\\".$filename;
					
					$controller = new $classname;

					$existing_methods = new \ReflectionObject($controller);

					// return print_r($existing_methods);

					$methods = $existing_methods->getMethods();

					$all_values = [];

					foreach($methods as $method)
						$all_values[] = $method->name;


					foreach ($arrays_of_method as $key => $value) {
						if(in_array($value, $all_values))
							unset($arrays_of_method[$key]);
					}




					//end of delete block

					$strike_two = "";
					foreach($arrays_of_method as $method){
						$strike_two.="\tpublic function ".$method."(){\n\r \t//body of ".$method."\n\r\t}\n\r\n\r";
					}


				
					$fp = fopen('app/Http/Controllers/'.$filename.".php", 'w') or die("Создать файл не удалось");

					$strike = implode("", $lines);
					
					$text = <<<_END
					$strike
					$strike_two
					}
					_END;

					fwrite($fp, $text);
					fclose($fp);

					echo "\033[32m";
					return "Method ".$value." was added to ".$filename."\033[33m \n";



				}
				else
					return parent::handle($key,$value,$filename);
			}
			else{
				return "Enter value for the key:".$key;
			}

		}

	}