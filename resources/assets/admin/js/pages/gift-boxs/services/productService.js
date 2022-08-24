const GIFT_BOX_PRODUCTS_TABLE = '';
const SEARCH_PRODUCTS_TABLE = 'table#searchProductsList';
const SEARCH_PRODUCTS_FORM = 'form#searchProductsForm';

export default class ProductService {
    // searchProducts dataTable object
    searchProductsDataTable = null;

    // giftBoxProducts dataTable object
    giftBoxProductsDataTable = null;

    // setting for searchProducts dataTable
    searchProductsOptions = {};

    // setting for giftBoxProducts dataTable
    giftBoxProductsOptions = {};

    constructor() {
        this.searchProductsOptions = $(SEARCH_PRODUCTS_TABLE).data('options');
    }

    // init
    init() {
        this.initSearchProductDataTable();

        this.initEvents();
    }

    // init searchProducts dataTable
    initSearchProductDataTable() {
        let _this = this;

        this.searchProductsDataTable = $(SEARCH_PRODUCTS_TABLE).DataTable({
            ajax: {
                url: _this.searchProductsOptions.dataTableAjax,
                data: function (request) {
                    let form = $(SEARCH_PRODUCTS_FORM);

                    request.name = form.find('input[name=name]').val();
                    request.brand_id = form.find('select[name=brand_id]').val();
                    request.country_id = form.find('select[name=country_id]').val();
                }
            },
            columns: [
                {
                    data: 'id',
                    name: 'id',
                    title: '<input type="checkbox">',
                    render: function (data, type, full, meta){
                        return `<input type="checkbox" value="${data}">`;
                    }
                },
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
                    'width': '30%',
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
            ],
            ordering: false,
        });
    }

    // init events
    initEvents() {
        this._onSubmitSearchProductsForm();
    }

    // event when filter data in search products table
    _onSubmitSearchProductsForm() {
        let _this = this;

        $(SEARCH_PRODUCTS_FORM).on('submit', function (e) {
            _this.searchProductsDataTable.draw();
            return false;
        });
    }
}
