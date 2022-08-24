import ListData from './gift-boxs/list';
import FormData from './gift-boxs/form';

// init list
if($('#gift-boxs-list').length > 0) {
    new ListData();
}

// init form
if($('#gift-box-form').length > 0) {
    new FormData();
}

export default {}
