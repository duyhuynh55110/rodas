import ListData from './brands/list';
import FormData from './brands/form';

// init list
if($('#brands-list').length > 0) {
    new ListData();
}

// init form
if($('#brand-form').length > 0) {
    new FormData();
}

export default {}
