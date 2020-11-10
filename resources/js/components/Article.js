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




   

    render(){
    return (
        <div>
        <Ckeditor_Settings/>
        </div>

    );
  }
}

if(document.getElementById("my_ckeditor")){
	ReactDOM.render(<Article/>,document.getElementById("my_ckeditor"));
}