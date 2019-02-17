import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import Fab from '@material-ui/core/Fab';
import List from '@material-ui/core/List';
import ListItem from '@material-ui/core/ListItem';
import ListItemText from '@material-ui/core/ListItemText';
import ListItemSecondaryAction from '@material-ui/core/ListItemSecondaryAction';
import Slide from '@material-ui/core/Slide';

import Typography from '@material-ui/core/Typography';
import IconButton from '@material-ui/core/IconButton';

import InfoIcon from '@material-ui/icons/Info';
import MobileIcon from '@material-ui/icons/Phone';
import AreaIcon from '@material-ui/icons/Place';
import AccountsIcon from '@material-ui/icons/Storage';
import AddIcon from '@material-ui/icons/Add';
import EditIcon from '@material-ui/icons/Edit';
import NameIcon from '@material-ui/icons/assignmentInd';

const styles = theme => ({  
    Fab: {
        position: 'fixed',
        bottom: '20px',
        right: '20px',
        margin: theme.spacing.unit,
    }
});
const Transition = (props) => {
    return <Slide direction="left" {...props} />;
}
function Action(props) {
    const { classes } = props;
    const [dialog, setDialog] = React.useState({
        open: false,
        title: '',
        content: '',
        action: '',
    });
    const customerInfo = () =>
    setDialog({...dialog,
        open: true,
        title: 'Customer Information',
        content: (
        <List>
            <ListItem>
                <NameIcon/>
                <ListItemText
                    primary={props.customerData.name}
                    secondary="Name"/>
                <ListItemSecondaryAction>
                    <IconButton color="primary">
                        <EditIcon/>
                    </IconButton>
                </ListItemSecondaryAction>
            </ListItem>
            <ListItem>
                    <AreaIcon/>
                <ListItemText
                    primary={props.customerData.area}
                    secondary="Area"/>
                <ListItemSecondaryAction>
                    <IconButton color="primary">
                        <EditIcon/>
                    </IconButton>
                </ListItemSecondaryAction>
            </ListItem>
            <ListItem>
                    <MobileIcon/>
                <ListItemText
                    primary={props.customerData.phone}
                    secondary="Phone"/>
                <ListItemSecondaryAction>
                    <IconButton color="primary">
                        <EditIcon/>
                    </IconButton>
                </ListItemSecondaryAction>
            </ListItem>
            <ListItem>
                <AccountsIcon/>
                <ListItemText
                    primary="Account Numbers"/>
                <ListItemSecondaryAction>
                    <Fab size="small" color="secondary">
                        <AddIcon/>
                    </Fab>
                </ListItemSecondaryAction>
            </ListItem>
            <ListItem>
                <ListItemText
                    primary={
                        props.customerData.account_numbers.map(function(account,key) {return (
                            <React.Fragment key={key}>
                                <Typography component="span" style={{display: 'inline', width: '100%'}} color="textPrimary">
                                    {account.number}
                                </Typography>
                                <IconButton color="primary">
                                    <EditIcon/>
                                </IconButton>
                                <hr/>
                            </React.Fragment>
                        )})
                    }/>
            </ListItem>
        </List>),
        action: (
            <React.Fragment>
                <Button onClick={() => setDialog({...dialog, open: false})} color="primary" autoFocus>
                    Close
                </Button>
            </React.Fragment>
        ),
    });
    return (
        <div>
            {
                (props.cellType == 'name') ? 
                <Fab
                    onClick={customerInfo} 
                    color="primary" aria-label="InfoIcon" className={classes.Fab}>
                    <InfoIcon className={classes.extendedIcon} />
                </Fab> : ''
            }
            
            <Dialog
                open={dialog.open}
                TransitionComponent={Transition}
                keepMounted
                onClose={() => setDialog({...dialog, open: false})}
                aria-labelledby="alert-dialog-title">
                <DialogTitle id="alert-dialog-title">{dialog.title}</DialogTitle>
                <DialogContent>
                    {dialog.content}
                </DialogContent>
                <DialogActions>
                    {dialog.action}
                </DialogActions>
            </Dialog>
        </div>
    );
}

Action.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(Action);