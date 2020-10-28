import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";



export default class Article extends React.Component {


 	constructor(){
 		super();
 		this.state = {
 			title:"",
            textarea:""
 		}
        this.onSubmit = this.onSubmit.bind(this)
        this.titleChange = this.titleChange.bind(this)
        this.textChange = this.textChange.bind(this)
 	}

    titleChange(event){
        this.setState({
            title:event.target.value
        })
    }
    
    textChange(event){
        this.setState({
            text:event.target.value
        })
    }


    onSubmit(event){
        event.preventDefault()

        axios.post('../articles/store',{
          userid: this.state.userid,
          fullname: this.state.fullname,
        }).then(response => {
            console.log(response.data)

        }).catch(error =>{
            console.log(error)
        })
    }

   

    render(){
    return (
        <div>
           <form onSubmit={this.onSubmit} action="../articles/store" method="post">
            <input type="text" onChange={this.titleChange} name="title" placeholder="Title of article"/>
            <input type="textarea" onChange={this.textChange} name="text" placeholder="Text of article"/>
            <input type="submit" value="Create"/>
        </form>

        </div>

    );
  }
}

if(document.getElementById("article_create")){
	ReactDOM.render(<Article/>,document.getElementById("article_create"));
}