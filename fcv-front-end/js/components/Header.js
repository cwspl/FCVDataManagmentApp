import React, { Component } from "react";
import { AppBar, Toolbar, IconButton, Button, TextField, Divider } from "@material-ui/core";
import MenuIcon from '@material-ui/icons/Menu';
import SearchIcon from '@material-ui/icons/Search';
import SwipeableDrawer from '@material-ui/core/SwipeableDrawer';

class Header extends Component {
    render() { 
        return (
          <div>
          <AppBar position="static">
            <Toolbar>
              <IconButton color="inherit" aria-label="Open drawer">
                <MenuIcon />
              </IconButton>
              <img src="images/header_logo.svg" width="75" alt="header logo"/>
              <TextField
                id="standard-search"
                label="Search Customer"
                type="search"
                margin="normal"
                style={{
                  marginTop: '-8px',
                  marginLeft: '20px'
                }}  
                />
              <Divider 
                style={{
                  width: 1,
                  height: 28,
                  margin: '20px',
                }} 
              />
              <IconButton color="inherit" aria-label="Search">
                <SearchIcon />
              </IconButton>
            </Toolbar>
          </AppBar>
          </div>
        );
    }
}
 
export default Header;