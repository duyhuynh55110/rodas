import { USER_LOGGED_IN_KEY } from "./constants"

// get user's data
const getAuth = () => {
    // get data from session storage
    const auth = JSON.parse(sessionStorage.getItem(USER_LOGGED_IN_KEY));

    return auth ?? null;
}

// get current user's access_token
export const getAccessToken = () => {
    try {
        const auth = getAuth();

        return auth.access_token;
    } catch (e) {
        return '';
    }
}

// get current user's info
export const getUser = () => {
    try {
        const auth = getAuth();

        return auth.user;
    } catch (e) {
        return null;
    }
}

// set user's data
export const setAuth = (accessToken, user) => {
    const values = JSON.stringify({
        access_token: accessToken,
        user: user,
    });

    // save to session storage to keep login
    sessionStorage.setItem(USER_LOGGED_IN_KEY, values);
}


