const BRANDS_LIST = 'table#brands-list';
const FORM_SEARCH = 'form#search-form';

export default class ListData {
    // setting for datatables
    options = {};

    constructor () {
        this.options = $(BRANDS_LIST).data('options');

        this.initDataTable();
        this.initEvents();
    }

    // init brands table
    initDataTable() {
        let _this = this;
        $(BRANDS_LIST).DataTable({
            ajax: {
                url: _this.options.dataTableAjax,
                data: function (request) {
                    request.name = '';
                    request.country_id = '';
                }
            },
            columns: [
                {
                    'data': 'id',
                    'name': 'id',
                    'title': 'ID',
                    render: $.fn.dataTable.render.text(), // block XSS
                },
                {
                    'data': 'name',
                    'name': 'name',
                    'title': 'Name',
                    render: $.fn.dataTable.render.text(),
                },
            ]
        });
    }

    // init events
    initEvents() {

    }
}
