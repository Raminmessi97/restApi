import React, { Component } from 'react';
import AdminStore from '../store/AdminStore'
import AdminActions from '../actions/AdminActions'

class ArticleList extends React.Component{
	
	constructor(props){
		super(props);

		this.state = {
			articles: [],
			art_delete_suc_state:true
		}


		this._onChange = this._onChange.bind(this)
	}

	_deleteArticle(article){
		AdminActions.removeArticle(article)

			this.setState({
                art_delete_suc_state: !this.state.art_delete_suc_state
	        })

            setTimeout(() => {
                 this.setState({
                     art_delete_suc_state: !this.state.art_delete_suc_state
                 })
            }, 1500);
		}


	_onChange(){
		this.setState({
	      articles: AdminStore.getArticles()
	    });
	}

	UNSAFE_componentWillMount(){
		AdminStore.addChangeListener(this._onChange)
	}

	componentDidMount(){
		AdminActions.setInitialData();
	}

	ComponentWillUnmount(){
		AdminStore.removeChangeListener(this._onChange)
	}



	render(){

		let Emptymessage;
		if(!this.state.articles.length)
			Emptymessage = "Нет статей"

		return(
			<div>
				<div className={`admin_deleted_art  ${this.state.art_delete_suc_state?"hide_block":"show_block"}`  }>
		            <p>Article was deleted successfully!</p>
		         </div>

            <table id="table_articles">
                <thead>
                	<tr>
                		<th>ID</th>
                		<th>TITLE</th>
                		<th>DELETE</th>
                        <th>UPDATE</th>
                	</tr>
                </thead>

                <tbody>
    	        	 {this.state.articles.map((article, index) => (
    	        	 	<tr key={index}>
    		        	 	<th>{article.id}</th>
    		        	 	<th>{article.title}</th>
    		        	 	<th>
    		        	 	<a href="#" id="delete_article" onClick={this._deleteArticle.bind(this,article)}>Delete</a>
    		        	 	</th>
                            <th>
                            <a href={`articles/${article.id}`} id="update_article">Update</a>
                            </th>
    	        	 	</tr>
                    ))}
    	       </tbody>

	      	</table>
	      </div>
			)
	}


}
export default ArticleList;