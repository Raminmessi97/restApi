<?php

use Router\Router;


Router::get("","MainController@main");
Router::get('page-([0-9]+)',"MainController@main");


// For articles
Router::get("articles","ArticleController@index");
Router::get("articles/create","ArticleController@create")->middleware(['auth']);
Router::post("articles/store","ArticleController@store");
Router::get("articles/([0-9]+)","ArticleController@edit");
Router::put("articles/([0-9]+)","ArticleController@update");
Router::delete("articles/([0-9]+)","ArticleController@delete");



// Для регистрации и авторизации
Router::get('register','UserController@create_form');
Router::post('register/create','UserController@create');
Router::get('login','UserController@create_login_form');
Router::post('login/check','UserController@login_check');
Router::get("user/cabinet","UserController@user_cabinet");
Router::get("user/logout","UserController@user_logout");


// Admin Panel
Router::resource("admin","AdminController");


