<?php

namespace App\Http\Middlewares;


	class NoAuthMiddleware extends Middleware{
		

		public function check($author_name,$list_authors){
				if(!in_array($author_name, $list_authors)){
					return parent::check($author_name,$list_authors);
				}
					return false;
		}
	}