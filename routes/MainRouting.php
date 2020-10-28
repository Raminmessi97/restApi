<?php  

namespace Router;


class MainRouting{
	public static function all_routes(){	

		// Добавляем все пути
			require_once("RoutesMap.php");
		// 
			
		Router::get_all();
	}
}