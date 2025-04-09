// Panel routes (guard web)
const routes = [
	// Login
	{
		path: '/admin/login',
		name: 'admin.login',
		component: () => import('@/views/admin/auth/LoginView.vue'),
		meta: { adminRoute: true },
	},
	{
		path: '/admin/password',
		name: 'admin.password',
		component: () => import('@/views/admin/auth/PasswordView.vue'),
	},
	{
		path: '/admin/login/f2a/:hash',
		name: 'admin.login.f2a',
		component: () => import('@/views/admin/auth/LoginF2aView.vue'),
	},
	{
		path: '/admin/logout',
		name: 'admin.logout',
		component: () => import('@/views/admin/auth/LogoutView.vue'),
		meta: { requiresAdmin: true },
	},
];

export default routes;
