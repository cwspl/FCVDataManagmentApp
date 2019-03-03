export default (theme) => ({
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