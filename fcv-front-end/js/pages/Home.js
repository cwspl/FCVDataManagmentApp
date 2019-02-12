import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import Header from "./../components/Header";

const styles = theme => ({  
    // classes
});

function HomePage(props) {
    return (
        <div>
            <Header {...props} loadingStatus={props.mainLoading} />
            <div style={{ paddingTop: 80 }}></div>
            { props.children }
        </div>
    );
}

HomePage.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(HomePage);