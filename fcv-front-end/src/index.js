import React from 'react';
import { render } from 'react-dom';
import { Provider } from 'react-redux';
import MuiThemeProvider from '@material-ui/core/styles/MuiThemeProvider';

import { HashRouter as Router } from "react-router-dom";
import theme from './styles/Theme';

import store from './data/Store';
import App from './containers/App';

import 'reset-css';

let AppRoot = document.createElement('div');
document.body.appendChild(AppRoot);
render(
    <Router>
        <Provider store={store}>
            <MuiThemeProvider theme={theme}>
                <App />
            </MuiThemeProvider>
        </Provider>
    </Router>
, AppRoot);