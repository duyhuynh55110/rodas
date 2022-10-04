const HomeView = () => import('@/views/auth/HomeView')
const CategoriesView = () => import('@/views/auth/CategoriesView')

const routes = [
    {
        path: '/categories',
        name: 'categories',
        component: CategoriesView,
    },
    {
        path: '/shopping-cart',
        name: 'shoppingCart',
        component: HomeView,
    },
    {
        path: '/wishlist',
        name: 'wishlist',
        component: HomeView,
    },
    {
        path: '/',
        name: 'home',
        component: HomeView,
        exact: true,
    },
];

export default routes;
