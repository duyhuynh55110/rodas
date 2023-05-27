import { setAuth, unsetAuth } from "@/utils/auth";
import { STATUS_CODE_OK } from "@/utils/constants";
import BaseService from "./base.service";

class AuthService extends BaseService {
    // get user's profile
    async getUserProfile() {
        const { data } = await this.get('/profile');

        return data;
    }

    // login a user
    async login(email, password) {
        try {
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
        } catch (e) {
            const response = e.response;

            return {
                status: response.data.status,
                message: response.data.message,
            }
        }
    }

    // logout a user
    async logout() {
        const { data } = await this.post('/logout');

        // unset current user's data from localStorage
        unsetAuth();

        return data;
    }

    // register a user
    async register(name, email, password, passwordConfirmation) {
        try {
            const { data } = await this.post('/register', {
                name,
                email,
                password,
                password_confirmation: passwordConfirmation,
            });

            // set data to session storage
            if(data.status == STATUS_CODE_OK) {
                setAuth(data.data.access_token, data.data.user);
            }

            return {
                status: data.status,
            };
        } catch (e) {
            const response = e.response;

            return {
                status: response.data.status,
                message: response.data.message,
            }
        }
    }
}

export default new AuthService()
