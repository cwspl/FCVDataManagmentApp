import React, { Component } from "react";
import {render} from "react-dom";
import Header from "./components/Header";

import {  MuiThemeProvider, createMuiTheme } from "@material-ui/core";
import { indigo, yellow, green, red } from '@material-ui/core/colors';
import LoginForm from './components/login';

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

class App extends Component{
    constructor(props) {
        super(props);
        this.state = { 
            main: '',
            requestURL: 'http://127.0.0.1:8000/api/'
        };
    }
    componentDidMount(){
        this.checkLogin();
    }
    componentDidMount(){
        this.checkLogin();
    }
    checkLogin(){
        let that = this;
        if(localStorage.getItem('loginSession')){
            let postRequest = {
                'checkToken': localStorage.getItem('loginSession')
            };
            fetch('includes/authenticationBinder.php', {
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                method: 'POST',
                body: Object.keys(postRequest).map(key => encodeURIComponent(key) + 
                '=' + encodeURIComponent(postRequest[key])).join('&')
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    if(data.login == 'success'){
                        localStorage.setItem('loginSession', data.token);
                        that.setState({ main: <Header functions={that}/> })
                    } else {
                        that.setState({ main: <LoginForm functions={that} /> })
                    }
                });
        } else {
            this.setState({ main: <LoginForm functions={that} /> })
        }
    }
    render() {
        return(
            <div>
                {this.state.main}
            </div>
        ) 
    }
}
render(<MuiThemeProvider theme={theme}> <App /> </MuiThemeProvider>, document.querySelector('#app'));