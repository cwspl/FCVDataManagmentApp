import appData from './../AppData';
import authBinder from './../../includes/authenticationBinder.php';

export function setLoading(bool){
    return {
        type: "SET_LOADING",
        value: bool
    };
}
export function loginUser(values){
    return dispatch => {
        let postData = new FormData();
        postData.append("requestURL", appData.requestURL+"agent/login");
        postData.append("login", true);
        postData.append("agent_email_address", values.email);
        postData.append("agent_password", values.password);
        dispatch({
            type: "SET_LOADING",
            value: true
        });
        fetch(authBinder, {
            method: 'POST',
            body: postData })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
                if(data.login == 'success'){
                    dispatch({
                        type: "SET_LOGIN_TOKEN",
                        token: data.token
                    });
                    dispatch({
                        type: "SET_LOGIN_ERROR",
                        error: { error: false, message: '' }
                    });
                } else {
                    dispatch({
                        type: "SET_LOGIN_ERROR",
                        error: { error: true, message: data.error }
                    });
                    dispatch({
                        type: "SET_LOGIN_TOKEN",
                        token: null
                    });
                }
            }).catch(function() {
                dispatch({
                    type: "SET_LOGIN_ERROR",
                    error: { error: true, message: "Connection Failed" }
                });
                dispatch({
                    type: "SET_LOGIN_TOKEN",
                    token: null
                });
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
            });
    };
}
export function checkLogin(){
    return dispatch => {
        if(localStorage.getItem('loginSession')){
            let postData = new FormData();
            postData.append("checkToken", localStorage.getItem('loginSession'));
            dispatch({
                type: "SET_LOADING",
                value: true
            });
            fetch(authBinder, {
                method: 'POST',
                body: postData })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    dispatch({
                        type: "SET_LOADING",
                        value: false
                    });
                    if(data.login == 'success'){
                        dispatch({
                            type: "SET_LOGIN_ERROR",
                            error: { error: false, message: '' }
                        });
                        dispatch({
                            type: "SET_LOGIN_TOKEN",
                            token: data.token
                        });
                    } else {
                        dispatch({
                            type: "SET_LOGIN_TOKEN",
                            token: null
                        });
                    }
                }).catch(function() {
                    dispatch({
                        type: "SET_LOGIN_ERROR",
                        error: { error: true, message: "Connection Failed" }
                    });
                    dispatch({
                        type: "SET_LOGIN_TOKEN",
                        token: null
                    });
                    dispatch({
                        type: "SET_LOADING",
                        value: false
                    });
                });
        } else {
            dispatch({
                type: "SET_LOGIN_TOKEN",
                token: null
            });
        }
    };
}
export function logoutUser() {
    return dispatch => {
        if(localStorage.getItem('loginSession')){
            let postData = new FormData();
            postData.append('logout', true);
            dispatch({
                type: "SET_LOADING",
                value: true
            });
            fetch(authBinder, {
                method: 'POST',
                body: postData,
            })
            .then(function(response) { return response.json(); })
            .then(function(data) {
                dispatch({
                    type: "SET_LOADING",
                    value: false
                });
                if(data.logout == 'success'){
                    localStorage.removeItem('loginSession');
                    dispatch({
                        type: "SET_LOGIN_TOKEN",
                        token: null
                    });
                }
            });
        }
    }
}