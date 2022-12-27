import { setAuth } from "@/utils/auth";
import { STATUS_CODE_OK } from "@/utils/constants";
import BaseService from "./base.service";

class AuthService extends BaseService {
    // get user's profile
    async getUserProfile() {
        const { data } = await this.get('/profile');

        return data;
    }

    // login a user -> response token
    async login(email, password) {
        const { data } = await this.post('/login', {
            email,
            password,
        });

        // set data to session storage
        if(data.status == STATUS_CODE_OK) {
            setAuth(data.data.access_token, data.data.user);
        }

        return {
            status: data.status,
        };
    }
}

export default new AuthService()
