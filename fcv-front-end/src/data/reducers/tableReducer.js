const init = {
    areas: false,
}
export default (state = init, action) => {
    switch (action.type) {
        case "CHANGE_TABLE":
            state = {
                ...state,
                areas: action.areas
            };
            break;
    }
    return state
}