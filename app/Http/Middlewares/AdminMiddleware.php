<?php

namespace App\Http\Middlewares;


class AdminMiddleware extends Middleware{
	

	public function check($author_name,$list_authors){
			if($author_name==="ramin.hes.97@gmail.com"){
				// echo "this is admin\n";
				return parent::check($author_name,$list_authors);
			}
			return false;
	}
}