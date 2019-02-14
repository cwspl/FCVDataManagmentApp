
import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';

import LinearProgress from '@material-ui/core/LinearProgress';
import Typography from '@material-ui/core/Typography';
import Table from '@material-ui/core/Table';
import TableBody from '@material-ui/core/TableBody';
import TableCell from '@material-ui/core/TableCell';
import TableHead from '@material-ui/core/TableHead';
import TableRow from '@material-ui/core/TableRow';
import Paper from '@material-ui/core/Paper';
import FormControlLabel from '@material-ui/core/FormControlLabel';
import Checkbox from '@material-ui/core/Checkbox';
import TextField from '@material-ui/core/TextField';
import IconButton from '@material-ui/core/IconButton';
import Button from '@material-ui/core/Button';
import InputAdornment from '@material-ui/core/InputAdornment';
import SearchIcon from '@material-ui/icons/Search';
import FirstPageIcon from '@material-ui/icons/FirstPage';
import LastPageIcon from '@material-ui/icons/LastPage';
import ChevronLeftIcon from '@material-ui/icons/ChevronLeft';
import ChevronRightIcon from '@material-ui/icons/ChevronRight';
import ArrowDropDown from '@material-ui/icons/ArrowDropDown';
import TableFooter from '@material-ui/core/TableFooter';
import Menu from '@material-ui/core/Menu';
import MenuItem from '@material-ui/core/MenuItem';

const styles = theme => ({
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
    progressBar: {
        backgroundColor: theme.palette.secondary.main
    },
    evenBackground: {
        backgroundColor: 'rgba(200,200,200,.2)',
    },
    selectedRow:{
        border: '2px solid '+theme.palette.primary.main,
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
    }
});
  

