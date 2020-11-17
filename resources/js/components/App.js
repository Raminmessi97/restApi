import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import Editor_Header from '../components/editor/Editor_Header';
import Editor_Body from '../components/editor/Editor_Body';


export default class App extends Component {


    constructor(props) {
        super(props);

        this.state = {
        	
        }

    }

    render() {
        return (
            <div>
                <Editor_Header/>
                <Editor_Body/>
            </div>
        )
    }
}

if(document.getElementById("my_editor")){
	ReactDOM.render(<App/>,document.getElementById("my_editor"));
}
