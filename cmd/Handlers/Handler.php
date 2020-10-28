<?php

namespace Cmd\Handlers;


interface HandlerCmd{
		public function setNext($handler);
		public function handle($key,$value,$filename);
	}

	abstract class Handler implements HandlerCmd{

		private $nextHandler;
		
		public function setNext($handler){
			$this->nextHandler = $handler;
			return $handler;
		}

		public function handle($key,$value,$filename){
			if($this->nextHandler)
				return $this->nextHandler->handle($key,$value,$filename);
			else
				return null;
		}


	}
