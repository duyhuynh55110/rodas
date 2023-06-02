import BaseService from "./base.service";

const baseUri = '/countries';
class CountryService extends BaseService {
    // get countries list with pagination
    async getCountries(params) {
        const { data } = await this.get(baseUri, params);

        return {
            data: data.data,
        };
    }
}

export default new CountryService()
