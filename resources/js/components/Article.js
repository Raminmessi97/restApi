import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";



export default class Article extends React.Component {


 	constructor(){
 		super();
 		this.state = {
 			data: []
 		}

 	}

    //do renderinqa 
 	UNSAFE_componentWillMount(){
 		let  $this = this;

 		axios.get('api/articles').then(response => {

		$this.setState({
			data:response.data
		})

 		}).catch(error =>{
 			console.log(error)
 		})


 	}


//delete article
    deleteArticle(article){
        console.log(article)
        var $this =this
        axios.delete('article/delete/'+article.id).then(response =>  {
            console.log(response)

             const newState = $this.state.data.slice();
		        newState.splice(newState.indexOf(article),1)
		        $this.setState({
		            data:newState
		        })
	        }).catch(error => {
	            console.log(error)
	        })
	    }



   

    render(){
    return (
        <div>
            <h1>Article List</h1>
            <table id="table_articles">
            <thead>
            	<tr>
            		<th>ID</th>
            		<th>TITLE</th>
            		<th>TEXT</th>
            		<th>ACTION</th>
            	</tr>
            </thead>

            <tbody>
            	
	        	 {this.state.data.map((article, index) => (
	        	 	<tr key={index}>
		        	 	<th>{article.id}</th>
		        	 	<th>{article.title}</th>
		        	 	<th>{article.text}</th>
		        	 	<th>
		        	 	<a href="#" id="delete_article" onClick={this.deleteArticle.bind(this,article)}>Delete</a>
		        	 	</th>
	        	 	</tr>
                ))}

	        	 
	       </tbody>

	      	</table>


        </div>

    );
  }
}

if(document.getElementById("articles")){
	ReactDOM.render(<Article/>,document.getElementById("articles"));
}