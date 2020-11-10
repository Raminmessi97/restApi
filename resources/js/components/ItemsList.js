import React, { Component } from 'react';
import WalletStore from "./store/walletStore";


class ItemsList extends Component {
   
    constructor(props) {
        super(props);
	       this.state = {
	            items: WalletStore.getAllItems()
	        };



        this._onChange = this._onChange.bind(this);
    }

     _onChange() {
        this.setState({ items: WalletStore.getAllItems() });
    }
 
    UNSAFE_componentWillMount() {
        WalletStore.addChangeListener(this._onChange);
    }
 
    componentWillUnmount() {
        WalletStore.removeChangeListener(this._onChange);
    }

    render() {
    	let noItemsMessage;

    	if(!this.state.items.length){
    		noItemsMessage = "Your wallet is new!</li>"
    	}

        return (
        	<ul className="items-list">
                {noItemsMessage}
                {this.state.items.map((itemDetails) => {
                    let amountType = parseFloat(itemDetails.amount) > 0 ? 'positive' : 'negative';
                    return (<li key={itemDetails.id}>{itemDetails.description} <span className={amountType}>{itemDetails.amount}</span></li>);
                })}
            </ul>
        )
    }
}

export default ItemsList;
