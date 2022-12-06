import router from "@/router";
import { PAGE_DEFAULT } from "./constants";

// set query, redirect with page reload
export const redirectWithQuery = (query, path = null) => {
    router.push({
        path: path ?? '',
        query: query,
    }).then(() => { router.go() });
}

// set page when click loadMore
export const nextPage = (pagination) => {
    return pagination?.current_page
    ? pagination.current_page + 1
    : PAGE_DEFAULT
}
