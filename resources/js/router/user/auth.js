// Panel routes (guard web)
const routes = [
	// Login
	{
		path: '/login',
		name: 'login',
		component: () => import('@/views/panel/auth/LoginView.vue'),
	},
	{
		path: '/register',
		name: 'register',
		component: () => import('@/views/panel/auth/RegisterView.vue'),
	},
	{
		path: '/password',
		name: 'password',
		component: () => import('@/views/panel/auth/PasswordView.vue'),
	},
	{
		path: '/login/f2a/:hash',
		name: 'login.f2a',
		component: () => import('@/views/panel/auth/LoginF2aView.vue'),
	},
	{
		path: '/activate/:id/:code',
		name: 'activate',
		component: () => import('@/views/panel/auth/ActivateView.vue'),
	},
	{
		path: '/change/email/:id/:code',
		name: 'change.email',
		component: () => import('@/views/panel/auth/EmailChangeView.vue'),
		meta: { requiresAuth: true },
	},
	{
		path: '/logout',
		name: 'logout',
		component: () => import('@/views/panel/auth/LogoutView.vue'),
		meta: { requiresAuth: true },
	},
];

export default routes;
