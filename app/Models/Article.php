<?php

namespace App\Models;
use App\Models\Category;

class Article extends ActiveRecord {

	protected static function getTableName(){
		return "articles";
	}

	public function getCategoryData(){
		$id = $this->category_id;
		$category = Category::find($id);
		return $category;
	}
}