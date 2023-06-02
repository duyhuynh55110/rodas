import BaseService from "./base.service";

const baseUri = '/order-issues';

class OrderIssueService extends BaseService {
    // create a order
    async createOrder(formData) {
        const { data } = await this.post(baseUri, formData);

        return data;
    }
}

export default new OrderIssueService()
