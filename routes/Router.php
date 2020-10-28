<?php
namespace Router;

use App\useful_funcs\Redirect;
use App\Http\Kernel;
use App\Models\User;


class Router{

	/**
     * Текущий роут объекта
     * @var array
     */
	private $route;

	/**
     * Контроллер и action объекта
     * @var array
     */
	private $ContAct;

	/**
     * Массив с middlewares
     * @var array
     */
	private $middlewares=null;


	/**
     * Переменная, которая хранит все роуты
     * @var array
     */
	private static $routes;









	/**
     * Get method of Router
     *
     * @param string $current_route
     * @param  string $controller_and_action
     * @return function before_check
     */
	public static function get($route,$controller_and_action){

		// Add to routes of site
		self::$routes[$route]['route'] = $route;
		self::$routes[$route]['ContAct'] = $controller_and_action;
		self::$routes[$route]['middlewares'] = null;
		// 

		return self::before_check($route,$controller_and_action);
	}


	/**
	 *Возвращает объект класса со свойствами
     *
     * @param  string  $route
     * @param  string $controller_and_action
     * @return object
     */

	private static function before_check($route,$controller_and_action){

		//Создаем объект для middleware
		$router = new Router();
		$router->route = $route;
		$router->ContAct =$controller_and_action;

		return $router;
	}



	/**
     * Middleware method
     *
     * @param array $middlewares
     * Устанавливаем middleware для текущего роута
     */
	public function middleware($middlewares){
		$route = $this->route;

		self::$routes[$route]['middlewares'] = $middlewares;

	}



	/**
     * Main method of Router
     *
     * @param null
     */

	public static function get_all(){

		$url_route = URL_ROUTE;
		$url_route = trim($url_route,"/"); //Удаляем слеш из начала и конца

		$hasRoute = false; // Нет такого маршрута


		foreach (self::$routes as $route => $routeProps) {
			if(preg_match("~^$route$~", $url_route,$matches)){
				
				// 
				// 


				$hasRoute = true; //Нашли совпадение

				if($routeProps['middlewares'])
				{
					self::use_middlewares($routeProps,$matches);
				}
				else{
					self::check($routeProps['ContAct'],$matches);
				}
			}
		}
			if(!$hasRoute){
					echo "404 not found";
			}
	}


	/**
     * Check method of Router( Вызываем нужный контроллер с нужным методом)
     *
     * @param null
     */
	private static function check($controller_and_action,$matches){
		array_shift($matches);
		$array = explode("@", $controller_and_action);

		$controller = $array[0];
		$action = $array[1];

		$controller = "\App\Http\Controllers\\".$controller;
		$object = new $controller;
		$object->$action(...$matches);
	}


	/**
     * Use middlewares( Применение посредников)
     *
     * @param null
     */
	private static function use_middlewares($value,$matches){
		$middlewares = $value['middlewares'];

		$author_list = [];

		if(isset($_COOKIE['logged_user'])){
			$author = $_COOKIE['logged_user'];
		}
		else{
			$author = "";
		}

		$obj = User::getInstance();
		$authors =  $obj->findAll()->get();

		foreach ($authors as $key => $author_obj) {
			$author_list[] = $author_obj->email;
		}

		$all_middlewares = Kernel::get_all_middlewares();

		$uses_middlewares = [];

		for($i=0;$i<count($middlewares);$i++){
			foreach ($all_middlewares as $key => $value2) {
				if($key===$middlewares[$i]){
					$uses_middlewares[$i] = $value2;
				}
			}
		}
		
		if(count($middlewares)===1){	

				$run_middlewares = new $uses_middlewares[0];
				
				if($run_middlewares->check($author,$author_list)){
					self::check($value['ContAct'],$matches);
				}
				else
					{
						$url = "";
						Redirect::redirect($url,"access_error","Туда нельзя --)");
					}
				
		}
		else{
			
			$run_middlewares = [];

			for($i=0;$i<count($uses_middlewares);$i++){
				$object = new $uses_middlewares[$i];
				$run_middlewares[] = $object;
			}

			for($i=0;$i<count($run_middlewares);$i++){
				if(isset($run_middlewares[$i+1]))
					$run_middlewares[$i]->linkWith($run_middlewares[$i+1]);
			}

			$first_handler = $run_middlewares[0];


			if($first_handler->check($author,$author_list)){
				self::check($value['ContAct'],$matches);
			}
			else{
				$url = "";
				Redirect::redirect($url,"access_error","Туда нельзя--)");
			}


			
		}


	}

	
}