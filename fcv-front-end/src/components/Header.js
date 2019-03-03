import { connect } from 'react-redux';

import PropTypes from 'prop-types';
import AppBar from '@material-ui/core/AppBar';
import Toolbar from '@material-ui/core/Toolbar';
import IconButton from '@material-ui/core/IconButton';
import InputBase from '@material-ui/core/InputBase';
import Menu from '@material-ui/core/Menu';
import MenuList from '@material-ui/core/MenuList';
import MenuItem from '@material-ui/core/MenuItem';
import ClickAwayListener from '@material-ui/core/ClickAwayListener';
import Grow from '@material-ui/core/Grow';
import Paper from '@material-ui/core/Paper';
import Popper from '@material-ui/core/Popper';
import Fade from '@material-ui/core/Fade';
import ListItemIcon from '@material-ui/core/ListItemIcon';
import ListItemText from '@material-ui/core/ListItemText';
import Badge from '@material-ui/core/Badge';
import withStyles from '@material-ui/core/styles/withStyles';
import MenuIcon from '@material-ui/icons/Menu';
import NotificationsIcon from '@material-ui/icons/Notifications';
import SearchIcon from '@material-ui/icons/Search';
import MoreVertTwoToneIcon from '@material-ui/icons/MoreVertTwoTone';
import Lock from '@material-ui/icons/Lock';

import HeaderClasses from './../styles/HeaderClasses';
import HeaderLogo from './../assets/header_logo.svg';
import { fetchCustomers } from './../data/actions/listsActions';

function Header(props) {
  const { classes, Customers } = props;
  
  const [menuAnchor, setMenuAnchor] = React.useState(null);
  const [searchExpand, setSearchExpand] = React.useState(null);
  const [filteredCustomers, setFilteredCustomers] = React.useState([]);
  
  React.useEffect(() => {
      fetchCustomers();
  }, []);

  React.useEffect(() => {
      setFilteredCustomers(Customers);
  }, [Customers])

  const [search, setSearch] = React.useState(false);
  const anchorSearch = React.useRef(null);
  const searchCustomers = (event) => {
    if(event.target.value.length > 2){
      setSearch(true)
      setFilteredCustomers(Customers.slice(0)
      .sort(function(a, b) {
          var nameA = a.customer_name_english.toUpperCase();
          var nameB = b.customer_name_english.toUpperCase();
          return (nameA < nameB) ? -1 : (nameA > nameB) ? 1 : 0;
      }).filter(customer => {
        return (customer.customer_name.includes(event.target.value.toLowerCase()) || 
          customer.customer_name_english.includes(event.target.value.toLowerCase()))
      }))
    } else {
      setSearch(false);
    }
  }
  const searchClose = (event) => {
    if (anchorSearch.current.contains(event.target)) {
      return;
    }
    setSearch(false);
    setSearchExpand(false);
  }
  const popMenu = (event) => {
    setMenuAnchor(event.currentTarget);
  }
  const closeMenu = () => {
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
          <img style={{display : searchExpand ? window.innerWidth < 600 ? 'none': 'block' : 'block'}} src={HeaderLogo} className={classes.logo}/>
          <div  style={{width : searchExpand ? window.innerWidth < 600 ? 'auto': '' : ''}} className={classes.search}>
            <div className={classes.searchIcon}>
              <SearchIcon />
            </div>
            <InputBase
              inputRef={anchorSearch}
              aria-owns={search ? 'customer-search' : undefined}
              aria-haspopup="true"
              onChange={searchCustomers}
              onBlur={() => { setSearchExpand(false); }}
              onFocus={() => { setSearchExpand(true); }}
              placeholder="Search Customers"
              classes={{
                root: classes.inputRoot,
                input: classes.inputInput,
              }}
            />
            <Popper open={search} anchorEl={anchorSearch.current} transition disablePortal>
            {({ TransitionProps, placement }) => (
              <Grow
                {...TransitionProps}
                id="customer-search"
                style={{ transformOrigin: placement === 'bottom' ? 'center top' : 'center bottom' }}
              >
                <Paper>
                  <ClickAwayListener onClickAway={searchClose}>
                    <MenuList style={{maxHeight: '70vh', overflowY: 'auto', width: 200}}>
                      {
                        filteredCustomers.map(customer => (
                            <MenuItem onClick={() => props.history.push('table/'+customer.area_id+'/'+(new Date().getFullYear())+'/'+customer.customer_id)} key={customer.customer_id}>{ customer.customer_name }</MenuItem>
                        ))
                      }
                    </MenuList>
                  </ClickAwayListener>
                </Paper>
              </Grow>
            )}
          </Popper>
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
                <MenuItem className={classes.menuItem} onClick={props.logoutUser}>
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

Header.propTypes = {
  classes: PropTypes.object.isRequired,
};

const mapProps = (state) => {
    return {
        Customers: state.Lists.customers
    }
}
const mapDispatch = (dispatch) => {
    return {
        fetchCustomers : (callback) => {
            dispatch(fetchCustomers(callback));
        },
    }
}
export default connect(mapProps,mapDispatch)(withStyles(HeaderClasses)(Header))