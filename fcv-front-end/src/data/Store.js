import { createStore, combineReducers, applyMiddleware} from 'redux';
import thunk from 'redux-thunk';
import App from './reducers/appReducer';
import Lists from './reducers/listsReducer';
import Table from './reducers/tableReducer';

export default createStore(combineReducers({ App, Lists, Table }), {}, applyMiddleware(thunk));