function CustomerTable(props) {
    const { classes } = props;
    const [areas, setAreas ] = React.useState([]);
    const [allCustomers, setAllCustomers ] = React.useState([]);
    const [filteredCustomers, setFilteredCustomers ] = React.useState([]);
    const [loading, setLoading ] = React.useState(true);
    const [fetchCall, setFetchCall ] = React.useState(true);
    const [activeCustomer, setActiveCustomer ] = React.useState(-1);
    const [selectedCustomers, setSelectedCustomer ] = React.useState({
        'all' : false,
        'selectedId' : []
    });
    
    const [anchorTableRowMenu, setAnchorTableRowMenu] = React.useState(null);
    const [rowsPerPage, setRowsPerPage] = React.useState(10);
    const [rowsPage, setRowsPage] = React.useState(0);
    
    function openTableRowMenu(event){
        setAnchorTableRowMenu(event.currentTarget);
    }
    function closeTableRowMenu() {
        setAnchorTableRowMenu(null);
    }
    const changeTableRow = (event) =>{
        setRowsPerPage(event.currentTarget.innerText);
        closeTableRowMenu();
    }
    const handleSelectedCustomer = (id, state) => {
        if(id == 'all'){
            setSelectedCustomer({ ...selectedCustomers, [id]: state });
        } else {
            if(state){
                let customerIds = [...selectedCustomers.selectedId, id];
                setSelectedCustomer({ ...selectedCustomers, selectedId: customerIds });
            } else {
                let customerIds = selectedCustomers.selectedId.filter(customer_id => (customer_id != id));
                setSelectedCustomer({ ...selectedCustomers, selectedId: customerIds });
            }
        }
    }
    const fetchTable = () => {
        let postData = new FormData();
        postData.append('requestType', 'GET');
        postData.append('requestURL', props.requestURL+'customers/'+props.match.params.areaId+'/'+props.match.params.year);
        setFetchCall(false);
        setLoading(true);
        fetch(props.authenticationBindingUrl, {
            body: postData,
            method: 'POST',
        })
        .then(function(response) { return response.json(); })
        .then(function(data) {
            if(data.responseCode == 200){
                setAreas(data.response.areas);
                setAllCustomers(
                    data.response.areas.map(area => { return area.customers }).flat()
                    .sort(function(a, b) {
                        var nameA = a.name_english.toUpperCase();
                        var nameB = b.name_english.toUpperCase();
                        return (nameA < nameB) ? -1 : (nameA > nameB) ? 1 : 0;
                    })
                );
                setFilteredCustomers(
                    data.response.areas.map(area => { return area.customers }).flat()
                    .sort(function(a, b) {
                        var nameA = a.name_english.toUpperCase();
                        var nameB = b.name_english.toUpperCase();
                        return (nameA < nameB) ? -1 : (nameA > nameB) ? 1 : 0;
                    })
                );
                setLoading(false);
            }
        }).catch(function() {
            setLoading(false);
        });
    };
    if(fetchCall){
        fetchTable();
    }
    const [searchActiveText, setSearchActiveText ] = React.useState(' ');
    const searchInTable = (event) => {
        setFilteredCustomers(allCustomers.slice(0).filter(customer => (
            customer.name.includes(event.target.value) || 
            customer.name_english.includes(event.target.value) ||
            customer.phone.includes(event.target.value) ||
            customer.account_numbers.map(account_n => (account_n.number)).join(' ').includes(event.target.value)
        )))
        setRowsPage(0);
    }
    return (
        <div>
            <Typography className={classes.margin} component="h2" variant="subtitle1" align="center" gutterBottom>
                Customers of {(props.match.params.areaId == "all") ? "all" : areas.map(area => { return area.area_name }).join(' , ') }
            </Typography>
            <div className={classes.searchCustomer}>
                <TextField
                    style={{ flexGrow : 1}}
                    label="Search in Table"
                    onChange={searchInTable}
                    margin="normal"
                    variant="outlined"
                    onFocus={() => setSearchActiveText('by Name, Mobile Number, Account Number')}
                    onBlur={() => setSearchActiveText(' ')}
                    helperText={searchActiveText}
                    InputProps={{
                        endAdornment: (
                            <InputAdornment position="end">
                                <IconButton aria-label="Search">
                                    <SearchIcon/>
                                </IconButton>
                            </InputAdornment>
                        ),
                    }}
                />
            </div>
            <LinearProgress className={classes.progressBar} style={{ display : loading ? 'block' : 'none'}}/>
            <Paper className={classes.root}>
                <Table className={classes.table}>
                    <TableHead>
                        <TableRow>
                            <TableCell className={classes.sticky} >
                            <FormControlLabel
                                style={{maxWidth: 50, paddingLeft: '7.5px'}}
                                control={
                                <Checkbox
                                    checked={selectedCustomers.all}
                                    onChange={() => handleSelectedCustomer('all', event.target.checked)}
                                    color="primary"/> }
                                label="All" />
                            </TableCell>
                            <TableCell className={classes.sticky} >Name</TableCell>
                            {
                                ['January', 'February', 'March', 'April', 'May',
                                'June', 'July', 'August', 'September',
                                'October', 'November', 'December'
                                ].map(month => (
                                    <TableCell className={classes.sticky} key={month} colSpan={2}>{month}</TableCell>
                                ))
                            }
                        </TableRow>
                    </TableHead>
                    <TableBody className={classes.tableBody}>
                    {
                        filteredCustomers.slice(rowsPerPage*rowsPage, rowsPerPage*(rowsPage+1))
                        .map(function(customer, customer_index) {
                            let cellBackground = `rgba(
                                    ${  (customer.customer_payments[props.match.params.year].status == "under_pay") 
                                        ? '255, 210, 210, ' : '210, 255, 210, '}
                                    ${(activeCustomer == customer.customer_id) ? '1' :(customer_index%2!=0) ? '0.25' : '.5'}
                                )`;
                            return (
                            <TableRow 
                                className={ selectedCustomers.selectedId.includes(customer.customer_id) || selectedCustomers.all ? classes.selectedRow : ''}
                                onClick={() => setActiveCustomer(customer.customer_id)} key={customer_index}>
                                <TableCell style={{maxWidth: 10, padding: '0px'}} className={(customer_index%2!=0) ? '': classes.evenBackground} >
                                    <Checkbox 
                                        onChange={() => handleSelectedCustomer(customer.customer_id, event.target.checked)}
                                        checked={(selectedCustomers.all) ? true : selectedCustomers.selectedId.includes(customer.customer_id) }/>
                                </TableCell>
                                <TableCell
                                    style={{minWidth: 130, padding: '0px'}} className={(customer_index%2!=0) ? '': classes.evenBackground}>{customer.name}</TableCell>
                                {
                                    Object.keys(customer.customer_payments[props.match.params.year].months)
                                    .map(function(key) {
                                        let pay = customer.customer_payments[props.match.params.year].months;
                                        return [pay[key].charge, pay[key].paid];
                                    }).flat()
                                    .map(function(pay, pay_index) {
                                        return (
                                        <TableCell className={classes.cell} key={pay_index} style={{
                                            color: (pay_index%2==0) ? 'red': 'blue',
                                            borderLeft : ' 1px solid #ddd', 
                                            backgroundColor : cellBackground,
                                        }}>{(pay == null) ? '-' : pay}</TableCell>
                                    )})
                                }
                            </TableRow>
                        )})
                    }
                    </TableBody>
                    <TableFooter>
                        <TableRow>
                        <TableCell colSpan={13}>
                            <div className={classes.tableOption}>
                                <Typography>Customers Per Page</Typography>
                                <Button
                                    onClick={openTableRowMenu} 
                                    aria-owns={anchorTableRowMenu ? 'tableRowMenu' : undefined}
                                    variant="outlined" color="primary">
                                    {rowsPerPage}  <ArrowDropDown/>
                                </Button>
                                <Menu id="tableRowMenu" anchorEl={anchorTableRowMenu} open={Boolean(anchorTableRowMenu)} onClose={closeTableRowMenu}>
                                    <MenuItem onClick={changeTableRow}>10</MenuItem>
                                    <MenuItem onClick={changeTableRow}>20</MenuItem>
                                    <MenuItem onClick={changeTableRow}>50</MenuItem>
                                </Menu>
                                <Typography>{(rowsPerPage*rowsPage)+1} - {(rowsPerPage*rowsPage)+filteredCustomers.slice(rowsPerPage*rowsPage, rowsPerPage*(rowsPage+1)).length} of {filteredCustomers.length}</Typography>
                                <IconButton disabled={(rowsPage==0)} onClick={() => setRowsPage(0)}>
                                    <FirstPageIcon/>
                                </IconButton>
                                <IconButton disabled={(rowsPage==0)} onClick={() => setRowsPage(rowsPage-1)}>
                                    <ChevronLeftIcon/>
                                </IconButton>
                                <IconButton disabled={(Math.floor(filteredCustomers.length/rowsPerPage)==rowsPage)} onClick={() => setRowsPage(rowsPage+1)}>
                                    <ChevronRightIcon/>
                                </IconButton>
                                <IconButton disabled={(Math.floor(filteredCustomers.length/rowsPerPage)==rowsPage)} onClick={() => setRowsPage(Math.floor(filteredCustomers.length/rowsPerPage))}>
                                    <LastPageIcon/>
                                </IconButton>
                            </div>
                        </TableCell>
                        </TableRow>
                    </TableFooter>
                </Table>
            </Paper>
        </div>
    );
}

CustomerTable.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(CustomerTable);