import BaseService from "./base.service";

const baseUri = '/composition';
class CompositionService extends BaseService {
    async getHomeViewData() {
        const { data } = await this.get(baseUri + '/home-page');

        return data;
    }
}

export default new CompositionService()
