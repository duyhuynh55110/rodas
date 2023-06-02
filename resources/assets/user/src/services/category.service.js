import BaseService from "./base.service";

const baseUri = '/categories';
class CategoryService extends BaseService {
    // get categories list with pagination
    async getCategories(params) {
        const { data } = await this.get(baseUri, params);

        return {
            data: data.data,
        };
    }

    // get category by id
    async getCategoryById(id) {
        const { data } = await this.get(baseUri + `/${id}`);

        return data;
    }
}

export default new CategoryService()
