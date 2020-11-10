<?php

namespace App\Models;

class User extends ActiveRecord{

	protected static function getTableName(){
			return "users";
		}

	
	public function isAdmin(){
		$author_email= $this->email;
		$author_role = $this->role;

		if( ($author_email=="ramin.hes.97@gmail.com") && ($author_role==2) ) 
			return true;
		return false;
	}
}