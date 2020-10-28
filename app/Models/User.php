<?php

namespace App\Models;

class User extends ActiveRecord{

	protected static function getTableName(){
			return "users";
		}

}