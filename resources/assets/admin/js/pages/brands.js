import ListData from './brands/list';
import FormData from './brands/form';

// init list
if($('#brandsList').length > 0) {
    new ListData();
}

// init form
if($('#brandForm').length > 0) {
    new FormData();
}

export default {}
