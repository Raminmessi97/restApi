import React, { Component } from 'react';
import ReactDOM from 'react-dom';
import axios from 'axios';

export default class PDF_header extends Component {

	 constructor(props) {
        super(props);
        this.state = {
        	 imageUrl:'',
        	 IsImageUploaded:false,
        	 isAvatarSetTings:true,
             title:'',
             text:''
        }

         this.imgOnClick = this.imgOnClick.bind(this)
         this.DeleteAvatar = this.DeleteAvatar.bind(this)
         this.fileInput = React.createRef();


         // 
         	this.onSubmit = this.onSubmit.bind(this)
         	this.uploadFile = this.uploadFile.bind(this)
         	this.onChange = this.onChange.bind(this)
         // 
            this.TextChange = this.TextChange.bind(this)
            this.TitleChange = this.TitleChange.bind(this)

         //
         this.Upload_All_info = this.Upload_All_info.bind(this)
         this.Send_user_data = React.createRef()
         //
    }

    Upload_All_info(){

        const formData = new FormData();

        formData.append('title',this.state.title)
        formData.append('text',this.state.text)

    	axios.post('http://localhost/php_projs/phenomenon/my_ckeditor/get_data',formData).then(response=>{
         console.log(response)
         }).catch(errors=>{
            console.log(errors)
         });
    }

    TextChange(e){
        this.setState({
            text:e.target.value
        })
    }

    TitleChange(e){
        this.setState({
            title:e.target.value
        })
    }



     onSubmit(e){
        e.preventDefault() 
        let res =  this.uploadFile(this.state.file);
        // console.log(res.data);
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

	    	
	    	this.setState({
	    		imageUrl:imageUrl,
	    		isAvatarSetTings:true
	    	})
      }).catch(error=>{
       console.log(error)
      })
      }


    imgOnClick(event){
    	const currentState = this.state.isAvatarSetTings;
    	this.setState({
    		isAvatarSetTings:!currentState,
    		IsImageUploaded:true,
    	})
    }





    onChange(e) {
        this.setState({file:e.target.files[0]})
    }



    	
  



    // }

    DeleteAvatar(){
    	this.setState({
    		imageUrl:false,
    		isAvatarSetTings:true
    	})
    	    }

  

	render(){

	    let image;
	    if (this.state.imageUrl) {
	      image =  <img onClick={this.imgOnClick} src={this.state.imageUrl} className="pfd_avatar_image" alt="avatar_image"/>;
	    } 
        else {
	      image =
	      <form onSubmit={ this.onSubmit }>
            <label htmlFor="image_avatar"><i className="fa fa-user-circle"></i></label>
             <input type="file" id="image_avatar" ref={this.fileInput} onChange={this.onChange}/>
            <button type="submit" className="pdf_avatar_submit">End Upload</button>
          </form>
	    }


	  let label;

	  if(this.state.IsImageUploaded){

	  	label = 
	  	<form onSubmit={ this.onSubmit }>
	  	 <input type="file" id="image_avatar" ref={this.fileInput} onChange={this.onChange}/>
	  		<label htmlFor="image_avatar"><i className="fa fa-upload">Upload</i></label>
	  	 <button type="submit" className="pdf_avatar_submit">End Upload2</button>
	  	</form>
	  }
	  else
	  	label= "";


		return (
		<div className="react_test_2_inline">
			<div className="cv_settings">
				<button className="upload_pdf" onClick={this.Upload_All_info}>Create</button>
			</div>

			<div className="pdf_header">
    	         <div className="user_avatar">
    		         	{image}
    		         <div className={`user_avatar_settings  ${this.state.isAvatarSetTings?"hide_block":"show_block"}`  }>
    		         	  {label}
    		         	 <i onClick={this.DeleteAvatar} className="fa fa-trash delete_avatar"></i>
    		         	 <input type="file" id="image_avatar" ref={this.fileInput} onChange={this.FileChanger}/>
    		         </div>
    	         </div>
		         <div className="user_informations">
    				  <input type="text" name="article_title" onChange={this.TitleChange}  placeholder="Title of article"/>
                      <input type="text" name="article_text" onChange={this.TextChange}    placeholder="Text  of article"/>
				</div>   
		  	</div>

		</div>

			)
	}

}