const GIFT_BOXS_LIST = 'table#gift-boxs-list';
const FORM_SEARCH = 'form#search-form';

export default class ListData {
    // dataTable object
    giftBoxsTable = null;

    // setting for dataTable
    options = {};

    constructor () {
        this.options = $(GIFT_BOXS_LIST).data('options');

        this.initDataTable();
        this.initEvents();
    }

    // init dataTable
    initDataTable() {
        let _this = this;
        this.giftBoxsTable = $(GIFT_BOXS_LIST).DataTable({
            ajax: {
                url: _this.options.dataTableAjax,
                data: function (request) {
                    let form = $(FORM_SEARCH);
                    request.name = form.find('input[name=name]').val();
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
                {
                    'data': 'full_path_image',
                    'name': 'full_path_image',
                    'title': 'Image',
                    render: function (data) {
                        if(data == null) {
                            return data;
                        }

                        return `<img width='80' src='${data}' class='rounded' alt='${data}'/>`;
                    }
                },
                {
                    'data': 'price',
                    'name': 'price',
                    'title': 'Price',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    'data': 'id',
                    'name': 'control',
                    'title': '',
                    render: function (data) {
                        let updateUrl = _this.options.updateUrl.replace('%s', data);
                        return `<a class="btn btn-info btn-sm" href="${updateUrl}"><i class="fas fa-info-circle"></i> Detail </a>`;
                    }
                },
            ]
        });
    }

    // init events
    initEvents() {
        this._onSubmitFormSearch();
    }

    // event when submit search form, filter data in products table
    _onSubmitFormSearch() {
        let _this = this;
        $(FORM_SEARCH).on('submit', function (e) {
            _this.giftBoxsTable.draw();
            return false;
        });
    }
}
