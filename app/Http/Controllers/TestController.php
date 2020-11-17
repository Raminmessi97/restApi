<?php
namespace App\Http\Controllers;
use App\Views\View;
use App\Useful_funcs\Defeat;
use App\Useful_funcs\Redirect;
use App\Http\Request;
use App\Http\Controller;

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
			$file = $request->files;
			$uploaded_url = PROJECT_ROOT."resources/images/editor_images/";
                if($file['image'])
                {
                   $avatar_name = $_FILES["image"]["name"];
                   $avatar_tmp_name = $_FILES["image"]["tmp_name"];


                   if(move_uploaded_file($avatar_tmp_name, $uploaded_url.$avatar_name))
                     echo "Uploaded";
                   else
                    echo "Error";
                }
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
			
		}

		/**
	     * Update the specified resource in storage.
	     * @param  Request $request
	     * @param  int  $id
	     */
		public function update(Request $request,$id){
			
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