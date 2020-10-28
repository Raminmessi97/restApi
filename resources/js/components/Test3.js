import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';
import { FontAwesomeIcon } from '@fortawesome/react-fontawesome'
import { faCoffee } from '@fortawesome/free-solid-svg-icons'





class Test3 extends Component {


    constructor(props) {
        super(props);
         this.state = { 
            data:[]
          };




          // 

    }
    // 

      UNSAFE_componentWillMount(){
        let self = this;

        axios.get("https://api.github.com/users/Raminmessi97/repos").then(response=>{
          const data = response.data
            self.setState({
              data:data
            })
        }).catch(errors=>{
            console.log(errors)
        });
      }
    // 
      componentDidUpdate(){
        console.log(this.state.data)
      }
    


    render() {

        return (
            <div>
             {this.state.data.map((repo,index) =>(
                <h1 key={index}>{repo.owner.login}</h1>
             ))}
            </div>
        )
    }
}







export default Test3;

if(document.getElementById("react_test_2")){
	ReactDOM.render(<Test3/>,document.getElementById("react_test_2"))
}
