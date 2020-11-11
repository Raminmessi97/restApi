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

	addNewArticle(article){
		AdminDispatcher.dispatch({
			actionType:AdminConstants.ADD_NEW_ARTICLE,
			payload:article
		})
	}

	removeArticle(article){
		AdminDispatcher.dispatch({
			actionType:AdminConstants.REMOVE_ARTICLE,
			payload:article
		})
	}

}

export default new AdminActions();