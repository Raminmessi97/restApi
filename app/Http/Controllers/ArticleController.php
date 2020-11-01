<?php
namespace App\Http\Controllers;	
use App\Models\Article;
use App\Views\View;
use App\Useful_funcs\Defeat;
use App\Useful_funcs\Redirect;
use App\Http\Request;

class ArticleController {


	 /**
     * Display a listing of the resource.
     *
     */
	public function index(){
	  // header('Content-Type: application/json');
 	 //  $object = Article::getInstance();
 	 //  $articles = $object->findAll()->get();
 	 //  print_r(json_encode($articles,JSON_PRETTY_PRINT));
	}

	/**
     * Show the form for creating a new resource.
     *
     */
	public function create(){
		$csrf_token = Defeat::csrf_defeat();

		$data = [
			'csrf_token'=>$csrf_token
		];
		View::view("articles/create",$data);
	}

	/**
     * Store a newly created resource in storage.
     */
	public function store(Request $request){

		// url for redirect
		$url = "articles/create";

		// Будем хранить ошибки
		$errors = [];
		// 

		$title = $request->title;
		$text =  $request->text;
		$csrf_token = $request->csrf_token;


		//xss defeat
			$title = Defeat::xss_defeat($title);
			$text = Defeat::xss_defeat($text);
		// 

		if(!preg_match("/^[a-zA-Z0-9\s\.]{10,}$/",$title)){
			$errors[] = "Тайтл слишком короткий";
		}
		if(!preg_match("/^[a-zA-Z0-9\s\.]{20,}$/", $text)){
			$errors[] = "Текст слишком короткий";
		}

		if($_SESSION['csrf_token']!==$csrf_token){
			$errors[] = "CSRF ATTACK";
		}

		

		$object = Article::getInstance();
		$object->title = $title;
		$object->text = $text;

		if(!$errors){
			if($object->create()){
		  Redirect::redirect($url,'article_create_success',"Articles was created successfully");
			}
			else{
			  Redirect::redirect($url,'article_create_error',"Error during creating article");
			}
		}
		else{
				$errors[] = "Произошла ошибка при создание записи";
				Redirect::redirect($url,'article_create_error',$errors);
		}
		

	}

	/**
     * Show the form for editing the specified resource.
     */
	public function edit($id){
		$csrf_token = Defeat::csrf_defeat();

		$object = Article::find($id);


		$data = [
			'csrf_token'=>$csrf_token,
			'article'=>$object,
		];
		View::view("articles/edit",$data);
	}

	/**
     * Update the specified resource in storage.
     * @param  array $form_data
     * @param  int  $id
     */
	public function update(Request $request,$id){

		// url for redirect
		$url = "articles/".$id;

		// Будем хранить ошибки
		$errors = [];
		// 
		$title = $request->title;
		$text =  $request->text;
		$csrf_token = $request->csrf_token;

		//xss defeat
			$title = Defeat::xss_defeat($title);
			$text = Defeat::xss_defeat($text);
		// 

		if(!preg_match("/^[a-zA-Z0-9\s\.]{10,}$/",$title)){
			$errors[] = "Тайтл слишком короткий";
		}
		if(!preg_match("/^[a-zA-Z0-9\s\.]{20,}$/", $text)){
			$errors[] = "Текст слишком короткий";
		}

		if($_SESSION['csrf_token']!==$csrf_token){
			$errors[] = "CSRF ATTACK";
		}

		

		$object = Article::find($id);

		if(!$errors){
				$result = $object->update([
				'title'=>$title,
				'text'=>$text
			]);
			if($result){
		  		Redirect::redirect($url,'article_update_success',"Articles was updated successfully");
			}
			else{
			  Redirect::redirect($url,'article_update_error',"Error during updating article");
			}
		}
		else{
				$errors[] = "Произошла ошибка при обновлении записи";
				Redirect::redirect($url,'article_update_error',$errors);
		}
	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function delete($id)
    {
       	// url for redirect
		$url = "";

		// Будем хранить ошибки
		$errors = [];
		//  
		 if(Article::find($id)){
		 	$article = Article::find($id);
			$result = $article->delete();

			if($result){
		  		Redirect::redirect($url,'article_delete_success',"Articles was deleted successfully");
			}
			else{
			  Redirect::redirect($url,'article_delete_error',"Error during deleting article");
			}

		 }
		 else{
		 	 Redirect::redirect($url,'article_delete_error',"Нет такой записи");
		 }
	}
}