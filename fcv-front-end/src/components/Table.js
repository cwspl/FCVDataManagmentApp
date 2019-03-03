
import PropTypes from 'prop-types';

import withStyles from '@material-ui/core/styles/withStyles';
import Loading from './Loading';
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
import classNames from 'classnames';

const TableAction = React.lazy(() => import(/* webpackChunkName: "TableAction" */"./TableAction"));

import { fetchTable } from './../data/actions/tableActions';
import TableClasses from './../styles/TableClasses';
import { connect } from 'react-redux';

function CustomerTable(props) {
    
    const { classes, TableData } = props;
    const [areas, setAreas ] = React.useState([]);
    const [allCustomers, setAllCustomers ] = React.useState([]);
    const [filteredCustomers, setFilteredCustomers ] = React.useState([]);
    const [activeCustomer, setActiveCustomer ] = React.useState(-1);
    const [selectedCustomers, setSelectedCustomer ] = React.useState({
        'all' : false,
        'selectedId' : []
    });
    const [selectedCell, setSelectedCell ] = React.useState({
        'customerData' : [],
        'cellType' : '',
        'cellMonth' : '',
    });

    React.useEffect(() => {
        props.fetchTable(
            props.match.params.areaId,
            props.match.params.year
        );
    }, []);

    React.useEffect(() => {
        if(TableData){
            setAreas(TableData.map(area => { return area.area_name }).join(' , '));
            let shortTable = 
                TableData.slice(0).filter(area => props.match.params.areaId.includes(area.area_id))
                .map(area => {
                    return area.customers.map(customer => 
                        ({...customer, area: area.area_id}))
                }).flat()
                .sort(function(a, b) {
                    var nameA = a.name_english.replace(/[^A-Za-z]/g, '').trim().toUpperCase();
                    var nameB = b.name_english.replace(/[^A-Za-z]/g, '').trim().toUpperCase();
                    return (nameA < nameB) ? -1 : (nameA > nameB) ? 1 : 0;
                });
            setAllCustomers(shortTable);
            setFilteredCustomers(shortTable);
        }
    }, [TableData]);
    
    const [anchorTableRowMenu, setAnchorTableRowMenu] = React.useState(null);
    const [rowsPerPage, setRowsPerPage] = React.useState(10);
    const [rowsPage, setRowsPage] = React.useState(0);
    
    const openTableRowMenu = (event) => {
        setAnchorTableRowMenu(event.currentTarget);
    }
    const closeTableRowMenu = () => {
        setAnchorTableRowMenu(null);
    }
    const changeTableRow = (event) =>{
        (event.currentTarget.innerText == 'All') ? 
        setRowsPerPage(allCustomers.length) :
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
        <React.Suspense fallback={<Loading show={true}/>}>
            <Typography className={classes.margin} component="h2" variant="subtitle1" align="center" gutterBottom>
                Customers of {(props.match.params.areaId == "all") ? "all" : areas }
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
                                    ${(activeCustomer == customer.customer_id) ? '.8' :(customer_index%2!=0) ? '0.25' : '.5'}
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
                                    onClick={() => setSelectedCell({...selectedCell, customerData: customer, cellType: 'name' })}
                                    style={{minWidth: 130, padding: '10px'}} className={
                                        classNames({
                                            [classes.evenBackground]: (customer_index%2==0),
                                            [classes.selectedCell] : (selectedCell.customerData.customer_id == customer.customer_id) && (selectedCell.cellType == 'name')
                                        }) }>{customer.name}</TableCell>
                                {
                                    Object.keys(customer.customer_payments[props.match.params.year].months)
                                    .map(function(key) {
                                        let pay = customer.customer_payments[props.match.params.year].months;
                                        return [pay[key].charge, pay[key].paid];
                                    })
                                    .map(function(pay, pay_index) {
                                        return (
                                            <React.Fragment key={pay_index}>
                                                <TableCell 
                                                onClick={() => setSelectedCell({...selectedCell, 
                                                    customerData: customer, 
                                                    cellType: 'charge',
                                                    cellMonth: pay_index+1,
                                                })}
                                                className={classNames({
                                                    [classes.cell]:true,
                                                    [classes.selectedCell]: (
                                                        selectedCell.cellMonth == pay_index+1 && 
                                                        selectedCell.customerData.customer_id == customer.customer_id && 
                                                        selectedCell.cellType == 'charge'
                                                    )
                                                })}
                                                style={{
                                                    color: 'red',
                                                    backgroundColor : cellBackground,
                                                }}>
                                                    {(pay[0] == null) ? '-' : pay[0]}
                                                </TableCell>
                                                <TableCell 
                                                onClick={() => setSelectedCell({...selectedCell, 
                                                    customerData: customer, 
                                                    cellType: 'paid',
                                                    cellMonth: pay_index+1,
                                                })}
                                                className={classNames({
                                                    [classes.cell]:true,
                                                    [classes.selectedCell]: (
                                                        selectedCell.cellMonth == pay_index+1 && 
                                                        selectedCell.customerData.customer_id == customer.customer_id && 
                                                        selectedCell.cellType == 'paid'
                                                    )
                                                })}
                                                style={{
                                                    color: 'blue',
                                                    backgroundColor : cellBackground,
                                                }}>
                                                    {(pay[1] == null) ? '-' : pay[1]}
                                                </TableCell>
                                            </React.Fragment>
                                        )
                                    })
                                }
                            </TableRow>
                        )})
                    }
                    </TableBody>
                    <TableFooter>
                        {(allCustomers.length > 10) && <TableRow>
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
                                    <MenuItem onClick={changeTableRow}>All</MenuItem>
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
                        </TableRow>}
                    </TableFooter>
                </Table>
            </Paper>
            <TableAction {...selectedCell}/>
        </React.Suspense>
    );
}

CustomerTable.propTypes = {
    classes: PropTypes.object.isRequired,
};

const mapProps = (state) => {
    return {
        TableData: state.Table.areas
    }
}
const mapDispatch = (dispatch) => {
    return {
        fetchTable : (area_ids, years, callback) => {
            dispatch(fetchTable(area_ids, years, callback));
        },
    }
}

export default connect(mapProps, mapDispatch)(withStyles(TableClasses)(CustomerTable));