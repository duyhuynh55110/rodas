const HomeView = () => import('@/views/auth/HomeView')
const CategoriesView = () => import('@/views/auth/CategoriesView')
const ShoppingCartView = () => import('@/views/auth/ShoppingCartView')
const WishListView = () => import('@/views/auth/WishListView')
const UserMenuView = () => import('@/views/auth/UserMenuView')
const ProfileView = () => import('@/views/auth/ProfileView')

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        exact: true,
        meta: {
            customPageContentClass: 'pt-30 bottom-sp80',
        }
    },
    {
        path: '/categories',
        name: 'categories',
        exact: true,
        component: CategoriesView,
    },
    {
        path: '/shopping-cart',
        name: 'shoppingCart',
        component: ShoppingCartView,
        meta: {
            customPageContentClass: 'pt-60 bottom-sp60',
        }
    },
    {
        path: '/wishlist',
        name: 'wishlist',
        component: WishListView,
        meta: {
            customPageContentClass: 'pt-90 bottom-sp70',
        }
    },
    {
        path: '/user-menu',
        name: 'userMenu',
        component: UserMenuView,
        meta: {
            customPageContentClass: 'pt-80 bottom-sp90',
        }
    },
    {
        path: '/profile',
        name: 'profile',
        component: ProfileView,
        meta: {
            customPageContentClass: 'pt-80 bottom-sp80',
        }
    },
];

export default routes;
