import appData from '../AppData';
import authBinder from './../../includes/authenticationBinder.php';

export function fetchTable(areas,years,callback){
    return (dispatch, getState) => {
        dispatch({
            type: "SET_LOADING",
            value: true
        });
        let postData = new FormData();
        postData.append("requestURL", appData.requestURL+'customers/'+areas+'/'+years);
        postData.append("requestType", "GET");
        fetch(authBinder, {
            method: 'POST',
            body: postData })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                if(data.responseCode == 200){
                    dispatch({
                        type: "CHANGE_TABLE",
                        areas: data.response.areas
                    });
                } else {
                    dispatch({
                        type: "CHANGE_TABLE",
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
                    type: "CHANGE_TABLE",
                    areas: []
                });
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
            });
    };
}