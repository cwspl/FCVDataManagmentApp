import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import InputBase from '@material-ui/core/InputBase';
import Menu from '@material-ui/core/Menu';
import MenuItem from '@material-ui/core/MenuItem';
import Fade from '@material-ui/core/Fade';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Badge from '@material-ui/core/Badge';
import { fade } from '@material-ui/core/styles/colorManipulator';
import withStyles from '@material-ui/core/styles/withStyles';
import MenuIcon from '@material-ui/icons/Menu';
import NotificationsIcon from '@material-ui/icons/Notifications';
import SearchIcon from '@material-ui/icons/Search';
import MoreVertTwoToneIcon from '@material-ui/icons/MoreVertTwoTone';
import Lock from '@material-ui/icons/Lock';

const styles = theme => ({
  root: {
    width: '100%',
  },
  grow: {
    flexGrow: 1,
  },
  menuButton: {
    marginLeft: -12,
    marginRight: 20,
  },
  logo: {
    width: '75px',
    marginRight: '25px'
  },
  logoHide: {
    display: 'none'
  },
  search: {
    position: 'relative',
    borderRadius: theme.shape.borderRadius,
    backgroundColor: fade(theme.palette.common.white, 0.15),
    '&:hover': {
      backgroundColor: fade(theme.palette.common.white, 0.25),
    },
    marginLeft: 0,
    width: 70,
    [theme.breakpoints.up('sm')]: {
      marginLeft: theme.spacing.unit,
      width: 'auto',
    },
  },
  searchIcon: {
    width: theme.spacing.unit * 9,
    height: '100%',
    position: 'absolute',
    pointerEvents: 'none',
    display: 'flex',
    alignItems: 'center',
    justifyContent: 'center',
  },
  inputRoot: {
    color: 'inherit',
    width: '100%',
  },
  menuItem: {
    '&:hover': {
      backgroundColor: theme.palette.primary.main,
      '& $primary, & $icon': {
        color: theme.palette.common.white,
      },
    },
  },
  primary: {},
  icon: {},
  inputInput: {
    paddingTop: theme.spacing.unit,
    paddingRight: theme.spacing.unit,
    paddingBottom: theme.spacing.unit,
    paddingLeft: theme.spacing.unit * 10,
    transition: theme.transitions.create('width'),
    width: '0',
    '&:focus': {
      width: window.innerWidth-180,
    },
    [theme.breakpoints.up('sm')]: {
      width: 200,
      '&:focus': {
        width: 250,
      },
    },
    [theme.breakpoints.up('md')]: {
      width: 450,
      '&:focus': {
        width: 600,
      },
    },
  },
});

function SearchAppBar(props) {
  const { classes } = props;
  const [menuAnchor, setMenuAnchor] = React.useState(null);
  const [searchExpand, setSearchExpand] = React.useState(null);
  function logout(){
      if(localStorage.getItem('loginSession')){
        localStorage.removeItem('loginSession');
        let postRequest = {
          'logout': true
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
                if(data.logout == 'success'){
                  props.functions.checkLogin();
                }
            });
      }
  }
  function popMenu(event){
    setMenuAnchor(event.currentTarget);
  }
  function closeMenu() {
    setMenuAnchor(null);
  }
  return (
    <div className={classes.root}>
      <AppBar position="fixed">
        <Toolbar>
          <IconButton className={classes.menuButton} color="inherit" aria-label="Open drawer">
            <MenuIcon />
          </IconButton>
          <div className={classes.grow} />
          <img style={{display : searchExpand ? window.innerWidth < 600 ? 'none': 'block' : 'block'}} src="images/header_logo.svg" className={classes.logo}/>
          <div  style={{width : searchExpand ? window.innerWidth < 600 ? 'auto': '' : ''}} className={classes.search}>
            <div className={classes.searchIcon}>
              <SearchIcon />
            </div>
            <InputBase
              onFocus={() => setSearchExpand(true)}
              onBlur={() => setSearchExpand(false)}
              placeholder="Search Customers"
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput,
              }}
            />
          </div>
          <IconButton style={{display : searchExpand ? window.innerWidth < 600 ? 'none': 'block' : 'block'}} color="inherit" aria-label="open notification">
              <Badge badgeContent={17} color="secondary">
                <NotificationsIcon />
              </Badge>
          </IconButton>
          <div className={classes.grow} />
          <div style={{display : searchExpand ? window.innerWidth < 600 ? 'none': 'block' : 'block'}}>
            <IconButton color="inherit" aria-label="open notification"
                aria-owns={menuAnchor ? 'simple-menu' : undefined}
                aria-haspopup="true"
                onClick={popMenu}>
                  <MoreVertTwoToneIcon />
            </IconButton>
            <Menu
                id="fade-menu"
                anchorEl={menuAnchor}
                open={Boolean(menuAnchor)}
                onClose={closeMenu}
                TransitionComponent={Fade} >
                <MenuItem className={classes.menuItem} onClick={logout}>
                    <ListItemIcon className={classes.icon}>
                        <Lock />
                    </ListItemIcon>
                    <ListItemText classes={{ primary: classes.primary }} inset primary="logout" />
                </MenuItem>
            </Menu>
          </div>
        </Toolbar>
      </AppBar>
    </div>
  );
}

SearchAppBar.propTypes = {
  classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(SearchAppBar);