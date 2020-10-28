import React,{ Component }  from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";


export default class Categories extends React.Component{

	constructor(props){
		super(props)

		this.state = {
			data:[]
			
		};
	}


 UNSAFE_componentWillMount(){

 	let $this = this

 	axios.get('api/all_cats').then(response => {

 	$this.setState({
 		data:response.data
 	})

 	}).catch(error=>{
 		console.log(error)
 	});

 }

 deleteCat(category){
 	let $this = this

 	axios.delete('category/delete/'+category.id).then(response => {

 		const newState = $this.state.data.slice();
 		newState.splice(newState.indexOf(category),1)

 		$this.setState({
 			data:newState
 		})


 	}).catch(error => {
 		console.log(error)
 	})

 }
	

	render(){
		return(
				<div className="categories-table">


				<table className="styles-for-cat-table">

				<thead>
					<tr>
						<th>ID</th>
						<th>Name</th>
						<th>Route Name</th>
						<th>Action</th>
					</tr>
				</thead>


				<tbody>
					{this.state.data.map((category,index) =>(
						<tr key={index}>
						<td>{category.id}</td>
						<td>{category.name}</td>
						<td>{category.route_name}</td>
						<td><button id="delete-cat" onClick={this.deleteCat.bind(this,category)}>Delete</button></td>
						</tr>

					))}
				</tbody>


				</table>

				</div>
			)
	}
}



if(document.getElementById("all_cats")){
ReactDOM.render(<Categories/>,document.getElementById("all_cats"));
}