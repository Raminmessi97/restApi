import React ,{Component} from 'react'
import AdminActions from '../actions/AdminActions'

export default class AddNewArticle extends Component{

	constructor(props){
		super(props)

		this._getFreshArticle = this._getFreshArticle.bind(this)

		this.state = {
			article:this._getFreshArticle()
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

	_AddNewArticle(event){
		event.preventDefault();

		this.state.article.title = this.state.title ||''
		this.state.article.text =  this.state.text   ||''

		AdminActions.addNewArticle(article)

		this.setState({
			article:this._getFreshArticle()
		})
	}

	render(){
		return(
			<div className="admin_add_new_article">
				<h2>Add new article </h2>
				<form onSubmit={this._AddNewArticle.bind(this)}>
					<input type="text" placeholder="Title" onChange={this.TitleChanger.bind(this)}/>
					<input type="text" placeholder="Text" onChange={this.TextChanger.bind(this)}/>
					<button type="submit">Create</button>
				</form>
			</div>
		)
	}


}