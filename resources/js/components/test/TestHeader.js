import React from 'react';
import ReactDOM from 'react-dom';
import axios from "axios";

export default class TestHeader extends React.Component {


  constructor(){
    super();
    this.state = {
      file:'',
      imageUrl:'',
      html:[],
      text:""
    }

    this.FileChanger = this.FileChanger.bind(this)
    this.OnSubmit = this.OnSubmit.bind(this)
    this.uploadFile = this.uploadFile.bind(this)
    this.TextChange = this.TextChange.bind(this)
    this.UploadAllData = this.UploadAllData.bind(this)
  }

  TextChange(event){
    this.setState({
      text:event.target.value
    })
  }


  FileChanger(event){
    this.setState({
      file:event.target.files[0]
    })
  }

  UploadAllData(event){
      const formData2 = new FormData();

        formData2.append('text',this.state.text)


        axios.post('http://localhost/php_projs/phenomenon/my_ckeditor/get_data',formData2).then(response=>{
         console.log(response)
         }).catch(errors=>{
            console.log(errors)
         });
  }

   OnSubmit(e){
        e.preventDefault() 
        let res =  this.uploadFile(this.state.file);
    }

     uploadFile(file){

        const formData = new FormData();

        formData.append('avatar',file)


        axios.post("http://localhost/php_projs/phenomenon/my_ckeditor/post_image", formData,{
            headers: {
                'content-type': 'multipart/form-data'
            }
        }).then(response=>{
         console.log(response)

        const avatar_image = this.state.file;
        const imageUrl = "http://localhost/php_projs/phenomenon/resources/images/"+avatar_image.name;

        const imageHtml = <img src={imageUrl} alt="photo" />
        
        this.setState({
          imageUrl:imageUrl,
          html:[...this.state.html,imageHtml]
        })
      }).catch(error=>{
       console.log(error)
      })
      }

    render(){
    return (
      <div>
        <div className="ckeditor_header">

        <button onClick={this.UploadAllData}>Upload All Data</button>
       
          <div className="fileUploader">
            <form onSubmit={this.OnSubmit}>
            <input type="file" onChange={this.FileChanger}/>
            <button type="submit">Submit</button>
            </form>
          </div>

          <div>

          </div>

         </div>


          <div className="ckeditor_body">
           {this.state.html.map((item,index) =>
                  <p key={index}>{item}</p> 
                      
           )}
           <textarea name="" onChange={this.TextChange} id="ckeditor_textarea" cols="30" rows="10"></textarea>
          </div>
       
        </div>

    );
  }
}
