const routes = [
    {
        path: '/categories/:id',
        name: 'categories.detail',
        component: import('@/views/auth/categories/CategoryDetailView/CategoryDetailView.vue'),
        meta: {
            title: 'Category Detail',
            customPageContentClass: 'pt-60 bg-primary',
            viewFullScreen: true,
        },
    },
    {
        path: '/categories',
        name: 'categories.index',
        component: import('@/views/auth/categories/CategoryIndexView/CategoryIndexView.vue'),
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
        component: import('@/views/auth/ShoppingCartView'),
        meta: {
            title: 'Shopping Cart',
            customPageContentClass: 'pt-60 bottom-sp60',
        },
    },
    {
        path: '/wishlist',
        name: 'wishlist',
        component: import('@/views/auth/WishListView/WishListView.vue'),
        meta: {
            title: 'Wishlist',
            customPageContentClass: 'pt-90 bottom-sp70',
        },
    },
    {
        path: '/user-menu',
        name: 'user-menu',
        component: import('@/views/auth/UserMenuView/UserMenuView.vue'),
        meta: {
            title: 'User',
            customPageContentClass: 'pt-80 bottom-sp90',
        },
    },
    {
        path: '/profile',
        name: 'profile',
        component: import('@/views/auth/ProfileView/ProfileView.vue'),
        meta: {
            title: 'Profile',
            customPageContentClass: 'pt-80 bottom-sp80',
        },
    },
    {
        path: '/notifications',
        name: 'notifications',
        component: import('@/views/auth/NotificationsView/NotificationsView.vue'),
        meta: {
            title: 'Notifications',
            customPageContentClass: 'pt-80',
            viewFullScreen: true,
        },
    },
    {
        path: '/products/:id',
        name: 'products.detail',
        component: import('@/views/auth/NotificationsView/NotificationsView.vue'),
        meta: {
            title: 'Products',
            customPageContentClass: 'pt-80',
            viewFullScreen: true,
        },
    },
    {
        path: '/',
        name: 'home',
        exact: true,
        meta: {
            title: 'Homepage',
            customPageContentClass: 'pt-30 bottom-sp80',
        },
        component: import('@/views/auth/HomeView/HomeView.vue'),
    },
];

export default routes;
