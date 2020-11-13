import AdminDispatcher from '../dispatcher/AdminDispatcher';
import AdminConstants from '../constants/AdminConstants'
import axios from 'axios';


class AdminActions{


	setInitialData(){
		axios.get('/php_projs/phenomenon/api/articles').then(response => {
			AdminDispatcher.dispatch({
				actionType:AdminConstants.GET_ALL_ARTICLES,
				payload:response.data
			})
		}).catch(error => {
			console.log(error)
		})
	}

	setInitialCategories(){
		axios.get('/php_projs/phenomenon/api/categories').then(response => {
			AdminDispatcher.dispatch({
				actionType:AdminConstants.GET_ALL_CATEGORIES,
				payload:response.data
			})
		}).catch(error => {
			console.log(error)
		})
	}

	addNewArticle(formdata){
		axios.post('/php_projs/phenomenon/api/articles/store',formdata).then(response => {
			AdminDispatcher.dispatch({
				actionType:AdminConstants.ADD_NEW_ARTICLE,
				payload:response.data
			})
		}).catch(error => {
			console.log(error)
		})
	}

	removeArticle(article_id){
		axios.delete('/php_projs/phenomenon/api/articles/'+article_id).then(response => {
			AdminDispatcher.dispatch({
				actionType:AdminConstants.REMOVE_ARTICLE,
				payload:response.data
			})
		}).catch(error => {
			console.log(error)
		})
	}

}

export default new AdminActions();