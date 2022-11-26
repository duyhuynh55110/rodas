import {
    SEARCH_TABLE_PAGE_LENGTH_MENU
} from '@admin_js/constants';

// gift box products table
const GIFT_BOX_PRODUCTS_TABLE = 'table#giftBoxProductsList';
const BTN_REMOVE_PRODUCT = 'button.btn-delete';

// search table
const SEARCH_PRODUCTS_TABLE = 'table#searchProductsList';
const CHECKBOXES_SELECT_PRODUCT = 'input.select-product';
const CHECKBOXES_SELECT_ALL_PRODUCTS = 'input.select-all-products';
const SEARCH_PRODUCTS_FORM = 'form#searchProductsForm';
const BTN_SUBMIT_SELECTED_PRODUCTS = 'button#btnSubmitSelectedProducts';
const MODAL_SEARCH_PRODUCTS = '#modalSearchProducts';

export default class ProductService {
    // searchProducts dataTable object
    searchProductsDataTable = null;

    // giftBoxProducts dataTable object
    giftBoxProductsDataTable = null;

    // setting for searchProducts dataTable
    searchProductsOptions = {};

    // setting for giftBoxProducts dataTable
    giftBoxProductsOptions = {};

    // current selected products data
    selectedProductsData = [];

    constructor() {
        this.searchProductsOptions = $(SEARCH_PRODUCTS_TABLE).data('options');

        this.giftBoxProductsOptions = $(GIFT_BOX_PRODUCTS_TABLE).data('options');
    }

    // init
    init() {
        this.initGiftBoxProductsDataTable();

        this.initSearchProductsDataTable();

        this.initEvents();
    }

    // base columns for two table (giftBoxProducts, searchProducts table)
    _baseDataTableColumns() {
        return [
            {
                data: 'id',
                name: 'id',
                title: 'ID',
                orderable: false,
                render: $.fn.dataTable.render.text(), // block XSS
            },
            {
                data: 'name',
                name: 'name',
                title: 'Name',
                orderable: false,
                render: $.fn.dataTable.render.text(),
            },
            {
                data: 'brand.name',
                name: 'brand_name',
                title: 'Brand',
                orderable: false,
                render: $.fn.dataTable.render.text(),
            },
            {
                data: 'brand.country.name',
                name: 'country_name',
                title: 'Country',
                orderable: false,
                render: $.fn.dataTable.render.text(),
            },
            {
                data: 'item_price',
                name: 'item_price',
                title: 'Price',
                orderable: false,
                render: $.fn.dataTable.render.text(),
            },
            {
                data: 'full_path_image',
                name: 'full_path_image',
                title: 'Image',
                orderable: false,
                render: function (data) {
                    if(data == null) {
                        return data;
                    }

                    return `<img width='80' src='${data}' class='rounded img-fluid' alt='${data}'/>`;
                }
            },
        ];
    }

    // init giftBoxProducts DataTable
    initGiftBoxProductsDataTable() {
        let _this = this;
        let data = this.giftBoxProductsOptions.data ?? [];

        // when load page: current selected products default from giftBoxProducts table
        this.selectedProductsData = data;

        this.giftBoxProductsDataTable = $(GIFT_BOX_PRODUCTS_TABLE).DataTable({
            data: data,
            scrollY: '800px',
            scrollCollapse: true,
            responsive: false,
            paging: false,
            processing: false,
            serverSide: false,
            ordering: false,
            columns: [
                ..._this._baseDataTableColumns(),
                {
                    data: 'quantity',
                    name: 'quantity',
                    title: 'Quantity',
                    orderable: false,
                    render: function (data, type, row) {
                        // get product id to set 'jQuery Validate' rules
                        let productId = row.id;

                        // must set name have index because
                        // jQuery Validate will validate only first element if have multiple input have same name
                        // Ex: have 10 input name=quantity -> only validate first element
                        return `
                            <div class="form-group">
                                <input name="product[${productId}][quantity]" required min="1" value="${data}" type="number" class="input-quantity form-control w-75" placeholder="Enter quantity" />
                            </div>
                        `;
                    }
                },
                {
                    data: 'id',
                    name: 'delete_id',
                    orderable: false,
                    render: function (data) {
                        return `<button type="button" class="btn btn-danger btn-delete btn-sm d-inline-flex align-items-center"> Remove </button>`;
                    }
                },
            ],
        });
    }

