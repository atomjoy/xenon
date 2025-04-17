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
		path: '/services/:slug',
		name: 'services.details',
		component: () => import('@/views/page/ServiceDetailsView.vue'),
	},
	{
		path: '/projects',
		name: 'projects',
		component: () => import('@/views/page/ProjectsView.vue'),
	},
	{
		path: '/projects/:slug',
		name: 'projects.details',
		component: () => import('@/views/page/ProjectDetailsView.vue'),
	},
	{
		path: '/career',
		name: 'career',
		component: () => import('@/views/page/CareerView.vue'),
	},
	{
		path: '/career/:id',
		name: 'career.details',
		component: () => import('@/views/page/CareerDetailsView.vue'),
	},
	{
		path: '/team',
		name: 'team',
		component: () => import('@/views/page/TeamView.vue'),
	},
	{
		path: '/team/:slug',
		name: 'team.details',
		component: () => import('@/views/page/TeamDetailsView.vue'),
	},
	{
		path: '/faq',
		name: 'faq',
		component: () => import('@/views/page/QuestionsView.vue'),
	},
	{
		path: '/testimonials',
		name: 'testimonials',
		component: () => import('@/views/page/ReferencesView.vue'),
	},
	...blogRoutes,
];

export default routes;
