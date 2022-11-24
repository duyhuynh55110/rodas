import BaseService from "./base.service";

export default class ProductService extends BaseService {
    uri = '/products';

    async getProducts() {
        const response = await this.get('');

        return response;
    }p
}
