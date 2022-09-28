const HomeView = () => import('@/views/HomeView')

const routes = [
    {
        path: '/',
        name: 'home',
        component: HomeView,
        exact: true,
    }
];

export default routes;
