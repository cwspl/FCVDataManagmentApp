import PropTypes from 'prop-types';
import withStyles from '@material-ui/core/styles/withStyles';
import Button from '@material-ui/core/Button';
import Dialog from '@material-ui/core/Dialog';
import DialogActions from '@material-ui/core/DialogActions';
import DialogContent from '@material-ui/core/DialogContent';
import DialogTitle from '@material-ui/core/DialogTitle';
import Fab from '@material-ui/core/Fab';
import Slide from '@material-ui/core/Slide';
import CustomerInfo from './CustomerInfo';

// const CustomerInfo = React.lazy(() => import(/* webpackChunkName: "Customer Info" */"./CustomerInfo"));

import InfoIcon from '@material-ui/icons/Info';
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
    
    const { classes, customerData } = props;
    const [dialog, setDialog] = React.useState({
        open: false,
        title: '',
        content: '',
        action: '',
    });

    React.useEffect(() => {
        if(props.cellType == 'name'){
            setDialog({...dialog,
                title: 'Customer Information',
                content: (<CustomerInfo customerData={customerData} />),
            });
        }
    }, [customerData]);

    return (
        <React.Fragment>
            {
                (props.cellType == 'name') ? 
                <Fab
                    onClick={() => setDialog({...dialog, open: true})}
                    color="primary" aria-label="InfoIcon" className={classes.Fab}>
                    <InfoIcon className={classes.extendedIcon} />
                </Fab> : ''
            }
            
            <Dialog
                open={dialog.open}
                TransitionComponent={Transition}
                fullWidth={true}
                maxWidth='sm'
                keepMounted
                onClose={() => setDialog({...dialog, open: false})}
                aria-labelledby="alert-dialog-title">
                <DialogTitle id="alert-dialog-title">{dialog.title}</DialogTitle>
                <DialogContent>
                    {dialog.content}
                </DialogContent>
                <DialogActions>
                    <Button onClick={() => setDialog({...dialog, open: false})} color="primary" autoFocus>
                        Close
                    </Button>
                </DialogActions>
            </Dialog>
        </React.Fragment>
    );
}

Action.propTypes = {
    classes: PropTypes.object.isRequired,
};

export default withStyles(styles)(Action);