    // init searchProducts dataTable
    initSearchProductsDataTable() {
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
                    orderable: false,
                    title: '<input class="select-all-products" type="checkbox">',
                    render: function (data, type, full, meta){
                        return `<input class="select-product" type="checkbox" value="${data}">`;
                    }
                },
                ..._this._baseDataTableColumns(),
            ],
            ordering: false,
            lengthMenu: SEARCH_TABLE_PAGE_LENGTH_MENU,
            select: {
                style: 'multi',
                selector: 'td:first-child' + CHECKBOXES_SELECT_PRODUCT,
            },
            drawCallback: function (settings) {
                let api = this.api();
                let currRowNodes = api.rows({page:'current'}).nodes();

                // loop current rows
                currRowNodes.map(e => {
                    let row = api.row(e);
                    let data = row.data();
                    let productId = parseInt(data.id);

                    // selected this row if product id exist in selectedProductsData
                    if(_this.selectedProductsData.find(selectedProduct => selectedProduct.id == productId)) {
                        $(e).find(CHECKBOXES_SELECT_PRODUCT).prop('checked', true);
                        row.select();
                    }
                });

                _this._checkAllRowsOnPages();
            }
        });
    }

    // init events
    initEvents() {
        this._onSubmitSearchProductsForm();

        this._onChangeCheckboxSelectProductOnSearchTable();

        this._onChangeCheckboxSelectAllProductsOnSearchTable();

        this._onSubmitSelectedProducts();

        this._onClickRemoveButtonOnGiftBoxProductsTable();
    }

    // event when filter data in search products table
    _onSubmitSearchProductsForm() {
        let _this = this;

        $(SEARCH_PRODUCTS_FORM).on('submit', function (e) {
            _this.searchProductsDataTable.draw();
            return false;
        });
    }

    // event when check/uncheck checkbox select product in search table
    _onChangeCheckboxSelectProductOnSearchTable() {
        let _this = this;

        $(SEARCH_PRODUCTS_TABLE).on('change', CHECKBOXES_SELECT_PRODUCT, function () {
            let tr = $(this).closest('tr');
            let row = _this.searchProductsDataTable.row(tr);
            let data = row.data();

            if ($(this).prop('checked')) {
                // add data to selected products data
                _this._addToSearchProductsData(data);

                // select row in search table
                row.select();
            } else {
                // remove data from selected products data
                _this._removeFromSearchProductsData(data.id);

                // deselect row in search table
                row.deselect();
            }

            _this._checkAllRowsOnPages();
        });
    }

    // event when check/uncheck checkbox all select products in search table
    _onChangeCheckboxSelectAllProductsOnSearchTable() {
        let _this = this;

        $(SEARCH_PRODUCTS_TABLE).on('change', CHECKBOXES_SELECT_ALL_PRODUCTS, function () {
            let isChecked = $(this).prop('checked');
            let currRows = _this.searchProductsDataTable.rows({page: 'current'}).nodes();

            // loop all rows in current page
            currRows.map(
                function (e, i) {
                    // change select product value and trigger their change event after that
                    $(e).find(CHECKBOXES_SELECT_PRODUCT).prop('checked', isChecked).trigger('change');
                }
            );
        });
    }

    // add new data to selectedProductsData
    _addToSearchProductsData(data) {
        let productEntity = {
            id: data.id, // product id
            name: data.name,
            item_price: data.item_price,
            full_path_image: data.full_path_image,
            brand: {
                id: data.brand.id,
                name: data.brand.name,
                country: {
                    id: data.brand.country.id,
                    name: data.brand.country.name,
                }
            },
        };

        // check exists -> skip add if already exists in selected products data
        let existsProduct = this.selectedProductsData.find(product => product.id == productEntity.id);
        if(!existsProduct) {
            this.selectedProductsData.push(productEntity);
        }
    }

    // remove data from selectedProductsData
    _removeFromSearchProductsData(removeProductId) {
        this.selectedProductsData = this.selectedProductsData.filter(product => product.id != removeProductId);
    }

    // auto change checkbox select all products value
    _checkAllRowsOnPages() {
        let pageRows = this.searchProductsDataTable.rows({ page: 'current' }).count();
        let selectedRows = this.searchProductsDataTable.rows({ page: 'current', selected: true }).count();

        // checked checkbox select all products if all rows on page are selected
        if(pageRows == selectedRows) {
            $(CHECKBOXES_SELECT_ALL_PRODUCTS).prop('checked', true);
        } else {
            $(CHECKBOXES_SELECT_ALL_PRODUCTS).prop('checked', false);
        }
    }

    // event when submit selected products to gift box products table
    _onSubmitSelectedProducts() {
        let _this = this;

        $(BTN_SUBMIT_SELECTED_PRODUCTS).on('click', function () {
            let giftBoxProductsData = _this.giftBoxProductsDataTable.rows().data().toArray();

            // add new data to giftBoxProducts table
            let newData = _this.selectedProductsData.map(selectedProduct => {
                    let existingProduct = giftBoxProductsData.find(product => product.id == selectedProduct.id);

                    // add product to giftBoxProducts table if product not exist
                    if(!existingProduct) {
                        return selectedProduct;
                    }
                }
            ).filter(Boolean);

            // render new rows
            _this.giftBoxProductsDataTable.rows.add(newData).draw();

            // remove not exist product rows from giftBoxProducts table
            let removeProductIds = giftBoxProductsData.map(giftBoxProduct => {
                let existProduct = _this.selectedProductsData.find(selectedProduct => selectedProduct.id == giftBoxProduct.id);

                // remove not exist product
                if(!existProduct) {
                    return giftBoxProduct.id;
                }
            }).filter(Boolean);

            _this.giftBoxProductsDataTable.rows((idx, data) => {
                return removeProductIds.includes(data.id);
            }).remove().draw();

            // close modal
            $(MODAL_SEARCH_PRODUCTS).modal('hide');
        });
    }

    // event when click 'Remove' button on giftBoxProducts table
    _onClickRemoveButtonOnGiftBoxProductsTable() {
        let _this = this;

        $(GIFT_BOX_PRODUCTS_TABLE).on('click', BTN_REMOVE_PRODUCT, function () {
            let tr = $(this).closest('tr');
            let row = _this.giftBoxProductsDataTable.row(tr);
            let productId = row.data().id;

            // remove row from giftBoxProducts table
            row.remove().draw();

            // unselected row from search table
            $(SEARCH_PRODUCTS_TABLE).find(CHECKBOXES_SELECT_PRODUCT + `[value=${productId}]`).prop('checked', false).trigger('change');
        });
    }
}
