import ProductService from './services/productService';
import bsCustomFileInput from 'bs-custom-file-input';

const FORM_DATA = 'form#giftBoxForm';
const GIFT_BOXES_PRODUCTS_TABLE = 'table#giftBoxProductsList';
const INPUT_QUANTITY = 'input.input-quantity';

export default class FormData {
    // product service object
    productService;

    constructor () {
        this.initServices();

        this.initFormValidate();
    }

    // init services
    initServices() {
        this.productService = new ProductService();

        this.productService.init();
    }

    // init validation
    initFormValidate() {
        $(FORM_DATA).validate({
            submitHandler: function (form) {
                let giftBoxProductsData = $(GIFT_BOXES_PRODUCTS_TABLE).find('tbody tr').map((i, e) => {
                    let tr = $(e);
                    let data = $(GIFT_BOXES_PRODUCTS_TABLE).DataTable().row(tr).data();

                    return {
                        product_id: data.id,
                        quantity: tr.find(INPUT_QUANTITY).val(),
                    };
                }).toArray();

                // append gift box products data
                $(form).append(`<input name="gift_box_products" type="hidden" value='${JSON.stringify(giftBoxProductsData)}' />`);

                // block try to submit multiple in same time
                $('button').prop('disabled', true);

                // submit form
                form.submit();
            }
        });

        // support preview better input file
        bsCustomFileInput.init();
    }
}
