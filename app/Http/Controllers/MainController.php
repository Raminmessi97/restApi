<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Views\View;

class MainController {

	
     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function main(){
          // $object = Articles::getInstance();
          // $articles = $object->findAll()->get();

          // print_r($articles);

          View::view('homepage',[]);
     }





	/**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function index(){
          
     }




     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function edit(){
               View::view("user/index",[]);
     }



     /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
     public function create($id){
          echo 'Create article with id='.$id;
     }




}