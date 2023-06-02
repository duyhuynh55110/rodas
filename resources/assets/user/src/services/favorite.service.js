import BaseService from "./base.service";

const baseUri = '/products/favorite';
class FavoriteService extends BaseService {
    // load favorite products list, pagination
    async getProducts(params) {
        const { data } = await this.get(baseUri, params);

        return {
            data: data.data,
            pagination: data.meta.pagination,
        };
    }

    // add product to favorite products list
    async createFavorite(productId) {
        const { data } = await this.post(baseUri + `/${productId}`);

        return data;
    }

    // remove product from favorite products list
    async removeFavorite(productId) {
        const { data } = await this.delete(baseUri + `/${productId}`);

        return data;
    }
}

export default new FavoriteService()
