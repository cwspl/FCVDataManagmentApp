import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import Button from '@material-ui/core/Button';
const styles = theme => ({

});

function AllArea(props) {
    const { classes } = props;
    return (
        <div>
           <Button variant="contained" size="large" color="primary" className={classes.blueButton} onClick={() => props.history.push('/')}> Home </Button>
        </div>
    );
}

AllArea.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(AllArea);