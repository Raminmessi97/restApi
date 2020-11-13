import { EventEmitter } from 'events';
import AdminDispatcher from '../dispatcher/AdminDispatcher';
import AdminConstants from '../constants/AdminConstants';


    const CHANGE = "CHANGE";
    const CAT_CHANGE = "CAT_CHANGE";
    const REMOVE = "REMOVE";
    const RESPONSE_GET = "RESPONSE_GET";

    var _data = [];
    var _categories = [];
    var _responses = [];
    var _article_delete_response = [];

    function setArticles(articles){
       _data = articles
    }

    function setCategories(categories){
       _categories = categories
    }

    function addNewArticle(responses){
       _responses = responses
    }

    function deleteArticle(response){
       _article_delete_response = response
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
                this.emit(CHANGE)
                break;

              case AdminConstants.GET_ALL_CATEGORIES:
                setCategories(action.payload)
                this.emit(CAT_CHANGE)
                break;

              case AdminConstants.ADD_NEW_ARTICLE:
                addNewArticle(action.payload)
                this.emit(RESPONSE_GET)
                break;

              case AdminConstants.REMOVE_ARTICLE:
               deleteArticle(action.payload)
               this.emit(REMOVE)
                break;

            default:
                return true;
                break;
        }

        
    }

    getArticles () {
        return _data;
    }
    getCategories () {
        return _categories;
    }

    getArticleCreateResponses(){
        return _responses;
    }

    getArticleDeleteResponses(){
        return _article_delete_response;
    }



    addChangeListener(callback){
        this.on(CHANGE,callback)
    }

    removeChangeListener(callback){
        this.removeListener(CHANGE,callback)
    }

    addChangeCategoryListener(callback){
        this.on(CAT_CHANGE,callback)
    }

    removeChangeCategoryListener(callback){
        this.removeListener(CAT_CHANGE,callback)
    }

    addResponseGetListener(callback){
        this.on(RESPONSE_GET,callback)
    }

    removeResponseGetListener(callback){
        this.removeListener(RESPONSE_GET,callback)
    }

    addArticlDeleteListener(callback){
        this.on(REMOVE,callback)
    }

    removeArticlDeleteListener(callback){
        this.removeListener(REMOVE,callback)
    }

}

export default new AdminStore();