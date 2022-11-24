import axios from "axios";
import {
    HTTP_CODE_INTERNAL_SERVER_ERROR,
    HTTP_CODE_UNAUTHORIZED,
    HTTP_CODE_NOT_FOUND,
} from "@/utils/constants";
import router from "@/router";
// import router from '@/router'

axios.defaults.baseURL = process.env.VUE_APP_API_DOMAIN;
axios.defaults.headers.common["Authorization"] = "Bearer 0FPD7baVmlpQdUhch81GPkgRIRLH7FpsybqJqApu";

export default class BaseService {
    async get(uri, params = {}) {
        try {
            return await axios.get(uri, { params: params });
        } catch (e) {
            return this.handleError(e);
        }
    }

    async post(uri, params = {}) {
        try {
            return await axios.post(uri, params);
        } catch (e) {
            return this.handleError(e);
        }
    }

    async put(uri, params = {}) {
        try {
            return await axios.put(uri, params);
        } catch (e) {
            return this.handleError(e);
        }
    }

    async patch(uri, params = {}) {
        try {
            return await axios.patch(uri, params);
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
        if (e.response === undefined) {
            throw e;
        }

        const httpCode = e.response.status;

        switch (httpCode) {
            case HTTP_CODE_INTERNAL_SERVER_ERROR:
                router.push({ path: '/500' });
                break;
            case HTTP_CODE_NOT_FOUND:
                router.push({ path: '/404' });
                break;
            case HTTP_CODE_UNAUTHORIZED:
                console.log('still not login');
                return 123;
        }

        throw e;
    }
}
