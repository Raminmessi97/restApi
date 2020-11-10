<?php

use Router\Router;


Router::get("api/articles","Api\ArticleController@index");
Router::get("api/page_articles/([0-9]+)","Api\ArticleController@page_articles");
Router::get("api/articles/([0-9]+)","Api\ArticleController@edit");
Router::delete("api/articles/([0-9]+)","Api\ArticleController@delete");

