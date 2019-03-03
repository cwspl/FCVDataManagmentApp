export default (theme) => ({
    margin: {
        margin: theme.spacing.unit,
    },
    centerContainer:{
        margin: theme.spacing.unit,
        display: 'flex',
        justifyContent: 'center',
    },
    AreaList:{
        margin: 'auto',
        padding: theme.spacing.unit*3,
        display: 'flex',
        justifyContent: 'center',
        flexDirection: 'column',
        maxWidth: theme.breakpoints.values.sm
    },
    extendedIcon: {
        marginRight: theme.spacing.unit,
    },
});