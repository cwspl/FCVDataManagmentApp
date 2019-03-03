import { connect } from 'react-redux';
import { loginUser } from './../data/actions/appActions'

import classNames from 'classnames';
import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import Typography from '@material-ui/core/Typography';
import Fab from '@material-ui/core/Fab';
import CircularProgress from '@material-ui/core/CircularProgress';
import TextField from '@material-ui/core/TextField';
import Card from '@material-ui/core/Card';
import CardContent from '@material-ui/core/CardContent';
import InputAdornment from '@material-ui/core/InputAdornment';
import IconButton from '@material-ui/core/IconButton';
import CheckIcon from '@material-ui/icons/Check';
import RefreshIcon from '@material-ui/icons/Refresh';
import ArrowForwardIos from '@material-ui/icons/ArrowForwardIos';
import Visibility from '@material-ui/icons/Visibility';
import VisibilityOff from '@material-ui/icons/VisibilityOff';
import isEmail from 'validator/lib/isEmail';
import isLength from 'validator/lib/isLength';

import mainLogo from './../assets/fcv_main_logo.svg';
import LoginClasses from './../styles/LoginClasses';

function LoginForm(props) {
    const { classes } = props;
    const [values, setValues] = React.useState({
        email: '',
        emailError: '',
        password: '',
        passwordError: '',
        formError: '',
        passwordVisible: false,
    });
    const handleChange = prop => event => {
        setValues({ ...values, [prop]: event.target.value });
    };
    const handleChangeValue = (prop, value) => {
        setValues({ ...values, [prop]: value });
    };
    const validPassword = () => {
        if(!isLength(values.password, {min : 3, max : 255})){
            handleChangeValue("passwordError", "Invalid Password !!");
        } else {
            handleChangeValue("passwordError", "");
        }
    };
    const validEmail = () => {
        if(!isEmail(values.email) || !isLength(values.email, {min : 5, max : 255}) ){
            handleChangeValue("emailError", "Invalid Email Address !!");
        } else {
            handleChangeValue("emailError", "");
        }
    };
    const buttonClassname = classNames({
        [classes.buttonSuccess]: props.loginToken != null,
        [classes.buttonError]: props.loginError.error,
    });

    function login(event) {
        event.preventDefault();
        if (!props.loading) {
            props.loginUser({
                email: values.email,
                password: values.password
            })
        }
        return false;
    }
    return (
        <div className={classes.background}>
        <Card className={classes.form} component="form" onSubmit={login}>
            <CardContent className={classes.flexCenter}>
                <img src={mainLogo} width='200'/>
                <Typography component="h2"  className={classes.formText} gutterBottom>
                    Login
                </Typography>
                <Card>
                    <CardContent style={{paddingBottom : "40px"}} className={classes.flexCenter}>
                        <Typography color='error' variant="body1" gutterBottom>{props.loginError.message}</Typography>
                        <TextField
                            fullWidth
                            label="Email"
                            onBlur={validEmail}
                            error={values.emailError != '' ? true : false }
                            defaultValue={values.email}
                            onChange={handleChange('email')}
                            type='email'
                            helperText={values.emailError}
                            className={classes.textField}
                            margin="normal"
                            variant="outlined"
                        />
                        <TextField
                            label="Password"
                            onBlur={validPassword}
                            error={values.passwordError != '' ? true : false }
                            defaultValue={values.password}
                            onChange={handleChange('password')}
                            helperText={values.passwordError}
                            className={classes.textField}
                            type={values.passwordVisible ? 'text' : 'password'}
                            margin="normal"
                            variant="outlined"
                            InputProps={{
                                endAdornment: (
                                    <InputAdornment position="end">
                                        <IconButton aria-label="Toggle password visibility" onClick={() => handleChangeValue('passwordVisible', !values.passwordVisible)}>
                                            {values.passwordVisible ? <VisibilityOff /> : <Visibility />}
                                        </IconButton>
                                    </InputAdornment>
                                ),
                            }}
                        />
                    </CardContent>
                </Card>
                <div className={classes.loginButton}>
                    <Fab 
                        type="submit" 
                        color="secondary" 
                        className={buttonClassname} 
                        disabled={(!isEmail(values.email) || !isLength(values.email, {min : 5, max : 255}) || !isLength(values.password, {min : 3, max : 255}))}>
                        {props.loginError.error ? <RefreshIcon /> : (props.loginToken != null ? <CheckIcon /> : <ArrowForwardIos/>) }
                    </Fab>
                    {props.loading && <CircularProgress size={68} className={classes.fabProgress} />}
                </div>
            </CardContent>
        </Card>
        </div>
    );
}
  
LoginForm.propTypes = {
    classes: PropTypes.object.isRequired,
};
const mapStateToProps = (state) => {
    return {
        ...state.App
    }
}
const mapDispatchToProps = (dispatch) => {
    return {
        loginUser : (values) => {
            dispatch(loginUser(values));
        },
    }
}
export default connect(mapStateToProps,mapDispatchToProps)(withStyles(LoginClasses)(LoginForm));