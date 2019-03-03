import Header from "./../components/Header";
import { connect } from 'react-redux';
import { logoutUser } from './../data/actions/appActions'
import ListItem from '@material-ui/core/ListItem';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import SwipeableDrawer from '@material-ui/core/SwipeableDrawer';
import List from '@material-ui/core/List';
import HomeIcon from '@material-ui/icons/Home';
import AreaIcon from '@material-ui/icons/LocationOn';


function HomePage(props) {
    const [drawer, setDrawer] = React.useState(false);
    const toggleDrawer = () => {
        console.log(drawer);
        setDrawer(!drawer);
    }
    return (
        <React.Fragment>
            <Header {...props} toggleMenu={toggleDrawer}/>
            <SwipeableDrawer
                open={drawer}
                onClose={()=>setDrawer(false)}
                onOpen={()=>setDrawer(true)}>
                    <div
                    tabIndex={0}
                    role="button"
                    onClick={()=>setDrawer(false)}
                    onKeyDown={()=>setDrawer(false)}>
                    <div style={{width: 250}}>
                        <List>
                            {[
                                { name: 'Home', icon : <HomeIcon/>}, 
                                { name: 'All Area', icon : <AreaIcon/>}
                            ].map((menu, key) => (
                            <ListItem button key={key}>
                                <ListItemIcon>{menu.icon}</ListItemIcon>
                                <ListItemText primary={menu.name} />
                            </ListItem>
                            ))}
                        </List>
                    </div>
                </div>
            </SwipeableDrawer>
            <div style={{ paddingTop: 80 }}></div>
            { props.children }
        </React.Fragment>
    );
}
const mapDispatchToProps = (dispatch) => {
    return {
        logoutUser : () => {
            dispatch(logoutUser());
        },
    }
}
export default  connect(null,mapDispatchToProps)(HomePage);