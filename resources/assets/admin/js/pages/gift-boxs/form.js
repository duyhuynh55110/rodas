import ProductService from "./services/productService";

export default class FormData {
    // product service object
    productService;

    constructor () {
        this.initServices();
    }

    // init services
    initServices() {
        this.productService = new ProductService();

        this.productService.init();
    }
}
