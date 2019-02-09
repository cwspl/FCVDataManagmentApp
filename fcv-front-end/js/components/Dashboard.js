
import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import LocationOn from '@material-ui/icons/LocationOn';
import AddLocation from '@material-ui/icons/AddLocation';
import AddCircle from '@material-ui/icons/AddCircle';
import GroupAdd from '@material-ui/icons/GroupAdd';


import Button from '@material-ui/core/Button';
import Badge from '@material-ui/core/Badge';

import Dialog from '@material-ui/core/Dialog';
import DialogContent from '@material-ui/core/DialogContent';
import Slide from '@material-ui/core/Slide';

import Blue from '@material-ui/core/colors/Blue';

const styles = theme => ({
    margin: {
      margin: theme.spacing.unit,
    },
    extendedIcon: {
      marginRight: theme.spacing.unit,
    },
    blueButton: {
        margin: theme.spacing.unit,
        backgroundColor: Blue[500],
            '&:hover': {
                backgroundColor: Blue[700],
            }
    },
    successButton: {
        margin: theme.spacing.unit,
        backgroundColor: theme.status.success.main,
            '&:hover': {
                backgroundColor: theme.status.success.dark,
            }
    }
});

function Transition(props) {
    return <Slide direction="up" {...props} />;
}  

function Dashboard(props) {
    const { classes } = props;
    const [openAdd, setOpenAdd] = React.useState(false);
    return (
        <div>
            <Badge color="secondary" badgeContent={4} className={classes.margin}>
                <Button variant="contained" size="large" color="primary" className={classes.blueButton} 
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

export default withStyles(styles)(Dashboard);