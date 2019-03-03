import appData from '../AppData';
import authBinder from './../../includes/authenticationBinder.php';

export function fetchCustomers(callback){
    return (dispatch) => {
        dispatch({
            type: "SET_LOADING",
            value: true
        });
        let postData = new FormData();
        postData.append("requestURL", appData.requestURL+"customers");
        postData.append("requestType", "GET");
        fetch(authBinder, {
            method: 'POST',
            body: postData })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.responseCode == 200){
                    dispatch({
                        type: "ADD_ALL_CUSTOMERS",
                        customers: data.response.customers
                    });
                } else {
                    dispatch({
                        type: "ADD_ALL_CUSTOMERS",
                        customers: false
                    });
                }
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
                return data.response.customers;
            })
            .then(function(data) {
                if(callback != null){
                    callback(data);
                }
            })
            .catch(function() {
                dispatch({
                    type: "ADD_ALL_CUSTOMERS",
                    customers: false
                });
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
            });
    };
}
export function fetchAreas(callback){
    return (dispatch, getState) => {
        dispatch({
            type: "SET_LOADING",
            value: true
        });
        let postData = new FormData();
        postData.append("requestURL", appData.requestURL+"areas");
        postData.append("requestType", "GET");
        fetch(authBinder, {
            method: 'POST',
            body: postData })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.responseCode == 200){
                    dispatch({
                        type: "ADD_ALL_AREAS",
                        areas: data.response.areas
                    });
                } else {
                    dispatch({
                        type: "ADD_ALL_AREAS",
                        areas: false
                    });
                }
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
                return data.response.areas;
            })
            .then(function(data) {
                if(callback != null){
                    callback(data);
                }
            })
            .catch(function() {
                dispatch({
                    type: "ADD_ALL_AREAS",
                    areas: false
                });
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
            });
    };
}