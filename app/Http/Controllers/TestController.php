<?php
namespace App\Http\Controllers;
use App\Views\View;
use App\Useful_funcs\Defeat;
use App\Useful_funcs\Redirect;
use App\Http\Request;
use App\Http\Controller;
use App\Models\Article;

class TestController extends Controller{

		/**
	     * Display a listing of the resource.
	     *
	     */
		public function index(){
			View::view("test/index");
		}	

		/**
	     * Show the form for 
	     * @param int $id
	     */
		public function imageUpload(Request $request){
			print_r($request);


			$text= $request->data;
			$title= $request->text;
			$image = "http://localhost/php_projs/project2/resources/images/films1.jpg";
			$category_id = 1;

			$object = Article::getInstance();
			$object->title = $title;
			$object->text = $text;
			$object->image = $image;
			$object->category_id = $category_id;
			if($object->create()){
				echo "Success";
			}else{
				echo "Error";
			}
		
			// $file = $request->files;
			// $uploaded_url = PROJECT_ROOT."resources/images/editor_images/";
   //              if($file['image'])
   //              {
   //                 $avatar_name = $_FILES["image"]["name"];
   //                 $avatar_tmp_name = $_FILES["image"]["tmp_name"];


   //                 if(move_uploaded_file($avatar_tmp_name, $uploaded_url.$avatar_name))
   //                   echo "Uploaded";
   //                 else
   //                  echo "Error";
   //              }
		}

		/**
	     * Show the form for creating a new resource.
	     *@param  $data
	     */
		public function create(Request $request){
			print_r($request);
			echo "error";
		}

		/**
	     * Store a newly created resource in storage.
		 *@param Request $request;
	     */
		public function store(Request $request){

		}

		/**
	     * Show the form for editing the specified resource.
	     */
		public function edit($id){
			// $article = Article::find($id);
			View::view("test/edit");
		}

		/**
	     * Update the specified resource in storage.
	     * @param  Request $request
	     * @param  int  $id
	     */
		public function updateData(Request $request,$id){

			$title = $request->text;
			$text =  $request->data;
			
			$object = Article::find($id);

				$result = $object->update([
				'title'=>$title,
				'text'=>$text
				]);
				if($result)
					echo "success";
				else
					echo "error";
		}

		/**
	     * Remove the specified resource from storage.
	     *
	     * @param  int  $id
	     */
	    public function delete($id)
	    {
	    	
	   	}


	   	  public function getArticleById($id){
	   	  	$data = Article::find($id);
	   	  	print_r(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT)); 
         } 
}