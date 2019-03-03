import Blue from '@material-ui/core/colors/blue';
export default (theme) => ({
    margin: {
        margin: theme.spacing.unit,
    },
    extendedIcon: {
        marginRight: theme.spacing.unit,
    },
    BlueButton: {
        width: '100%',
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
    },
    centerContainer:{
        margin: 'auto',
        padding: theme.spacing.unit*3,
        display: 'flex',
        justifyContent: 'center',
        flexDirection: 'column',
        maxWidth: theme.breakpoints.values.sm
    },
});