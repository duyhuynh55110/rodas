import axios from "axios";
import {
    HTTP_CODE_INTERNAL_SERVER_ERROR,
    HTTP_CODE_UNAUTHORIZED,
    HTTP_CODE_NOT_FOUND,
    STATUS_CODE_NOT_LOGGED_IN,
} from "@/utils/constants";
import router from "@/router";
import { getAccessToken } from "@/utils/auth";

axios.defaults.baseURL = process.env.VUE_APP_API_DOMAIN;

export default class BaseService {
    authHeader() {
        // get current user's access_token
        const accessToken = getAccessToken();

        if (accessToken) {
            return { Authorization: "Bearer " + accessToken };
        } else {
            return {};
        }
    }

    async get(uri, params = {}) {
        try {
            return await axios.get(uri, { params, headers: this.authHeader() });
        } catch (e) {
            return this.handleError(e);
        }
    }

    async post(uri, params = {}) {
        try {
            return await axios.post(uri, params, { headers: this.authHeader() });
        } catch (e) {
            return this.handleError(e);
        }
    }

    async put(uri, params = {}) {
        try {
            return await axios.put(uri, params, { headers: this.authHeader() });
        } catch (e) {
            return this.handleError(e);
        }
    }

    async patch(uri, params = {}) {
        try {
            return await axios.patch(uri, params, { headers: this.authHeader() });
        } catch (e) {
            return this.handleError(e);
        }
    }

    async delete(uri) {
        try {
            return await axios.delete(uri);
        } catch (e) {
            return this.handleError(e);
        }
    }

    handleError(e) {
        let response = e.response;
        if (response === undefined) {
            throw e;
        }

        const httpCode = response.status;

        switch (httpCode) {
            case HTTP_CODE_INTERNAL_SERVER_ERROR:
                router.push({ path: "/500" });
                break;
            case HTTP_CODE_NOT_FOUND:
                router.push({ path: "/404" });
                break;
            case HTTP_CODE_UNAUTHORIZED:
                // status code is not logged in -> redirect to login page
                if (response.data.status == STATUS_CODE_NOT_LOGGED_IN) {
                    router.push({ path: "/login " });
                }

                // login failed
                return response;
        }

        throw e;
    }
}
