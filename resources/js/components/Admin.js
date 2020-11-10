import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";



export default class Admin extends React.Component {


 	constructor(){
 		super();
 		this.state = {
            page_data:[],
            art_delete_suc_state:true

 		}
        this.span_deleted_article = React.createRef()
 	}

    //do renderinqa 
 	UNSAFE_componentWillMount(){
 		let  $this = this;

 		axios.get('/php_projs/phenomenon/api/articles').then(response => {
		$this.setState({
			page_data:response.data
		})


 		}).catch(error =>{
 			console.log(error)
 		})




 	}


//delete article
    deleteArticle(article){

        var $this = this
        axios.delete('api/articles/'+article.id).then(response =>  {
            console.log(response.data)
             const newState = $this.state.data.slice();
		        newState.splice(newState.indexOf(article),1)
		        $this.setState({
		            data:newState,
                    art_delete_suc_state: !this.state.art_delete_suc_state
		        })

                setTimeout(() => {
                     this.setState({
                         art_delete_suc_state: !this.state.art_delete_suc_state
                     })
                }, 1500);

	        }).catch(error => {
	            console.log(error)
	        })
	    }



   

    render(){
    return (
        <div>
        
         <div ref='span_deleted_article' className={`admin_deleted_art  ${this.state.art_delete_suc_state?"hide_block":"show_block"}`  }>
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
    	        	 {this.state.page_data.map((article, index) => (
    	        	 	<tr key={index}>
    		        	 	<th>{article.id}</th>
    		        	 	<th>{article.title}</th>
    		        	 	<th>
    		        	 	<a href="#" id="delete_article" onClick={this.deleteArticle.bind(this,article)}>Delete</a>
    		        	 	</th>
                            <th>
                            <a href={`articles/${article.id}`} id="update_article">Update</a>
                            </th>
    	        	 	</tr>
                    ))}
    	       </tbody>

	      	</table>

          {/*<div dangerouslySetInnerHTML={{__html: this.state.links}} />*/}

        </div>

    );
  }
}




if(document.getElementById("admin_panel")){
	ReactDOM.render(<Admin/>,document.getElementById("admin_panel"));
}