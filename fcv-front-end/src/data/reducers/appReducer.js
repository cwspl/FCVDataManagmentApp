const init = {
    loading: false,
    loginToken: localStorage.getItem('loginSession') ? localStorage.getItem('loginSession') : null,
    loginError: { error: false, message: '' },
}
export default (state = init, action) => {
    switch (action.type) {
        case "SET_LOADING":
            state = {
                ...state,
                loading: action.value
            };
            break;
        case "SET_LOGIN_TOKEN":
            state = {
                ...state,
                loginToken: action.token
            };
            localStorage.setItem('loginSession', action.token);
            break;
        case "SET_LOGIN_ERROR":
            state = {
                ...state,
                loginError: action.error
            };
            break;
    }
    return state
}