export default (theme) => ({
    root: {
        display: 'flex',
        width: '100%',
        maxWidth: theme.breakpoints.values.md,
        marginTop: theme.spacing.unit * 2,
        margin: 'auto',
        overflowX: 'auto',
    },
    searchCustomer: { 
        display: 'flex',
        width: '85%',
        maxWidth: theme.breakpoints.values.sm,
        margin: 'auto',
    },
    table: {
        minWidth: 700,
        padding: theme.spacing.unit*3,
    },
    tableBody: {
        height: '80vh',
        overflowY: 'auto',
    },
    evenBackground: {
        backgroundColor: 'rgba(200,200,200,.2)',
    },
    selectedCell:{
        outline: '2px solid '+theme.palette.primary.light,
    },
    tableOption:{
        display: 'flex', 
        flexWarp: 'wrap',
        alignItems: 'center',
        padding: '20px 40px',
        margin: 'auto',
        maxWidth: theme.breakpoints.values.md,
        justifyContent: 'space-evenly'
    },
    sticky: {
        backgroundColor: '#FFFFFF',
        boxShadow: '0px 1px 0px 0px #ddd',
        position: 'sticky',
        top: '-2px',
        padding: '5px',
        textAlign: 'center',
        zIndex: 10,
    },
    cell:{
        padding: '5px',
        textAlign: 'center',
        minWidth: '35px',
        borderLeft : ' 1px solid #ddd', 
    }
});