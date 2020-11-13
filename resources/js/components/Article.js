import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'
import Ckeditor_Settings from "./Ckeditor/Ckeditor_Settings";

export default class Article extends React.Component {


 	constructor(){
 		super();
 		this.state = {
 			// data: []
 		}

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

 	OnSubmit(event){
 		event.preventDefault();

 		var formData = new FormData()
 		formData.append("title",this.state.title)
 		formData.append("text",this.state.text)
 		formData.append("file",this.state.file)


 		axios.post('/php_projs/phenomenon/api/testData',formData).then(response => {
 			console.log(response.data)

 		}).catch(error =>{
 			console.log(error)
 		})
 	}


   

    render(){
    return (
        <div>
      		<form onSubmit={this.OnSubmit.bind(this)}>
      			<input type="text" name="title" onChange={this.TitleChanger.bind(this)}/>
      			<input type="text" name="text" onChange={this.TextChanger.bind(this)}/>
      			<input type="file" name="filedata" onChange={this.FileChanger.bind(this)}/>
      			<button type="submit">Upload</button>
      		</form>
        </div>

    );
  }
}

if(document.getElementById("admin_panel")){
	ReactDOM.render(<Article/>,document.getElementById("admin_panel"));
}