import { connect } from 'react-redux';
import { withRouter, Route } from "react-router-dom";

import { checkLogin, setLoading } from './../data/actions/appActions';
import LoadingBar from './../components/Loading';

const LoginForm = React.lazy(() => import(/* webpackChunkName: "Login" */ "./Login"));
const HomePage = React.lazy(() => import(/* webpackChunkName: "Home" */ "./Home"));
const Dashboard = React.lazy(() => import(/* webpackChunkName: "Dashboard" */"./../components/Dashboard"));
const AllArea = React.lazy(() => import(/* webpackChunkName: "AllArea" */"./../components/AllArea"));
const CustomerTable = React.lazy(() => import(/* webpackChunkName: "Table" */"./../components/Table"));

class App extends React.Component {
    constructor(prop){
        super(prop);
    }
    componentDidMount(){
        this.props.checkLogin();
    }
    render() {
        return (
            <React.Suspense fallback={<LoadingBar show={true}/>}>
                <div style={(this.props.loading) ? {opacity: 0.9, pointerEvents: "none"} : {}} >
                    { (this.props.loginToken != null) ?
                        <HomePage redirectTo={history.push}>
                            <LoadingBar show={this.props.loading}/>
                            <Route exact path="/"
                                render={(props) => <Dashboard {...props} /> } />
                            <Route exact path="/all-area"
                                render={(props) => <AllArea {...props} /> } />
                            <Route exact path={'/table/:areaId/:year'} 
                                render={(props) => <CustomerTable {...props} /> } />
                        </HomePage>
                        :
                        <LoginForm />
                    }
                </div>
            </React.Suspense>
        )
    }
}
const mapState = (state) => {
    return {
        loginToken: state.App.loginToken,
        loading: state.App.loading
    }
}
const mapDispatch = (dispatch) => {
    return {
        checkLogin : () => {
            dispatch(checkLogin());
        },
        setLoading : (state) => {
            dispatch(setLoading(state));
        }
    }
}
export default withRouter(connect(mapState,mapDispatch)(App));