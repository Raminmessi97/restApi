import React from 'react';
import WalletActions from './actions/walletActions';
import WalletStore from "./store/walletStore";

class AddNewItem extends React.Component {
 
    // Set the initial state.
    constructor(props) {
        super(props);
 
        this._getFreshItem = this._getFreshItem.bind(this);
         
        this.state = {
            item: this._getFreshItem(),
        };
    }
 
    // Return a fresh item.
    _getFreshItem() {
        return {
            description: '',
            amount: ''
        };
    }

    UpdateDescription(event){
    	this.setState({
    		description:event.target.value
    	})
    }
 	
 	UpdateAmount(event){
    	this.setState({
    		amount:event.target.value
    	})
    }
 

 
    // Add a new item.
    _addNewItem(event) {
		 event.preventDefault();
	     this.state.item.description = this.state.description || '-';
	     this.state.item.amount = this.state.amount || '0';
	     WalletActions.addNewItem(this.state.item);

	    this.setState({
	    	item : this._getFreshItem(),
	    	total:WalletStore.getTotalBudget()
	    })
    }
 
    render() {
        return (
            <div>
                <h3 className="total-budget">{this.state.total}</h3>
                <form className="form-inline add-item" onSubmit={this._addNewItem.bind(this)}>
                    <input type="text" className="form-control description"  name="description"  placeholder="Description" onChange={this.UpdateDescription.bind(this)} />
                    <div className="input-group amount">
                        <div className="input-group-addon">$</div>
                        <input type="number"  className="form-control" name="amount" placeholder="Amount" onChange={this.UpdateAmount.bind(this)} />
                    </div>
                    <button type="submit" className="btn btn-primary add">Add</button>
                </form>
            </div>
        )
    }
}
 
export default AddNewItem;