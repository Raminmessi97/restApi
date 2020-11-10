import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

import TestHeader from "./test/TestHeader";
import {Provider} from 'react-redux'
export default class Tests extends React.Component {


  constructor(){
    super();
    this.state = {
     
    }
  }
   

    render(){
    return (
        <div>
        
        </div>

    );
  }
}

if(document.getElementById("admin_panel")){
  ReactDOM.render(<Tests/>,document.getElementById("admin_panel"));
}