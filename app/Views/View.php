<?php

namespace App\Views;

class View{

	


     /**
     * Метод, вызывающий нужный нам template
     *
     * @param  string $template,array $data
     * @return \Illuminate\Http\Response
     */

	public static function view($template,$data=[]){

		// Registry all data for all views 
		$app = \App\Providers\Registry::instance(); //
		$objects = $app->start();
		
		foreach ($objects as $key => $value) {
			$data[$key] = $value;
		}

		$main_path ="resources/views/";
		$template.=".php";
		$template =PROJECT_ROOT.$main_path.$template;
		
		extract($data);
		require_once($template);


	}


}
