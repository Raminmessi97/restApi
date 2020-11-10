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
     public function ckeditor(){
          View::view("test/create");
     }

     public function post_image(Request $request){
          $uploaded_url = PROJECT_ROOT."resources/images/";

          if($_FILES['avatar'])
               {
                   $avatar_name = $_FILES["avatar"]["name"];
                   $avatar_tmp_name = $_FILES["avatar"]["tmp_name"];
                   $error = $_FILES["avatar"]["error"];
                   if(move_uploaded_file($avatar_tmp_name, $uploaded_url.$avatar_name))
                    echo "Image was uploaded successfully";
                   else
                    echo "image was not uploaded successfully";
               }
               else{
                    echo "error ";
               }

     }

     public function get_data(){
          
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