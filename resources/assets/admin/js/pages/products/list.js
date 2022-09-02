const PRODUCTS_LIST = 'table#productsList';
const SEARCH_FORM = 'form#searchForm';

export default class ListData {
    // dataTable object
    productsTable = null;

    // setting for datatables
    options = {};

    constructor () {
        this.options = $(PRODUCTS_LIST).data('options');

        this.initDataTable();
        this.initEvents();
    }

    // init products table
    initDataTable() {
        let _this = this;
        this.productsTable = $(PRODUCTS_LIST).DataTable({
            ajax: {
                url: _this.options.dataTableAjax,
                data: function (request) {
                    let form = $(SEARCH_FORM);

                    request.name = form.find('input[name=name]').val();
                    request.brand_id = form.find('select[name=brand_id]').val();
                    request.country_id = form.find('select[name=country_id]').val();
                }
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    title: 'ID',
                    render: $.fn.dataTable.render.text(), // block XSS
                },
                {
                    data: 'name',
                    name: 'name',
                    title: 'Name',
                    width: '30%',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'brand.name',
                    name: 'brand_name',
                    title: 'Brand',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'brand.country.name',
                    name: 'country_name',
                    title: 'Country',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'item_price',
                    name: 'item_price',
                    title: 'Price',
                    render: $.fn.dataTable.render.text(),
                },
                {
                    data: 'full_path_image',
                    name: 'full_path_image',
                    title: 'Image',
                    render: function (data) {
                        if(data == null) {
                            return data;
                        }

                        return `<img width='80' src='${data}' class='rounded' alt='${data}'/>`;
                    }
                },
                {
                    data: 'id',
                    name: 'control',
                    title: '',
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
        $(SEARCH_FORM).on('submit', function (e) {
            _this.productsTable.draw();
            return false;
        });
    }
}
