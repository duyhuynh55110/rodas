import BaseService from "./base.service";

const baseUri = '/products/favorite';
class FavoriteService extends BaseService {
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
