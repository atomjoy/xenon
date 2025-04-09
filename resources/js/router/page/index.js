import HomeView from '@/views/page/HomeView.vue';
import blogRoutes from './blog.js';

// Page routes
const routes = [
	{
		path: '/',
		name: 'home',
		component: HomeView,
	},
	{
		path: '/contact',
		name: 'contact',
		component: () => import('@/views/page/ContactView.vue'),
	},
	{
		path: '/services',
		name: 'services',
		component: () => import('@/views/page/ServicesView.vue'),
	},
	{
		path: '/projects',
		name: 'projects',
		component: () => import('@/views/page/ProjectsView.vue'),
	},
	{
		path: '/career',
		name: 'career',
		component: () => import('@/views/page/CareerView.vue'),
	},
	...blogRoutes,
];

export default routes;
