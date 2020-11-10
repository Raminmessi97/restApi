import React, { Component } from 'react';
import ReactDOM from 'react-dom';

import AddNewItem from './AddNewItem';
import ItemsList from './ItemsList';

export default class App extends Component {


    constructor(props) {
        super(props);

        this.state = {
        	
        }

    }

    render() {
        return (
            <div>
                <h1 className="app-title">Flux Wallet</h1>
                <AddNewItem />
                <ItemsList />
            </div>
        )
    }
}

if(document.getElementById("admin_panel")){
	ReactDOM.render(<App/>,document.getElementById("admin_panel"));
}
