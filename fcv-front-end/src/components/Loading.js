import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import LinearProgress from '@material-ui/core/LinearProgress';

const styles = theme => ({
    progressBar: {
        backgroundColor: theme.palette.secondary.main,
        position: 'fixed',
        top: 0,
        left: 0,
        zIndex: 10000,
        width: '100%',
    }
});


function LoadingBar(props) {
    const { classes } = props;
    return ((!props.show) ? '' : <LinearProgress className={classes.progressBar} />)
}
LoadingBar.propTypes = {
    classes: PropTypes.object.isRequired,
};
export default withStyles(styles)(LoadingBar);