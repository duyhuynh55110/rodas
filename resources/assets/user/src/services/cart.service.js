import BaseService from "./base.service";

const baseUri = '/products/cart';
class CartService extends BaseService {
    // get products cart list with pagination
    async getProductsCart(params) {
        const { data } = await this.get(baseUri, params);

        return data;
    }

    // add/update product to cart
    async addProductToCart(productId, quantity, type) {
        const params = {
            product_id: productId,
            quantity,
            type
        };

        const { data } = await this.post(baseUri, params);
        return data;
    }
}

export default new CartService()
