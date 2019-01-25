import React from "react";
import {render} from "react-dom";
require('./app.scss');

class App extends React.Component{
    render() {
        return(
            <div className="h1">
                <h1>Hello World</h1>
            </div>
        ) 
    }
}
render(<App/>, document.querySelector('#app'));