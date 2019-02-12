import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import Button from '@material-ui/core/Button';
import HomeIcon from '@material-ui/icons/Home';
import AddIcon from '@material-ui/icons/Add';
import SearchIcon from '@material-ui/icons/Search';
import Fab from '@material-ui/core/Fab';
import Typography from '@material-ui/core/Typography';
import TextField from '@material-ui/core/TextField';
import IconButton from '@material-ui/core/IconButton';
import InputAdornment from '@material-ui/core/InputAdornment';
import LinearProgress from '@material-ui/core/LinearProgress';


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
});

function AllArea(props) {
    const { classes } = props;
    const [loading, setLoading ] = React.useState(false);
    const [fetchCall, setFetchCall ] = React.useState(true);
    const [AllArea, setAllArea ] = React.useState([]);
    const [filteredAreas, setFilteredAreas ] = React.useState([]);
    const fetchAreas = () => {
        setFetchCall(false);
        setLoading(true);
        let postRequest = {
          'requestType': 'GET',
          'requestURL': props.requestURL+'areas',
        };
        fetch(props.authenticationBindingUrl, {
            headers: {
                'Content-type': 'application/x-www-form-urlencoded'
            },
            method: 'POST',
            body: Object.keys(postRequest).map(key => encodeURIComponent(key) + 
            '=' + encodeURIComponent(postRequest[key])).join('&')
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
                {
                    filteredAreas.map(area => (
                        <Button variant="outlined" key={area.area_id} className={classes.Button}
                            onClick={() => props.history.push('table/'+area.area_id+'/'+(new Date().getFullYear()))} >
                            { area.area_name }
                        </Button>
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