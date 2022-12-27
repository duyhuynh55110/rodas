import { getAccessToken } from "@/utils/auth";
import { createRouter, createWebHistory } from "vue-router";
import routes from "./routes";

const router = createRouter({
    history: createWebHistory(process.env.BASE_URL),
    routes,
});

// middleware
router.beforeEach((to, from, next) => {
    const publicPages = ["/login", "/register"];
    const authRequired = !publicPages.includes(to.path);
    const loggedIn = getAccessToken();

    // trying to access a restricted page + not logged in
    // redirect to login page
    if (authRequired && !loggedIn) {
        next({ name: "login" });
    } else if (["login", "register"].includes(to.name) && loggedIn) {
        next({ name: "home" });
    } else {
        next();
    }
});

export default router;
