import { PAGE_DEFAULT } from "@/utils/constants"

// request param next page
export const nextPage = (pagination) => {
    return pagination?.current_page ? pagination.current_page + 1 : PAGE_DEFAULT
}

// initial value for a state
export const setPaginate = (data = [], pagination = {}) => {
    return {
        data,
        pagination,
    }
}
