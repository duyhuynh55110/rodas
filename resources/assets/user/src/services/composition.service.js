import BaseService from "./base.service";

const baseUri = '/composition';
class CompositionService extends BaseService {
    async getHomeViewData() {
        const response = await this.get(baseUri + '/home-page');

        return response;
    }
}

export default new CompositionService()
