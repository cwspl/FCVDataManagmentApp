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
const styles = theme => ({
    background: {
        backgroundColor: theme.palette.primary.main,
        display: 'flex',
        width: '100%',
        height: '100vh',
        justifyContent: 'center',
        alignItems: 'center',
        [theme.breakpoints.up('sm')]: {
            backgroundColor: theme.palette.primary.dark,
        },
    },
    formText: {
        color: theme.palette.primary.contrastText,
        fontSize: 24,
        padding: 20
    },
    form: {
        color: '#ffffff !important',
        maxWidth: '400px',
        width: '100%',
        backgroundColor: theme.palette.primary.main,
        padding: '20px',
        position: 'relative',
        borderRadius: theme.shape.borderRadius,
        [theme.breakpoints.up('sm')]: {
            backgroundColor: theme.palette.primary.main,
        },
    },
    flexCenter:{
        position: 'relative',
        display: 'flex',
        flexDirection: 'column',
        justifyContent: 'center',
        alignItems: 'center',
    },
    wrapper: {
      margin: theme.spacing.unit,
      position: 'relative',
    },
    buttonSuccess: {
      backgroundColor: theme.status.success.main,
      color: theme.status.success.contrastText,
      '&:hover': {
        backgroundColor: theme.status.success.dark,
      },
    },
    buttonError: {
      backgroundColor: theme.palette.error.main,
      color: theme.palette.error.contrastText,
      '&:hover': {
        backgroundColor: theme.palette.error.dark,
      },
    },
    fabProgress: {
      color: theme.palette.secondary.dark,
      position: 'absolute',
      top: -6,
      left: -6,
      zIndex: 1,
    },
    loginButton: {
        margin: theme.spacing.unit,
        marginTop: "-25px",
        position: 'relative',
    },
});
function LoginForm(props) {
    const { classes } = props;
    const requestURL = props.functions.state.requestURL;
    const [values, setValues] = React.useState({
        loading: false,
        success: false,
        error: false,
        errorMessage: '',
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
        [classes.buttonSuccess]: values.success,
        [classes.buttonError]: values.error,
    });
    function login() {
        if (!values.loading) {
            handleChangeValue('error',false);
            handleChangeValue('success',false);
            handleChangeValue('loading',true);
            let postRequest = {
                "requestURL": requestURL+"agent/login",
                "login": true,
                "agent_email_address": values.email,
	            "agent_password": values.password
            };
            fetch('includes/authenticationBinder.php', {
                headers: {
                    'Content-type': 'application/x-www-form-urlencoded'
                },
                method: 'POST',
                body: Object.keys(postRequest).map(key => encodeURIComponent(key) + 
                '=' + encodeURIComponent(postRequest[key])).join('&')
                })
                .then(function(response) { return response.json(); })
                .then(function(data) {
                    handleChangeValue('loading',false);
                    if(data.login == 'success'){
                        handleChangeValue('success',true);
                        localStorage.setItem('loginSession', data.token);
                        props.functions.checkLogin();
                    } else {
                        handleChangeValue('error',true);
                        handleChangeValue('errorMessage',data.error);
                    }
                }).catch(function() {
                    handleChangeValue('error',true);
                    handleChangeValue('loading',false);
                    handleChangeValue('errorMessage',"Connection Failed");
                });
        }
    }
    return (
        <div className={classes.background}>
        <Card className={classes.form}>
            <CardContent className={classes.flexCenter}>
                <img src="images/fcv_main_logo.svg" width='200'/>
                <Typography component="h2"  className={classes.formText} gutterBottom>
                    Login
                </Typography>
                <Card>
                    <CardContent style={{paddingBottom : "40px"}} className={classes.flexCenter}>
                        <Typography color='error' variant="body1" gutterBottom>{values.errorMessage}</Typography>
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
                    <Fab color="secondary" className={buttonClassname} onClick={login} disabled={(!isEmail(values.email) || !isLength(values.email, {min : 5, max : 255}) || !isLength(values.password, {min : 3, max : 255}))}>
                        {values.error ? <RefreshIcon /> : values.success ? <CheckIcon /> : <ArrowForwardIos/> }
                    </Fab>
                    {values.loading && <CircularProgress size={68} className={classes.fabProgress} />}
                </div>
            </CardContent>
        </Card>
        </div>
    );
}
  
LoginForm.propTypes = {
    classes: PropTypes.object.isRequired,
};
  
export default withStyles(styles)(LoginForm);