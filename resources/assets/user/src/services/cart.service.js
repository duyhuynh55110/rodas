import BaseService from "./base.service";

const baseUri = '/products/cart';
class CartService extends BaseService {
    // get cart products list with pagination
    async getCartProducts(params) {
        const { data } = await this.get(baseUri, params);

        return data;
    }

    // add/update product to cart
    async updateProductQuantity(productId, quantity, type) {
        const params = {
            product_id: productId,
            quantity,
            type
        };

        const { data } = await this.post(baseUri, params);
        return data;
    }

    // remove product from cart
    async removeProductFromCart(productId) {
        const { data } = await this.delete(baseUri + `/${productId}`);

        return data;
    }
}

export default new CartService()
