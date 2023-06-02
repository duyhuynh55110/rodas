import ListData from './products/list';
import FormData from './products/form';

// init list
if($('#productsList').length > 0) {
    new ListData();
}

// init form
if($('#productForm').length > 0) {
    new FormData();
}

export default {}
