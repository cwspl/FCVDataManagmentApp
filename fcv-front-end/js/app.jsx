import React, { Component } from "react";
import {render} from "react-dom";
import Header from "./components/Header";

import {  MuiThemeProvider, createMuiTheme } from "@material-ui/core";
import { indigo, yellow } from '@material-ui/core/colors';
// import 'typeface-roboto';


const theme = createMuiTheme({
    palette: {
        primary: indigo,
        secondary: yellow,
        contrastThreshold: 3,
        tonalOffset: 0.2,
        type: 'dark',
    },
    typography: {
      useNextVariants: true,
    },
});
require('./style/app.scss');

class App extends Component{
    render() {
        return(
            <Header />
        ) 
    }
}
render(<MuiThemeProvider theme={theme}> <App /> </MuiThemeProvider>, document.querySelector('#app'));