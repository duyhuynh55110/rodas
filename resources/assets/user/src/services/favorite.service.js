import BaseService from "./base.service";

const baseUri = '/products/favorite';
class FavoriteService extends BaseService {
    async createFavorite(productId) {
        const { data } = await this.post(baseUri, {
            product_id: productId,
        });

        return data;
    }

    async deleteFavorite(productId) {
        const { data } = await this.delete(baseUri, {
            product_id: productId,
        });

        return data;
    }
}

export default new FavoriteService()
