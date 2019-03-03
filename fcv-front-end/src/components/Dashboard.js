import { connect } from 'react-redux';

import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import LocationOn from '@material-ui/icons/LocationOn';
import AddCircle from '@material-ui/icons/AddCircle';

import GroupAdd from '@material-ui/icons/GroupAdd';
import AddLocation from '@material-ui/icons/AddLocation';


import Button from '@material-ui/core/Button';
import Badge from '@material-ui/core/Badge';

import Dialog from '@material-ui/core/Dialog';
import DialogContent from '@material-ui/core/DialogContent';
import Slide from '@material-ui/core/Slide';
import DashboardClasses from './../styles/DashboardClasses';

import { fetchAreas } from './../data/actions/listsActions';

function Transition(props) {
    return <Slide direction="up" {...props} />;
}  

function Dashboard(props) {
    const { classes, Areas, fetchAreas } = props;
    const [openAdd, setOpenAdd] = React.useState(false);

    React.useEffect(() => {
        fetchAreas();
    }, []);

    return (
        <div className={classes.centerContainer}>
            <Badge color="secondary" badgeContent={Areas && Areas.length} className={classes.margin}>
                <Button variant="contained" size="large" color="primary" className={classes.BlueButton} 
                    onClick={() => props.history.push('/all-area')}>
                    <LocationOn className={classes.extendedIcon} />
                    All Areas
                </Button>
            </Badge>
            <Button variant="contained" size="large" color="primary"
                onClick={() => setOpenAdd(true)} className={classes.successButton}>
                <AddCircle className={classes.extendedIcon} />
                Add
            </Button>
            <Dialog
                open={openAdd}
                TransitionComponent={Transition}
                keepMounted
                onClose={() => setOpenAdd(false)}
                aria-labelledby="alert-dialog-slide-title"
                aria-describedby="alert-dialog-slide-description" >
                <DialogContent>
                    Ass
                </DialogContent>
            </Dialog>
        </div>
    );
}

Dashboard.propTypes = {
    classes: PropTypes.object.isRequired,
};

const mapProps = (state) => {
    return {
        Areas: state.Lists.areas
    }
}
const mapDispatch = (dispatch) => {
    return {
        fetchAreas : (callback) => {
            dispatch(fetchAreas(callback));
        },
    }
}

export default connect(mapProps,mapDispatch)(withStyles(DashboardClasses)(Dashboard));