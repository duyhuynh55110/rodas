import ListData from './gift-boxs/list';
import FormData from './gift-boxs/form';

// init list
if($('#giftBoxsList').length > 0) {
    new ListData();
}

// init form
if($('#giftBoxForm').length > 0) {
    new FormData();
}

export default {}
