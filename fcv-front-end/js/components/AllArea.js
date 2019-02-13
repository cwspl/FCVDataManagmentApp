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
import LinearProgress from '@material-ui/core/LinearProgress';
import Switch from '@material-ui/core/Switch';
import Checkbox from '@material-ui/core/Checkbox';
import FormControlLabel from '@material-ui/core/FormControlLabel';


const styles = theme => ({
    margin: {
        margin: theme.spacing.unit,
    },
    centerContainer:{
        margin: theme.spacing.unit,
        display: 'flex',
        justifyContent: 'center',
    },
    AreaList:{
        margin: 'auto',
        padding: theme.spacing.unit*3,
        display: 'flex',
        justifyContent: 'center',
        flexDirection: 'column',
        maxWidth: theme.breakpoints.values.sm
    },
    progressBar: {
        backgroundColor: theme.palette.secondary.main
    },
    extendedIcon: {
        marginRight: theme.spacing.unit,
    },
});

function AllArea(props) {
    const { classes } = props;
    const [loading, setLoading ] = React.useState(false);
    const [fetchCall, setFetchCall ] = React.useState(true);

    const [AllArea, setAllArea ] = React.useState([]);
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
    const fetchAreas = () => {
        setFetchCall(false);
        setLoading(true);
        let postData = new FormData();
        postData.append('requestType', 'GET');
        postData.append('requestURL', props.requestURL+'areas');
        fetch(props.authenticationBindingUrl, {
            method: 'POST',
            body: postData,
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if(data.responseCode == 200){
                setAllArea(data.response.areas);
                setFilteredAreas(data.response.areas);
                setLoading(false);
            }
        }).catch(function() {
            setLoading(false);
        });
    };
    const searchArea = (event) => {
        setFilteredAreas(AllArea.slice(0).filter(area => (area.area_name.includes(event.target.value) || area.area_name_english.includes(event.target.value))))
    }
    if(fetchCall){
        fetchAreas();
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
                                <IconButton aria-label="Search" onClick={() => setLoading(!loading)}>
                                    <SearchIcon/>
                                </IconButton>
                            </InputAdornment>
                        ),
                    }}
                />
                <LinearProgress className={classes.progressBar} style={{ display : loading ? 'block' : 'none'}}/>
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
                            <Checkbox style={{ display: (!multipleAreaCheck) ? 'none' : 'block'}} checked={(multipleAreaId.all) ? true : multipleAreaId.checkedId.includes(area.area_id) } onChange={() => handleMultipleAreaId(area.area_id, event.target.checked)} />
                            <Button style={{ flexGrow: 1 }} className={classes.Button}
                                variant={((multipleAreaId.checkedId.includes(area.area_id) && multipleAreaCheck||multipleAreaId.all) ? 'contained' : 'outlined')}
                                color={((multipleAreaId.checkedId.includes(area.area_id) && multipleAreaCheck||multipleAreaId.all) ? 'secondary' : 'default')}
                                onClick={() => {
                                    if(!multipleAreaCheck){
                                        props.history.push('table/'+area.area_id+'/'+(new Date().getFullYear()))
                                    } else {
                                        handleMultipleAreaId(area.area_id, !(multipleAreaId.checkedId.includes(area.area_id)))
                                    }}} >
                                { area.area_name }
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

export default withStyles(styles)(AllArea);