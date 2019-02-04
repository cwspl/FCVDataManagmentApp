import React, { useState } from "react";
import classNames from 'classnames';
import PropTypes from 'prop-types';
import { withStyles } from '@material-ui/core/styles';
import { Typography, Fab, CircularProgress, TextField, Card, CardContent } from '@material-ui/core';
import CheckIcon from '@material-ui/icons/Check';
import RefreshIcon from '@material-ui/icons/Refresh';
import ArrowForwardIos from '@material-ui/icons/ArrowForwardIos';

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
    const [loading, setLoading] = useState(false);
    const [success, setSuccess] = useState(false);
    const [error, setError] = useState(false);
    const [email, setEmail] = useState('');
    const [password, setPassword] = useState('');

    const buttonClassname = classNames({
        [classes.buttonSuccess]: success,
        [classes.buttonError]: error,
    });
    function login() {
        if (!loading) {
            setSuccess(false);
            setError(false);
            setLoading(true);
            let postRequest = {
                'requestURL': requestURL+'agent/login',
                'login': true,
                "agent_email_address": email,
	            "agent_password": password
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
                    setLoading(false);
                    if(data.login == 'success'){
                        setSuccess(true);
                        localStorage.setItem('loginSession', data.token);
                        props.functions.checkLogin();
                    } else {
                        console.log(data);
                        setError(true);
                    }
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
                        <TextField
                            required
                            label="Username"
                            defaultValue={email}
                            className={classes.textField}
                            margin="normal"
                            variant="outlined"
                        />
                        <TextField
                            color="error"
                            required
                            label="password"
                            defaultValue={password}
                            className={classes.textField}
                            margin="normal"
                            variant="outlined"
                        />
                    </CardContent>
                </Card>
                <div className={classes.loginButton}>
                    <Fab color="secondary" className={buttonClassname} onClick={login}>
                        {error ? <RefreshIcon /> : success ? <CheckIcon /> : <ArrowForwardIos/> }
                    </Fab>
                    {loading && <CircularProgress size={68} className={classes.fabProgress} />}
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