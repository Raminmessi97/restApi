import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';


class Test2 extends Component {


    constructor(props) {
        super(props);
        this.state = {

        }


    }



    render() {
        return (
        	<div className="div_pdf">
                <h1>All is good</h1>
            </div>

        );
    }
}









export default Test2;

if(document.getElementById("react")){
	ReactDOM.render(<Test2/>,document.getElementById("react"))
}
