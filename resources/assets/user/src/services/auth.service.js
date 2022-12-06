import BaseService from "./base.service";

class AuthService extends BaseService {
    // get user's profile
    async getUserProfile() {
        const { data } = await this.get('/profile');

        return data;
    }
}

export default new AuthService()
