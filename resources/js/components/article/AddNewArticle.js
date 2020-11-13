import React ,{Component} from 'react';
import AdminActions from '../actions/AdminActions';
import AdminStore from '../store/AdminStore';
import Cookies from 'js-cookie';

export default class AddNewArticle extends Component{

	constructor(props){
		super(props)

		this._getFreshArticle = this._getFreshArticle.bind(this)
		this._onChange = this._onChange.bind(this)
		this._onResponseGet = this._onResponseGet.bind(this)

		this.state = {
			article:this._getFreshArticle(),
			csrf_token: Cookies.get('csrf_token'),
			article_create_error_status:false,
			article_create_success_status:false
		}
	}

	_onChange(){
		this.setState({
			categories:AdminStore.getCategories()
		})
	}

	_onResponseGet(){
		var response = AdminStore.getArticleCreateResponses()
		this.setState({
			response:response
		})

		if(response.errors){
			this.setState({
				article_create_errors :response.errors,
				article_create_error_status:true,
			})
			setTimeout(() => {
	             this.setState({
	                article_create_error_status : false
	             })
			}, 3000);
		}

		if(response.success){
			this.setState({
				article_create_successes :response.success,
				article_create_success_status:true
			})
			setTimeout(() => {
	             this.setState({
	                 article_create_success_status: false
	             })
			}, 3000);

			AdminActions.setInitialData();
		}


		
	}


	_getFreshArticle(){
		return{
			title:'',
			text:''
		};
	}

	TitleChanger(event){
		this.setState({
			title:event.target.value
		})
	}

	TextChanger(event){
		this.setState({
			text:event.target.value
		})
	}

	FileChanger(event){
		this.setState({
			file:event.target.files[0]
		})
	}

	CategoryChanger(event){
		this.setState({
			category:event.target.value
		})
	}


	_AddNewArticle(event){
		event.preventDefault();

		var formData = new FormData()
		formData.append('title',this.state.title)
		formData.append('text',this.state.text)
		formData.append('category',this.state.category)
		formData.append('file',this.state.file)
		formData.append('csrf_token',this.state.csrf_token)

		AdminActions.addNewArticle(formData)


	}


	UNSAFE_componentWillMount(){
		AdminStore.addChangeCategoryListener(this._onChange)
		AdminStore.addResponseGetListener(this._onResponseGet)
	}

	componentDidMount(){
		AdminActions.setInitialCategories();
	}

	ComponentWillUnmount(){
		AdminStore.removeChangeCategoryListener(this._onChange)
		AdminStore.removeResponseGetListener(this._onResponseGet)
	}


	render(){
		return(
			<div className="admin_add_new_article">

			 <div className={`admin_deleted_art  ${this.state.article_create_error_status?"show_block":"hide_block"}`  }>
	          {this.state.article_create_errors?this.state.article_create_errors.map((error,index) =>(
	          	<li key={index}>{error}</li>
	          )):null}
	        </div>	


	        <div className={`admin_create_article_success  ${this.state.article_create_success_status?"show_block":"hide_block"}`  }>
	        	{this.state.article_create_successes?this.state.article_create_successes.map((success,index) =>(
	          	<li key={index}>{success}</li>
	          )):null}
	        </div>	

				<h2>Add new article </h2>
				<form onSubmit={this._AddNewArticle.bind(this)}>
					<input type="text" placeholder="Title" onChange={this.TitleChanger.bind(this)}/>
					<input type="text" placeholder="Text" onChange={this.TextChanger.bind(this)}/>
					<input type="file" onChange={this.FileChanger.bind(this)}/>
					<select onChange={this.CategoryChanger.bind(this)}>
						{this.state.categories?this.state.categories.map((category , index) =>(
						   <option key={index} value={category.id}>{category.name}</option>
						)):null}
					</select>

					<button type="submit">Create</button>
				</form>
			</div>
		)
	}


}