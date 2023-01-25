import router from "@/router";

// set query, redirect with page reload
export const redirectWithQuery = (query, path = null) => {
    router.push({
        path: path ?? '',
        query: query,
    }).then(() => { router.go() });
}

// Make a first letter in string upper
export const capitalizeFirstLetter = (str) => {
    return str.charAt(0).toUpperCase() + str.slice(1);
}

// format money
export const formatMoney = (price) => {
    if (!Number.isInteger(price)) {
        return '';
    }

    return `$` + price;
}
