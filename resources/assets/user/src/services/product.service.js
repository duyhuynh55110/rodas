import BaseService from "./base.service";

const baseUri = '/products';
class ProductService extends BaseService {
    // get products list with pagination
    async getProducts(params) {
        const { data } = await this.get(baseUri, params);

        return {
            data: data.data,
            pagination: data.meta.pagination,
        };
    }

    // get a product info by id
    async getProductById(id) {
        const { data } = await this.get(baseUri + `/${id}`);

        return data;
    }
}

export default new ProductService()
