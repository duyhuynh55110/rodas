import ListData from './products/list';
import FormData from './products/form';

// init list
if($('#products-list').length > 0) {
    new ListData();
}

// init form
if($('#product-form').length > 0) {
    new FormData();
}

export default {}
