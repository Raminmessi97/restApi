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

          $data = [
               'data'=>$pag_data->data,
               'links'=>$pag_data->links
          ];
     
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