import BaseService from "./base.service";

const baseUri = '/products';
class ProductService extends BaseService {
    async getProducts() {
        const { data } = await this.get(baseUri);

        return {
            data: data.data,
            pagination: data.meta.pagination,
        };
    }
}

export default new ProductService()
