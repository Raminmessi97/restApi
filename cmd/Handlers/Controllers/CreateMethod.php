<?php  

namespace Cmd\Handlers\Controllers;
use Cmd\Handlers\Handler;

	class CreateMethod extends Handler{

		public function handle($key,$value,$filename){
			if($value!==""){
				if($key=="-f"){

					$classname2 = "\App\Http\Controllers\\".$filename['classname'];
					$controller = new $classname2;
					$existing_methods = new \ReflectionObject($controller);
					$methods = $existing_methods->getMethods();
					$all_values = [];

					foreach($methods as $method)
						$all_values[] = $method->name;

					if(in_array($value, $all_values))
						return 'Method is already existed';
					else
					{
							
					$lines = file('app/Http/Controllers/'.$filename.".php");
					for($i=count($lines)-1;$i>=0;$i--)
						{
							if(preg_match("/\}/", $lines[$i]))
								unset($lines[$i]);
								break;
						}



					
					$namespaceName = "App\Http\Controllers".$filename['namespace'];
					$className = $filename['classname'];
					$for_open_file= $filename['for_open_file'];

					$fp = fopen('app/Http/Controllers'.$for_open_file.".php", 'w') or die("Создать файл не удалось");

					$strike = implode("", $lines);
					
					$text = <<<_END
					$strike
						public function $value(){
							//body of $value
						}
					}
					_END;

					fwrite($fp, $text);
					fclose($fp);

					echo "\033[32m";
					return "Method ".$value." was added to ".$className."\033[33m \n";
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