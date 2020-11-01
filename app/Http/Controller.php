<?php

namespace App\Http;

class Controller {

	/**
     * Все middlewares
     * @var array
     */
	private $middlewares;



	/**
     * Protected function for middleware
     * @param array $middlewares
     * @param array $except_methods =[]
     */
	public function middleware($middlewares,$except_include_methods=[]){
		$this->middlewares['names'] = $middlewares;
		
		$this->middlewares['except'] = [];
		$this->middlewares['only'] = [];

		if($except_include_methods){
			foreach ($except_include_methods as $key=>$methods) {
				$this->middlewares[$key] = $methods;
			}
		}

		return $this;
	}


	// Magic method __get

	public function __get($property){
		return $this->$property;
	}

	/**
     * Для каких методов будет задействован middlewares
     * @param array $methods
     */
	public function only($methods){
		$this->middlewares['except'] = [];
		$this->middlewares['only'] = $methods;
	}

	/**
     * Protected function for middleware
     * @param array $except_methods
     */
	public function except($except_methods){
		$this->middlewares['except'] = $except_methods;
		$this->middlewares['only'] = [];
	}



}