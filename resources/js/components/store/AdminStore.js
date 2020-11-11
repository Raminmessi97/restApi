import { EventEmitter } from 'events';
import AdminDispatcher from '../dispatcher/AdminDispatcher';
import AdminConstants from '../constants/AdminConstants';

    const CHANGE = "CHANGE";
    const REMOVE = "REMOVE";

    var _data = [];

    function setArticles(articles){
       _data = articles
    }

class AdminStore extends EventEmitter{

    constructor(){
        super();
        AdminDispatcher.register(this._registerToAction.bind(this));
    }

    _registerToAction(action){
        switch (action.actionType) {
              case AdminConstants.GET_ALL_ARTICLES:
                setArticles(action.payload);
                break;
              case AdminConstants.ADD_NEW_ARTICLE:
                this._addNewArticle(action.payload)
                break;

              case AdminConstants.DELETE_ARTICLE:
               this._deleteArticle(action.payload)
                break;
            default:
                return true;
                break;
        }

        this.emit(CHANGE)
    }

    getArticles () {
        return _data;
    }

    _addNewArticle(article){
        _data.push(article);

        //Вызываем событие change
        this.emit(CHANGE)
    }

    _deleteArticle(article){
        _data = _data.splice(_data.indexOf(article),1);
            //Вызываем событие change
        // this.emit(REMOVE)
    }


    addChangeListener(callback){
        this.on(CHANGE,callback)
    }

    removeChangeListener(callback){
        this.removeListener(CHANGE,callback)
    }

}

export default new AdminStore();