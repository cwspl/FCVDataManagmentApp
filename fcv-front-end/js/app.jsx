import {render} from "react-dom";

import { HashRouter as Router, Route } from "react-router-dom";

import LoginForm from './pages/Login';
import HomePage from './pages/Home';
import Dashboard from "./components/Dashboard";
import AllArea from "./components/AllArea";
import CustomerTable from "./components/Table";

import MuiThemeProvider from '@material-ui/core/styles/MuiThemeProvider';
import createMuiTheme from '@material-ui/core/styles/createMuiTheme';
import indigo from '@material-ui/core/colors/indigo';
import yellow from '@material-ui/core/colors/yellow';
import green from '@material-ui/core/colors/green';
import red from '@material-ui/core/colors/red';

const theme = createMuiTheme({
    palette: {
        primary: indigo,
        secondary: yellow,
        error: red,
        contrastThreshold: 3,
        tonalOffset: 0.2,
    },
    typography: {
      useNextVariants: true,
    },
    status:{
        default:{
            white: 'rgb(255,255,255)',
            black: 'rgb(0,0,0)'
        },
        success: {
            light: green[300],
            main: green[600],
            dark: green[700],
            contrastText: 'rgb(255,255,255)'
        },
    }
});

class App extends React.Component{
    constructor(props) {
        super(props);
        this.state = { 
            mainPage: '',
            authenticationBindingUrl: 'includes/authenticationBinder.php',
            shareProps: {
                AppRefresh: this.appRefresh.bind(this),
                requestURL: 'http://127.0.0.1:8000/api/',
                authenticationBindingUrl: 'includes/authenticationBinder.php',
            },
        };
    }
    componentDidMount(){
        this.checkLogin();
    }
    appRefresh(){
        this.checkLogin();
    }
    checkLogin(){
        if(localStorage.getItem('loginSession')){
            let postRequest = {
                'checkToken': localStorage.getItem('loginSession')
            };
            fetch(this.state.shareProps.authenticationBindingUrl, {
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                method: 'POST',
                body: Object.keys(postRequest).map(key => encodeURIComponent(key) + 
                '=' + encodeURIComponent(postRequest[key])).join('&')
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if(data.login === 'success'){
                        localStorage.setItem('loginSession', data.token); 
                        this.setState({ mainPage:
                            <Router>
                                <HomePage { ...this.state.shareProps } redirectTo={history.push}>
                                    <Route exact path={'/'} 
                                        render={(props) => <Dashboard {...props} { ...this.state.shareProps }/> } />
                                    <Route exact path={'/all-area'} 
                                        render={(props) => <AllArea {...props} { ...this.state.shareProps }/> } />
                                    <Route exact path={'/table/:areaId/:year'} 
                                        render={(props) => <CustomerTable {...props} { ...this.state.shareProps }/> } />
                                </HomePage>
                            </Router>
                        })
                    } else {
                        this.setState({ mainPage: <LoginForm { ...this.state.shareProps }/> })
                    }
                }.bind(this));
        } else {
            this.setState({ mainPage: <LoginForm  { ...this.state.shareProps }/> })
        }
    }
    render() {
        return(
            <div>
                {this.state.mainPage}
            </div>
        ) 
    }
}
render(<MuiThemeProvider theme={theme}> <App /> </MuiThemeProvider>, document.querySelector('#app'));