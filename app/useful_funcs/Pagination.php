<?php 

namespace App\Useful_funcs;

class Pagination {

	private $amount;
	private $max_in_one_page;
	private $current_page;
	private $url;
	private $html;
	private $prefix = "page-";
	private $last_page;



	public function __construct($amount,$max_in_one_page,$current_page){
		$this->amount = $amount;
		$this->max_in_one_page = $max_in_one_page;
		$this->current_page = $current_page;
		$this->url = URL_MAIN;
	}



	 public function get_pag(){
		// $html = "Amount-".$this->amount."..max_in_one_page".$this->max_in_one_page."..current_page".$this->current_page;
	 	$this->html.= "<div class='main_pagination'>";
		

		if($this->current_page!=1){
			$this->html.="<a class='left_pag' href='".$this->prefix.($this->current_page-1)."'>&lt;</a>";
		}
		else{
			$this->html.="<span class='left_pag'>&lt;</span>";
		}

		$current_page = intval($this->current_page);

		$num_of_pages = $this->get_num_pages();

		for ($i=1; $i<$num_of_pages ; $i++) {

			if($i===$current_page){
				$this->html.="<a class='pag_pages current_page' href='".$this->prefix.$i."'>".$i."</a>";
			}
			else{
				$this->html.="<a class='pag_pages no_current_pages' href='".$this->prefix.$i."'>".$i."</a>";
			}
			
		}



		
		if($this->current_page<$this->last_page){
			$this->html.="<a class='right_pag' href='".$this->prefix.($this->current_page+1)."'>&gt;</a>";
		}
		else{
			$this->html.="<span class='right_pag'>&gt;</span>";
		}
		$this->html.="</div>";


		return $this->html;
	}

	private function get_num_pages(){
		$num = intval(($this->amount/$this->max_in_one_page)+1);
		$this->last_page = $num;
		return $num;
	}

}