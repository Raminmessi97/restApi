<?php

namespace App\Models;

class Article extends ActiveRecord {

	protected static function getTableName(){
		return "articles";
	}
}