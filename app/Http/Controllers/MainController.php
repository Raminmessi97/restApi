<?php

namespace App\Http\Controllers;
use App\Models\Article;
use App\Views\View;
use App\Useful_funcs\NiceOutput;
use App\Http\Request;

class MainController {

     /**
     *
     * @param  int  $current_page
     */
     public function main($page=1){
          $pag_data = Article::paginate(5,$page);
          // print_r($pag_data);

          // foreach ($pag_data as $key => $value) {
          //      print_r($value);
          // }
          //  // $timestamp = strtotime($article->created_at);
 
          // // $new_date = date("d-m-Y", $timestamp);
          // // echo $new_date; 


          $data = [
               'data'=>$pag_data->data,
               'links'=>$pag_data->links
          ];

        foreach ($data['data'] as $key => $value) {
           $timestamp = strtotime($value->created_at);
           $new_date = date("d-m-Y", $timestamp);
           $value->created_at = $new_date;
        }
     
          View::view('homepage',$data);
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