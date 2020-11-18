import React, { Component,useState, useRef,useEffect } from 'react';
import ReactDOM from 'react-dom';

import axios from 'axios';

import JoditEditor from "jodit-react";


const Tests = ({}) => {
    const editor = useRef(null)
    const [content, setContent] = useState('')
    const [text, setText] = useState('')
    const [url, setUrl] = useState('')
    const config = {
        readonly: false // all options from https://xdsoft.net/jodit/doc/
    }



   useEffect(() => {
      var current_url = window.location.pathname.toString()
      if(current_url.match(/([0-9]+)/)){
        var matches = current_url.match(/([0-9]+)/)
        var id = matches[0]
        setUrl(id)
      }



        axios.get('/php_projs/phenomenon/api/test/editor/'+id).then(response => {
            var data = response.data.text.toString()
            setContent(data)
            // console.log(response.data.text)
        }).catch(error => {
            console.log(error)
        })
    }, [])


   function SendData(){
        var newFormData =  new FormData()
        newFormData.append("data",content)
        newFormData.append("text",text)

        axios.post('/php_projs/phenomenon/editor/test/'+url,newFormData).then(response => {
            console.log(response.data)
        }).catch(error => {
            console.log(error)
        })
    }
    
    return (
         <div>
            <JoditEditor
                ref={editor}
                value={content}
                config={config}
                tabIndex={2} // tabIndex of textarea
                onBlur={(newContent) => setContent(newContent.target.innerHTML)} // preferred to use only this option to update the content for performance reasons
                onChange={newContent => {}}
            />
            <input type="text" name="title" id="title" onChange={(text) => setText(event.target.value)}/>
            <button onClick={SendData}>Send</button>
        </div>
        );
}

if(document.getElementById("my_editor_update")){
    ReactDOM.render(<Tests/>,document.getElementById("my_editor_update"));
}
