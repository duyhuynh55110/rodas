const HomeView = () => import('@/views/auth/HomeView');

// categories
const CategoriesIndexView = () => import('@/views/auth/CategoriesIndexView');
const CategoryDetailView = () => import('@/views/auth/CategoryDetailView');

const ShoppingCartView = () => import('@/views/auth/ShoppingCartView');
const WishListView = () => import('@/views/auth/WishListView');
const UserMenuView = () => import('@/views/auth/UserMenuView');
const ProfileView = () => import('@/views/auth/ProfileView');
const NotificationsView = () => import('@/views/auth/NotificationsView');

const routes = [
    {
        path: '/categories/:slug',
        name: 'categories.detail',
        component: CategoryDetailView,
        meta: {
            title: 'Category Detail',
            customPageContentClass: 'pt-60 bg-primary',
            viewFullScreen: true,
        },
    },
    {
        path: '/categories',
        name: 'categories.index',
        component: CategoriesIndexView,
        exact: true,
        meta: {
            title: 'Categories',
            customPageContentClass: 'pt-80 bottom-sp90',
            viewFullScreen: true,
        },
    },
    {
        path: '/shopping-cart',
        name: 'shopping-cart',
        component: ShoppingCartView,
        meta: {
            title: 'Shopping Cart',
            customPageContentClass: 'pt-60 bottom-sp60',
        },
    },
    {
        path: '/wishlist',
        name: 'wishlist',
        component: WishListView,
        meta: {
            title: 'Wishlist',
            customPageContentClass: 'pt-90 bottom-sp70',
        },
    },
    {
        path: '/user-menu',
        name: 'user-menu',
        component: UserMenuView,
        meta: {
            title: 'User',
            customPageContentClass: 'pt-80 bottom-sp90',
        },
    },
    {
        path: '/profile',
        name: 'profile',
        component: ProfileView,
        meta: {
            title: 'Profile',
            customPageContentClass: 'pt-80 bottom-sp80',
        },
    },
    {
        path: '/notifications',
        name: 'notifications',
        component: NotificationsView,
        meta: {
            title: 'Notifications',
            customPageContentClass: 'pt-80',
            viewFullScreen: true,
        },
    },
    {
        path: '/',
        name: 'home',
        component: HomeView,
        exact: true,
        meta: {
            title: 'Homepage',
            customPageContentClass: 'pt-30 bottom-sp80',
        },
    },
];

export default routes;
