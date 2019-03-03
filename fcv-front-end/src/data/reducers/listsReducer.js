const init = {
    customers: false,
    areas: false,
}
export default (state = init, action) => {
    switch (action.type) {
        case "ADD_ALL_CUSTOMERS":
            state = {
                ...state,
                customers: action.customers
            };
            break;
        case "ADD_ALL_AREAS":
            state = {
                ...state,
                areas: action.areas
            };
            break;
    }
    return state
}