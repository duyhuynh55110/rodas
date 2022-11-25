import BaseService from "./base.service";

const baseUri = '/products';
class ProductService extends BaseService {
    async getProducts() {
        const response = await this.get(baseUri);

        return response;
    }
}

export default new ProductService()
