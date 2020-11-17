<?php


namespace Cmd\Handlers\Controllers;
use Cmd\Handlers\Handler;

	class CreateResource extends Handler{

		public function handle($key,$value,$filename){
			if($value!==""){
				if($key=="--r"){
					$lines = file('app/Http/Controllers/'.$filename['for_open_file'].".php");
					for($i=count($lines)-1;$i>=0;$i--)
						{
							if(preg_match("/\}/", $lines[$i]))
								unset($lines[$i]);
								break;
						}


				$arrays_of_method = ['index','show','create','store','edit','update','delete'];


				$namespaceName = "App\Http\Controllers".$filename['namespace'];
				$className = $filename['classname'];
					
$content = "<?php\n\r";
$content.="namespace $namespaceName;\n\r";
$content.='use App\Views\View;
use App\Useful_funcs\Defeat;
use App\Useful_funcs\Redirect;
use App\Http\Request;';
$content.="\n\r\n\rclass $className{\n\r";
$content.='/**
	     * Display a listing of the resource.
	     *
	     */
		public function index(){
		}		
		/**
	     * Show the form for 
	     * @param int $id
	     */
		public function show($id){

		}

		/**
	     * Show the form for creating a new resource.
	     *
	     */
		public function create(){

		}

		/**
	     * Store a newly created resource in storage.
		 *@param Request $request;
	     */
		public function store(Request $request){

		}

		/**
	     * Show the form for editing the specified resource.
	     */
		public function edit($id){
			
		}

		/**
	     * Update the specified resource in storage.
	     * @param  Request $request
	     * @param  int  $id
	     */
		public function update(Request $request,$id){
			
		}

		/**
	     * Remove the specified resource from storage.
	     *
	     * @param  int  $id
	     */
	    public function delete($id)
	    {
	    	
	   	}';
	   $content.="\n\r}";



				
					$fp = fopen('app/Http/Controllers/'.$filename['for_open_file'].".php", 'w') or die("Создать файл не удалось");

					fwrite($fp, $content);
					fclose($fp);

					echo "\033[32m";
					return "Methods: ".implode(",",$arrays_of_method)." were added to ".$className."\033[33m \n";
				}
				else
					return parent::handle($key,$value,$filename);
			}
			else{
				return "Enter value for the key:".$key;
			}

		}

	}