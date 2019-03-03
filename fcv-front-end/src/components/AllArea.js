import { connect } from 'react-redux';

import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import Button from '@material-ui/core/Button';
import HomeIcon from '@material-ui/icons/Home';
import AddIcon from '@material-ui/icons/Add';
import SearchIcon from '@material-ui/icons/Search';
import OpenInBrowser from '@material-ui/icons/OpenInBrowser';

import Fab from '@material-ui/core/Fab';
import Typography from '@material-ui/core/Typography';
import TextField from '@material-ui/core/TextField';
import IconButton from '@material-ui/core/IconButton';
import InputAdornment from '@material-ui/core/InputAdornment';
import Switch from '@material-ui/core/Switch';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';

import { fetchAreas, fetchCustomers } from './../data/actions/listsActions';

import AllAreaClasses from './../styles/AllAreaClasses';

function AllArea(props) {
    const { classes, Areas, Customers, fetchAreas, fetchCustomers } = props;
    const [filteredAreas, setFilteredAreas ] = React.useState([]);

    const [multipleAreaCheck, setMultipleArea ] = React.useState(false);
    const [multipleAreaId, setMultipleAreaId] = React.useState({
        all: false,
        checkedId: [],
    });

    const handleMultipleAreaId = (id, state) => {
        if(id == 'all'){
            setMultipleAreaId({ ...multipleAreaId, [id]: state });
        } else {
            if(state){
                let areaIds = [...multipleAreaId.checkedId, id];
                setMultipleAreaId({ ...multipleAreaId, checkedId: areaIds });
            } else {
                let areaIds = multipleAreaId.checkedId.filter(area_id => (area_id != id));
                setMultipleAreaId({ ...multipleAreaId, checkedId: areaIds });
            }
        }
    }
    
    React.useEffect(() => {
        fetchAreas();
        fetchCustomers();
    }, []);

    React.useEffect(() => {
        setFilteredAreas(Areas ? Areas : []);
    }, [Areas]);

    const searchArea = (event) => {
        setFilteredAreas(
            Areas.slice(0)
            .filter(area => (
                area.area_name.includes(event.target.value.toLowerCase()) || 
                area.area_name_english.includes(event.target.value.toLowerCase())
            )))
    }
    return (
        <div>
            <Typography className={classes.margin} component="h2" variant="subtitle1" align="center" gutterBottom>
                All Areas
            </Typography>
            <div className={classes.AreaList}>
                <TextField
                    label="Search Area"
                    onChange={searchArea}
                    margin="normal"
                    variant="outlined"
                    InputProps={{
                        endAdornment: (
                            <InputAdornment position="end">
                                <IconButton aria-label="Search">
                                    <SearchIcon/>
                                </IconButton>
                            </InputAdornment>
                        ),
                    }}
                />
                <FormControlLabel
                    control={
                        <Switch
                            checked={multipleAreaCheck}
                            onChange={() => setMultipleArea(event.target.checked)}
                        /> }
                    label="Select Multiple Area" />
                <div style={{ display: (!multipleAreaCheck) ? 'none' : 'flex'}}>
                    <FormControlLabel
                        style={{ flexGrow: 1 }}
                        control={
                        <Checkbox
                            checked={multipleAreaId.all}
                            onChange={() => handleMultipleAreaId('all', event.target.checked)}
                            color="primary"/> }
                        label="All Area" />
                    
                    <Fab variant="extended" color="primary" aria-label="Add" className={classes.margin}
                        style={{position : 'fixed', bottom: '10px', right: '10px', zIndex: 20}}
                        disabled={ !(multipleAreaId.all) && (multipleAreaId.checkedId.length == 0) }
                        onClick={() => {
                            props.history.push('table/'+(multipleAreaId.all ? 'all' : multipleAreaId.checkedId.join(','))+'/'+(new Date().getFullYear()))
                        }}>
                        <OpenInBrowser className={classes.extendedIcon} />
                        Open
                    </Fab>
                </div>
                {
                    filteredAreas.map(area => (
                        <div key={area.area_id} style={{ display: 'flex'}}>
                            {(!multipleAreaCheck) ? '' : <Checkbox checked={(multipleAreaId.all) ? true : multipleAreaId.checkedId.includes(area.area_id) } onChange={() => handleMultipleAreaId(area.area_id, event.target.checked)} />}
                            <Button style={{ flexGrow: 1 }} className={classes.Button}
                                variant={(((multipleAreaId.checkedId.includes(area.area_id) || multipleAreaId.all) && multipleAreaCheck) ? 'contained' : 'outlined')}
                                color={(((multipleAreaId.checkedId.includes(area.area_id) || multipleAreaId.all) && multipleAreaCheck) ? 'secondary' : 'default')}
                                onClick={() => {
                                    if(!multipleAreaCheck){
                                        props.history.push('table/'+area.area_id+'/'+(new Date().getFullYear()))
                                    } else {
                                        handleMultipleAreaId(area.area_id, !(multipleAreaId.checkedId.includes(area.area_id)))
                                    }}} >
                                { area.area_name +' : ('+ ((Customers) && Customers.slice(0).filter(customer => (customer.area_id == area.area_id)).length)+ ')' }
                                
                            </Button>
                        </div>
                    ))
                }
            </div>
            <div className={classes.centerContainer}>
                <Fab color="secondary" aria-label="Add Area"
                    className={classes.margin} >
                    <AddIcon/>
                </Fab>
                <Fab color="primary" aria-label="Home"
                    onClick={() => props.history.push('/')}
                    className={classes.margin} >
                    <HomeIcon/>
                </Fab>
            </div>
        </div>
    );
}

AllArea.propTypes = {
    classes: PropTypes.object.isRequired,
};

const mapProps = (state) => {
    return {
        Areas: state.Lists.areas,
        Customers: state.Lists.customers,
    }
}
const mapDispatch = (dispatch) => {
    return {
        fetchAreas : (callback) => {
            dispatch(fetchAreas(callback));
        },
        fetchCustomers : (callback) => {
            dispatch(fetchCustomers(callback));
        },
    }
}

export default connect(mapProps,mapDispatch)(withStyles(AllAreaClasses)(AllArea));