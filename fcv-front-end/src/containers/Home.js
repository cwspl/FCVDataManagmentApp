import Header from "./../components/Header";
import { connect } from 'react-redux';
import { logoutUser } from './../data/actions/appActions'

function HomePage(props) {
    return (
        <React.Fragment>
            <Header {...props} />
            <div style={{ paddingTop: 80 }}></div>
            { props.children }
        </React.Fragment>
    );
}
const mapDispatchToProps = (dispatch) => {
    return {
        logoutUser : () => {
            dispatch(logoutUser());
        },
    }
}
export default  connect(null,mapDispatchToProps)(HomePage);