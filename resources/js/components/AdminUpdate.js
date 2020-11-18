import React ,{Component} from 'react';
import ReactDOM from 'react-dom';
import Cookies from 'js-cookie';
import JoditEditor from "jodit-react";
import axios from 'axios';

export default class AdminUpdate extends Component{

	constructor(props){
		super(props)

		this.state = {
			csrf_token: Cookies.get('csrf_token'),
			content: '',
			id:0,
			title:'',
			isChanges:false,
			show_title_image:true,
		}
	}

	updateContent(value) {
        this.setState({content:value})
    }



	
	TitleChanger(event){
		this.setState({
			title:event.target.value
		})
	}


	FileChanger(event){
		var image_url = "http://localhost/php_projs/phenomenon/resources/images/"+event.target.files[0].name
		this.setState({
			is_image_uploaded:true,
			file:event.target.files[0],
			image_url:image_url,
			show_title_image:true
		})
	}

	CategoryChanger(event){
		this.setState({
			category:event.target.value
		})
	}

	HideBeforeImage(){
		this.setState({
			show_title_image:false,
		})
	}


	_UpdateArticle(event){
		event.preventDefault();
		
		var formData = new FormData()
		formData.append('csrf_token',this.state.csrf_token)

		var isChanges = false;
		var id = this.state.id


		if(this.state.title!=this.state.old_title){
			isChanges=true;
			formData.append('title',this.state.title)
		}
		// else{
		// 	formData.append('title','');
		// }

		if(this.state.content!=this.state.old_content){
			isChanges=true;
			formData.append('text',this.state.content)
		}
		// else{
		// 	formData.append('text','')
		// }

		if(this.state.file!=this.state.old_file){
			isChanges=true;
			formData.append('file',this.state.file)
		}
		// else{
		// 	formData.append('file','')
		// }


		if(this.state.category!=this.state.old_category_id){
			isChanges=true;
			formData.append('category_id',this.state.category)
		}
		// else{
		// 	formData.append('category','')
		// }

		if(isChanges==true){
			axios.post('/php_projs/phenomenon/api/articles/update/'+id,formData).then(response => {
    		// this.setState({
    			response:response.data
    			console.log(response)
    		// })
			}).catch(error => {
				console.log(error)
			})
		}
		// else{
		// 	this.setState({
		// 		isChanges:true
		// 	})

		// 	 setTimeout(() => {
  //                    this.setState({
  //                        isChanges: false
  //                    })
  //               }, 1500);
		// }

	}


	UNSAFE_componentWillMount(){

	// get id url
	  var current_url = window.location.pathname.toString()
      if(current_url.match(/([0-9]+)/)){
        var matches = current_url.match(/([0-9]+)/)
        var id = matches[0]
        this.setState({
        	id:id
        })
      }
    // 

    axios.get('/php_projs/phenomenon/api/articles/'+id).then(response => {
    		var data = response.data;
    		this.setState({
    			title: data.title,
    			old_title: data.title,
    			content: data.text,
    			old_content: data.text,
    			file: data.image,
    			old_file: data.image,
    			image_url: data.image,
    			category: data.category_id,
    			old_category_id: data.category_id
    		})
		}).catch(error => {
			console.log(error)
		})

		 axios.get('/php_projs/phenomenon/api/categories').then(response => {
    		this.setState({
    			categories:response.data
    		})
		}).catch(error => {
			console.log(error)
		})

	}



	componentDidMount(){
		
	}



	render(){
		return(
			<div className="admin_update_article">

			<div className={this.state.isChanges?"is_changes_false show_block":"hide_block"}>
				<p>Нет изменений</p>
			</div>

				<div className={`admin_updated_art  ${this.state.article_create_error_status?"show_block":"hide_block"}`  }>
		          {this.state.article_create_errors?this.state.article_create_errors.map((error,index) =>(
		          	<li key={index}>{error}</li>
		          )):null}
		        </div>	

		        <div className={`admin_update_article_success  ${this.state.article_create_success_status?"show_block":"hide_block"}`  }>
		        	{this.state.article_create_successes?this.state.article_create_successes.map((success,index) =>(
		          	<li key={index}>{success}</li>
		          )):null}
		        </div>	

			  	<form className="admin_create_form" onSubmit={this._UpdateArticle.bind(this)}>
					<input type="text" placeholder="Title" value={this.state.title} onChange={this.TitleChanger.bind(this)}/>
					
					<div className="texteditor_place">
						<JoditEditor
			            	editorRef={this.setRef}
			                value={this.state.content}
			                config={this.config}
			                onChange={this.updateContent.bind(this)}
			            />
		            </div>

					<label htmlFor="form_admin_image">Upload article's image</label>
					<input type="file" id="form_admin_image" onChange={this.FileChanger.bind(this)}/>
						{this.state.show_title_image?
							<div className="show_block admin_after_upload_img">
							<img alt="uploaded image" src={this.state.image_url}/>
							<span onClick={this.HideBeforeImage.bind(this)} className="close">&times;</span>
							</div>:null}

					<select onChange={this.CategoryChanger.bind(this)}>
						{this.state.categories?this.state.categories.map((category , index) =>(
						   <option key={index} value={category.id}>{category.name}</option>
						)):null}
					</select>
					<button type="submit" id="admin_create_button">Update</button>
				</form>
			</div>
		)
	}


}

if(document.getElementById("admin_update_article")){
	ReactDOM.render(<AdminUpdate/>,document.getElementById("admin_update_article"));
}