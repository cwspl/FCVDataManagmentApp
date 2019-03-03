import { connect } from 'react-redux';
import { fetchAreas } from './../data/actions/listsActions';

import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import classNames from 'classnames';

import MenuItem from '@material-ui/core/MenuItem';
import TextField from '@material-ui/core/TextField';
import InputAdornment from '@material-ui/core/InputAdornment';
import FormControl from '@material-ui/core/FormControl';
import InputLabel from '@material-ui/core/InputLabel';
import Select from '@material-ui/core/Select';
import Input from '@material-ui/core/Input';

import MobileIcon from '@material-ui/icons/Phone';
import AreaIcon from '@material-ui/icons/Place';
import AccountsIcon from '@material-ui/icons/Storage';
import AddIcon from '@material-ui/icons/Add';
import EditIcon from '@material-ui/icons/Edit';
import NameIcon from '@material-ui/icons/assignmentInd';
import Fab from '@material-ui/core/Fab';
import { Button } from '@material-ui/core';

const styles = theme => ({ 
    textField: {
        marginTop: theme.spacing.unit,
        marginBottom: theme.spacing.unit,
        marginLeft: -theme.spacing.unit,
    },
    margin: {
      margin: theme.spacing.unit,
    },
});

function CustomerInfo(props) {
    const { classes, Areas, fetchAreas } = props;
    const [customerData, setCustomerData] = React.useState({
        readOnly: true,
        area: props.customerData.area,
        name: props.customerData.name,
        phone: props.customerData.phone,
        account_numbers : props.customerData.account_numbers
    });
    React.useEffect(() => {
        if(!Areas){
            fetchAreas();
        }
    }, []);
    React.useEffect(() => {
        setCustomerData({
            readOnly: true,
            area: props.customerData.area,
            name: props.customerData.name,
            phone: props.customerData.phone,
            account_numbers : props.customerData.account_numbers
        })
    }, [props.customerData]);
    return (
        <React.Fragment>
            <TextField
                fullWidth
                disabled={customerData.readOnly}
                className={classes.textField}
                variant="outlined"
                label="Name"
                value={customerData.name}
                onChange={()=>setCustomerData({...customerData, name : event.target.value})}
                InputProps={{
                    readOnly: customerData.readOnly,
                    startAdornment: <InputAdornment position="start"><NameIcon/></InputAdornment>,
                }}/>
            {Areas && <TextField
                select
                fullWidth
                disabled={customerData.readOnly}
                className={classes.textField}
                variant="outlined"
                label="Area"
                value={customerData.area}
                onChange={(event)=>setCustomerData({...customerData, area : event.target.value})}
                InputProps={{
                    readOnly: customerData.readOnly,
                    startAdornment: <InputAdornment position="start"><AreaIcon/></InputAdornment>,
                }}>
                {Areas.map(function(area,key){
                    return ( <MenuItem key={key} value={area.area_id}>{area.area_name}</MenuItem>)
                })}
            </TextField>} 
            <TextField
                fullWidth
                disabled={customerData.readOnly}
                className={classes.textField}
                variant="outlined"
                type="tel"
                label="Phone Number"
                value={customerData.phone}
                onChange={()=>setCustomerData({...customerData, phone : event.target.value})}
                InputProps={{
                    readOnly: customerData.readOnly,
                    startAdornment: <InputAdornment position="start"><MobileIcon/></InputAdornment>,
                }}/>
            {customerData.account_numbers.map(function(account_number,key){ return (
            <TextField
                key={key}
                fullWidth
                disabled={customerData.readOnly}
                className={classes.textField}
                variant="outlined"
                type="tel"
                label={"Account Number #"+(key+1)}
                value={account_number.number}
                onChange={()=>setCustomerData({...customerData, 
                    account_numbers :
                        customerData.account_numbers.map(acc_number => {
                            if(acc_number.id == account_number.id) { acc_number.value = event.target.value}
                            return acc_number
                        })
                    })
                }
                InputProps={{
                    readOnly: customerData.readOnly,
                    startAdornment: <InputAdornment position="start"><AccountsIcon/></InputAdornment>,
                }}/>
            )})}
            {customerData.readOnly ? 
                <Button variant="contained" color="primary" onClick={()=>setCustomerData({...customerData, readOnly: false})}> Edit </Button> :
                <React.Fragment>
                    <Button variant="contained" color="secondary" onClick={()=>setCustomerData({...customerData, readOnly: true})}> Save </Button> 
                    <Button color="primary" onClick={()=>setCustomerData({...customerData, readOnly: true})}> Cancel </Button> 
                </React.Fragment>
            }

        </React.Fragment>
    )
}
CustomerInfo.propTypes = {
    classes: PropTypes.object.isRequired,
};

const mapProps = (state) => {
    return {
        Areas: state.Lists.areas,
    }
}
const mapDispatch = (dispatch) => {
    return {
        fetchAreas : (callback) => {
            dispatch(fetchAreas(callback));
        },
    }
}
export default connect(mapProps,mapDispatch)(withStyles(styles)(CustomerInfo));