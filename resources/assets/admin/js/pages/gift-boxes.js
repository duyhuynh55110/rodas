import ListData from './gift-boxes/list';
import FormData from './gift-boxes/form';

// init list
if($('#giftBoxesList').length > 0) {
    new ListData();
}

// init form
if($('#giftBoxForm').length > 0) {
    new FormData();
}

export default {}
