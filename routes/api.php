<?php

use Router\Router;


Router::get("api/articles","Api\ArticleController@index");
// Router::get("api/page_articles/([0-9]+)","Api\ArticleController@page_articles");
Router::post("api/articles/store","Api\ArticleController@store");

Router::delete("api/articles/([0-9]+)","Api\ArticleController@delete");

Router::get("api/categories","Api\CategoryController@index");


// editor
Router::post("api/editor/imageUpload","TestController@imageUpload");
Router::post("api/editor/all_data","TestController@create");