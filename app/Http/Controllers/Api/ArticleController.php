<?php
namespace App\Http\Controllers\Api;	
use App\Models\Article;
use App\Useful_funcs\Defeat;
use App\Http\Request;

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

    public function page_articles($page){


        $pag_data = Article::paginate(5,$page);

          $data = [
               'data'=>$pag_data->data
          ];
         print_r(json_encode($data,JSON_UNESCAPED_UNICODE|JSON_PRETTY_PRINT));
          
    }

        /**
         * Show the form for editing the specified resource.
         */
        public function edit($id){
           echo "edit";
        }

        /**
         * Remove the specified resource from storage.
         *
         * @param  int  $id
         */
        public function delete(int $id)
        {
               if(Article::find($id)){
                    $article = Article::find($id);
                    $result = $article->delete();

                    if($result){
                        echo "Article with id=".$id." was deleted successfully";
                    }
                    else
                        echo "Error during deleting article with id=".$id;
             }
             else{
                echo "This article hasn't found";
             }
        }


        public function testData(Request $request){
            print_r($request);
        }
}