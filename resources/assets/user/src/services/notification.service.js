import BaseService from "./base.service";

const baseUri = '/notifications';
class NotificationService extends BaseService {
    // get notifications list with pagination
    async getNotifications(params) {
        const { data } = await this.get(baseUri, params);

        return {
            data: data.data,
            pagination: data.meta.pagination,
        };
    }
}

export default new NotificationService()
