<?php

use Router\Router;


// Router::get("","MainController@main");
// Router::get('index','MainController@index');
// Router::get('edit','MainController@edit')->middleware(["auth","admin"]);

// Router::get("articles/([0-9]+)","MainController@create");

// 

Router::get("articles","ArticleController@index");

Router::get("articles/create","ArticleController@create");
Router::post("articles/store","ArticleController@store");
Router::get("articles/([0-9])","ArticleController@edit");
Router::put("articles/([0-9])","ArticleController@edit");
Router::delete("articles/([0-9])","ArticleController@delete");

// Router::get("articles/store","ArticleController@store");
// Router::get("articles/edit/([0-9]+)","ArticleController@edit");
// Router::get("articles/update/([0-9]+)","ArticleController@update");
// Router::get("articles/delete/([0-9]+)","ArticleController@delete");

// 


// Для регистрации и авторизации
Router::get('register','UserController@create_form');
Router::get('register/create','UserController@create');
Router::get('login','UserController@create_login_form');
Router::get('login/check','UserController@login_check');
Router::get("user/cabinet","UserController@user_cabinet");
Router::get("user/logout","UserController@user_logout");