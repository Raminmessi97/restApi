<?php
namespace App\Http\Controllers\Api;	
use App\Models\Article;
use App\Useful_funcs\Defeat;

class ArticleController {


	 /**
     * Display a listing of the resource.
     *
     */
	public function index(){
	  header('Content-Type: application/json');
 	  $object = Article::getInstance();
 	  $articles = $object->findAll()->get();
 	  print_r(json_encode($articles,JSON_PRETTY_PRINT));
	}

	/**
     * Show the form for creating a new resource.
     *
     */
	public function create(){

	}

	/**
     * Store a newly created resource in storage.
     */
	public function store(){

	}

	/**
     * Show the form for editing the specified resource.
     */
	public function edit($id){
		
	}

	/**
     * Update the specified resource in storage.
     * @param  array $form_data
     * @param  int  $id
     */
	public function update($id){

	}

	/**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     */
    public function delete($id)
    {

    }
}